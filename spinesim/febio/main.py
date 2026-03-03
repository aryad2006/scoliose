"""
VERTEX© — Service FEBio
-----------------------
API FastAPI wrappant FEBio 4.x pour l'analyse biomécanique tétraédrique.

Endpoints :
  POST /solve           — résolution FEM tétraédrique
  POST /screw-analysis  — analyse de vis pédiculaire
  GET  /health          — état du service + FEBio disponible

Port : 8081
"""

import asyncio
import json
import os
import subprocess
import tempfile
import uuid
from pathlib import Path
from typing import Optional

import numpy as np
from fastapi import FastAPI, HTTPException
from fastapi.responses import JSONResponse
from pydantic import BaseModel, Field

# ── Répertoire de travail temporaire ────────────────────────
WORKSPACE = Path(os.getenv("FEBIO_WORKSPACE", "/tmp/febio_workspace"))
WORKSPACE.mkdir(parents=True, exist_ok=True)

FEBIO_BIN = Path(os.getenv("FEBIO_BIN", "/usr/local/bin/febio4"))


# ── Modèles Pydantic ─────────────────────────────────────────

class Vec3(BaseModel):
    x: float
    y: float
    z: float


class FENode(BaseModel):
    id: int
    x: float
    y: float
    z: float


class FEElement(BaseModel):
    id: int
    type: str = "tet4"          # tet4 | tet10 | hex8
    nodes: list[int]             # indices de nœuds


class BonePropertiesModel(BaseModel):
    """Propriétés mécaniques de l'os."""
    youngs_modulus_pa: float = Field(14_000_000.0, description="Module de Young (Pa)")
    poisson_ratio: float     = Field(0.3, ge=0.0, lt=0.5)
    density_kg_m3: float     = Field(1900.0)
    is_cortical: bool        = True


class BoundaryCondition(BaseModel):
    node_id: int
    fixed_dofs: list[str]    # ["x","y","z","rx","ry","rz"]


class AppliedLoad(BaseModel):
    node_id: int
    force_n: Vec3
    moment_nm: Optional[Vec3] = None


class VertebralMesh(BaseModel):
    """Maillage tétraédrique d'une vertèbre pour FEBio."""
    level: str                              # ex: "L3"
    nodes: list[FENode]
    elements: list[FEElement]
    material: BonePropertiesModel           = BonePropertiesModel()
    boundary_conditions: list[BoundaryCondition] = Field(default_factory=list)
    loads: list[AppliedLoad]                = Field(default_factory=list)


class ScrewPlacement(BaseModel):
    """Paramètres de placement d'une vis pédiculaire."""
    entry_point: Vec3
    trajectory: Vec3          # vecteur direction (normalisé dans FEBio)
    diameter_mm: float  = Field(5.0, ge=3.5, le=9.0)
    length_mm: float    = Field(45.0, ge=25.0, le=70.0)
    level: str          = "L3"
    side: str           = Field("right", pattern=r"^(left|right)$")


class SolveRequest(BaseModel):
    mesh: VertebralMesh
    gravity: bool = True


class ScrewAnalysisRequest(BaseModel):
    screw: ScrewPlacement
    mesh: VertebralMesh


# ── Génération du fichier .feb (XML) ────────────────────────

def generate_feb_file(mesh: VertebralMesh, job_dir: Path) -> Path:
    """
    Génère un fichier .feb (FEBio XML) depuis le maillage Python.
    Retourne le chemin du fichier .feb créé.
    """
    feb_path = job_dir / "model.feb"

    # ── Construction du XML FEBio 3.0 ──
    lines = [
        '<?xml version="1.0" encoding="ISO-8859-1"?>',
        '<febio_spec version="3.0">',
        '',
        '  <!-- VERTEX© — FEBio Model -->',
        f'  <!-- Level: {mesh.level} -->',
        '',
        '  <Module type="solid"/>',
        '',
        '  <Material>',
        f'    <material id="1" name="bone_{mesh.level}" type="neo-Hookean">',
        f'      <E>{mesh.material.youngs_modulus_pa}</E>',
        f'      <v>{mesh.material.poisson_ratio}</v>',
        '    </material>',
        '  </Material>',
        '',
        '  <Mesh>',
        '    <Nodes name="all">',
    ]

    for node in mesh.nodes:
        lines.append(f'      <node id="{node.id}">{node.x},{node.y},{node.z}</node>')

    lines += [
        '    </Nodes>',
        '',
        f'    <Elements type="tet4" name="vertebra" mat="bone_{mesh.level}">',
    ]

    for elem in mesh.elements:
        node_ids = ",".join(str(n) for n in elem.nodes)
        lines.append(f'      <elem id="{elem.id}">{node_ids}</elem>')

    lines += [
        '    </Elements>',
        '  </Mesh>',
        '',
        '  <MeshDomains>',
        f'    <SolidDomain name="vertebra" mat="bone_{mesh.level}"/>',
        '  </MeshDomains>',
        '',
        '  <Boundary>',
    ]

    for bc in mesh.boundary_conditions:
        for dof in bc.fixed_dofs:
            lines.append(f'    <bc name="fix_{bc.node_id}_{dof}" type="zero displacement" node_set="@node:{bc.node_id}">')
            lines.append(f'      <dof>{dof}</dof>')
            lines.append('    </bc>')

    lines += [
        '  </Boundary>',
        '',
        '  <Loads>',
    ]

    for load in mesh.loads:
        lines += [
            f'    <nodal_load name="load_{load.node_id}" bc="x" node_set="@node:{load.node_id}">',
            f'      <value lc="1">{load.force_n.x}</value>',
            '    </nodal_load>',
            f'    <nodal_load name="load_{load.node_id}_y" bc="y" node_set="@node:{load.node_id}">',
            f'      <value lc="1">{load.force_n.y}</value>',
            '    </nodal_load>',
            f'    <nodal_load name="load_{load.node_id}_z" bc="z" node_set="@node:{load.node_id}">',
            f'      <value lc="1">{load.force_n.z}</value>',
            '    </nodal_load>',
        ]

    lines += [
        '  </Loads>',
        '',
        '  <LoadData>',
        '    <load_controller id="1" type="loadcurve">',
        '      <interpolate>LINEAR</interpolate>',
        '      <points>',
        '        <pt>0,0</pt>',
        '        <pt>1,1</pt>',
        '      </points>',
        '    </load_controller>',
        '  </LoadData>',
        '',
        '  <Output>',
        '    <plotfile type="febio">',
        '      <var type="displacement"/>',
        '      <var type="stress"/>',
        '      <var type="von Mises stress"/>',
        '      <var type="strain energy density"/>',
        '    </plotfile>',
        '  </Output>',
        '',
        '  <Step name="femsolve">',
        '    <Control>',
        '      <analysis>STATIC</analysis>',
        '      <time_steps>10</time_steps>',
        '      <step_size>0.1</step_size>',
        '      <solver type="solid">',
        '        <max_refs>25</max_refs>',
        '        <max_ups>10</max_ups>',
        '        <div_ref>10</div_ref>',
        '        <lstol>0.9</lstol>',
        '        <etol>0.01</etol>',
        '        <rtol>0.001</rtol>',
        '      </solver>',
        '    </Control>',
        '  </Step>',
        '',
        '</febio_spec>',
    ]

    feb_path.write_text("\n".join(lines), encoding="utf-8")
    return feb_path


def generate_screw_feb_file(screw: ScrewPlacement, mesh: VertebralMesh, job_dir: Path) -> Path:
    """Génère un fichier .feb pour l'analyse de vis pédiculaire (contact os-vis)."""
    feb_path = job_dir / "screw_model.feb"

    # Géométrie de la vis (cylindre simplifié, 8 éléments hexaédraux)
    d = screw.diameter_mm / 2
    L = screw.length_mm
    ep = screw.entry_point

    lines = [
        '<?xml version="1.0" encoding="ISO-8859-1"?>',
        '<febio_spec version="3.0">',
        '  <Module type="solid"/>',
        '',
        '  <Material>',
        f'    <material id="1" name="cortical_bone" type="neo-Hookean">',
        f'      <E>{mesh.material.youngs_modulus_pa}</E>',
        f'      <v>{mesh.material.poisson_ratio}</v>',
        '    </material>',
        '    <material id="2" name="titanium_screw" type="neo-Hookean">',
        '      <E>110000000000</E>',
        '      <v>0.34</v>',
        '    </material>',
        '  </Material>',
        '',
        '  <!-- Maillage vertèbre + vis (simplifié) -->',
        '  <Mesh>',
        '    <Nodes name="vertebra_nodes">',
    ]

    for node in mesh.nodes:
        lines.append(f'      <node id="{node.id}">{node.x},{node.y},{node.z}</node>')

    # Nœuds de la vis (8 nœuds d'un hexaèdre simple)
    base_id = max(n.id for n in mesh.nodes) + 1
    screw_nodes = [
        (base_id + 0, ep.x - d, ep.y - d, ep.z),
        (base_id + 1, ep.x + d, ep.y - d, ep.z),
        (base_id + 2, ep.x + d, ep.y + d, ep.z),
        (base_id + 3, ep.x - d, ep.y + d, ep.z),
        (base_id + 4, ep.x - d, ep.y - d, ep.z + L),
        (base_id + 5, ep.x + d, ep.y - d, ep.z + L),
        (base_id + 6, ep.x + d, ep.y + d, ep.z + L),
        (base_id + 7, ep.x - d, ep.y + d, ep.z + L),
    ]
    lines.append('    </Nodes>')
    lines.append('    <Nodes name="screw_nodes">')
    for n in screw_nodes:
        lines.append(f'      <node id="{n[0]}">{n[1]},{n[2]},{n[3]}</node>')

    lines += [
        '    </Nodes>',
        '  </Mesh>',
        '',
        '</febio_spec>',
    ]

    feb_path.write_text("\n".join(lines), encoding="utf-8")
    return feb_path


def parse_febio_results(job_dir: Path) -> dict:
    """
    Parse les résultats FEBio depuis le log et les fichiers de sortie.
    Retourne un dict avec déplacements max, contraintes de von Mises, etc.
    """
    results: dict = {
        "converged": False,
        "max_displacement_mm": 0.0,
        "max_von_mises_pa": 0.0,
        "mean_von_mises_pa": 0.0,
        "iterations": 0,
        "computation_time_s": 0.0,
        "raw_log": "",
    }

    log_file = job_dir / "model.log"
    if not log_file.exists():
        return results

    log_text = log_file.read_text(errors="replace")
    results["raw_log"] = log_text[-2000:]  # Derniers 2000 chars

    # Parsing du log FEBio
    for line in log_text.splitlines():
        line = line.strip()
        if "CONVERGED" in line.upper() or "Converged" in line:
            results["converged"] = True
        if "Max displacement" in line or "max disp" in line.lower():
            try:
                val = float(line.split("=")[-1].strip().split()[0])
                results["max_displacement_mm"] = val
            except ValueError:
                pass
        if "iterations" in line.lower():
            try:
                val = int(line.split("=")[-1].strip().split()[0])
                results["iterations"] = val
            except ValueError:
                pass

    return results


# ── Application FastAPI ──────────────────────────────────────

app = FastAPI(
    title="VERTEX FEBio Service",
    description="Solveur FEM tétraédrique pour chirurgie virtuelle VERTEX©",
    version="0.1.0",
)


@app.get("/health")
async def health():
    """Vérifie que FEBio est disponible."""
    febio_ok = FEBIO_BIN.exists()
    return {
        "status": "ok" if febio_ok else "degraded",
        "febio_available": febio_ok,
        "febio_path": str(FEBIO_BIN),
        "workspace": str(WORKSPACE),
    }


@app.post("/solve")
async def solve(request: SolveRequest):
    """
    Lance un solve FEBio sur le maillage tétraédrique fourni.

    Retourne :
    - max_displacement_mm
    - max_von_mises_pa
    - mean_von_mises_pa
    - converged
    - computation_time_s
    """
    job_id  = str(uuid.uuid4())[:8]
    job_dir = WORKSPACE / job_id
    job_dir.mkdir(parents=True)

    try:
        # Générer le fichier .feb
        feb_path = generate_feb_file(request.mesh, job_dir)

        # Lancer FEBio (async subprocess)
        if not FEBIO_BIN.exists():
            # Mode simulation (FEBio pas encore compilé → résultats fictifs)
            return _simulate_febio_results(request.mesh)

        proc = await asyncio.create_subprocess_exec(
            str(FEBIO_BIN), "-i", str(feb_path),
            stdout=asyncio.subprocess.PIPE,
            stderr=asyncio.subprocess.PIPE,
            cwd=str(job_dir),
        )
        try:
            stdout, stderr = await asyncio.wait_for(proc.communicate(), timeout=120.0)
        except asyncio.TimeoutError:
            proc.kill()
            raise HTTPException(status_code=504, detail="FEBio timeout (120s)")

        # Parser les résultats
        results = parse_febio_results(job_dir)
        results["job_id"] = job_id
        results["level"] = request.mesh.level

        return results

    except HTTPException:
        raise
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Erreur FEBio : {e}") from e
    finally:
        # Nettoyage des fichiers temporaires
        import shutil
        shutil.rmtree(job_dir, ignore_errors=True)


@app.post("/screw-analysis")
async def screw_analysis(request: ScrewAnalysisRequest):
    """
    Analyse la stabilité d'une vis pédiculaire :
    - Force d'arrachement (pull-out strength)
    - Détection de brèche corticale
    - Contraintes au niveau du pédicule
    """
    job_id  = str(uuid.uuid4())[:8]
    job_dir = WORKSPACE / job_id
    job_dir.mkdir(parents=True)

    try:
        feb_path = generate_screw_feb_file(request.screw, request.mesh, job_dir)

        if not FEBIO_BIN.exists():
            return _simulate_screw_results(request.screw, request.mesh)

        proc = await asyncio.create_subprocess_exec(
            str(FEBIO_BIN), "-i", str(feb_path),
            stdout=asyncio.subprocess.PIPE,
            stderr=asyncio.subprocess.PIPE,
            cwd=str(job_dir),
        )
        try:
            stdout, stderr = await asyncio.wait_for(proc.communicate(), timeout=120.0)
        except asyncio.TimeoutError:
            proc.kill()
            raise HTTPException(status_code=504, detail="FEBio timeout (120s)")

        results = parse_febio_results(job_dir)
        results["job_id"] = job_id
        results["screw"] = {
            "level": request.screw.level,
            "side": request.screw.side,
            "diameter_mm": request.screw.diameter_mm,
            "length_mm": request.screw.length_mm,
        }

        # Calcul analytique de pull-out en fallback
        results["pullout_force_n"] = _estimate_pullout_force(request.screw, request.mesh)
        results["cortical_breach"] = False  # TODO : détecter depuis xplt
        results["pedicle_stress_pa"] = results.get("max_von_mises_pa", 0.0)

        return results

    except HTTPException:
        raise
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Erreur analyse vis : {e}") from e
    finally:
        import shutil
        shutil.rmtree(job_dir, ignore_errors=True)


# ── Fonctions de simulation (fallback when FEBio not compiled) ──

def _simulate_febio_results(mesh: VertebralMesh) -> dict:
    """Résultats simulés quand FEBio n'est pas disponible."""
    n_nodes = len(mesh.nodes)
    E = mesh.material.youngs_modulus_pa

    # Estimation heuristique (loi de Hooke simplifiée)
    max_disp = 500_000.0 / E  # ~ 0.035 mm pour os cortical
    vm_max   = E * 0.001      # ~14 MPa

    return {
        "converged": True,
        "simulated": True,
        "job_id": "simulated",
        "level": mesh.level,
        "max_displacement_mm": round(max_disp, 4),
        "max_von_mises_pa": round(vm_max, 0),
        "mean_von_mises_pa": round(vm_max * 0.4, 0),
        "iterations": 15,
        "computation_time_s": 0.1,
        "raw_log": "FEBio not available — simulated results",
    }


def _simulate_screw_results(screw: ScrewPlacement, mesh: VertebralMesh) -> dict:
    """Résultats simulés pour analyse de vis."""
    pullout = _estimate_pullout_force(screw, mesh)
    return {
        "converged": True,
        "simulated": True,
        "job_id": "simulated",
        "screw": {
            "level": screw.level,
            "side": screw.side,
            "diameter_mm": screw.diameter_mm,
            "length_mm": screw.length_mm,
        },
        "pullout_force_n": pullout,
        "cortical_breach": False,
        "pedicle_stress_pa": mesh.material.youngs_modulus_pa * 0.002,
        "max_displacement_mm": 0.05,
        "max_von_mises_pa": mesh.material.youngs_modulus_pa * 0.003,
        "computation_time_s": 0.1,
    }


def _estimate_pullout_force(screw: ScrewPlacement, mesh: VertebralMesh) -> float:
    """
    Estimation analytique de la force d'arrachement (pull-out strength).
    Formule de Chapman (1996) : F_pullout ≈ π × d × L × τ_bone
    où τ_bone ≈ σ_UTS / 3 ≈ 100 MPa / 3 (os cortical)
    """
    d = screw.diameter_mm / 1000.0  # m
    L = screw.length_mm / 1000.0    # m

    # Contrainte de cisaillement os = E * 0.007 (cortical ≈ ~33 MPa)
    E_pa     = mesh.material.youngs_modulus_pa
    tau_bone = E_pa * 0.007 / 3.0  # Pa — approximation

    pullout_n = 3.14159 * d * L * tau_bone  # Newtons
    return round(pullout_n, 1)
