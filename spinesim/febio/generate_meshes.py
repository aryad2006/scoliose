"""
VERTEX© — Génération des maillages tétraédriques vertébraux avec Gmsh.

Usage :
    python generate_meshes.py [levels...]

    Exemples :
        python generate_meshes.py                  # Tous les niveaux C3-S1
        python generate_meshes.py L1 L2 L3 L4 L5  # Seulement les lombaires

Résultats :
    meshes/<level>.msh   — maillage Gmsh natif
    meshes/<level>.json  — maillage JSON (nœuds + éléments) pour l'API FEBio

Dépendances :
    pip install gmsh numpy
"""

import json
import sys
from pathlib import Path

# Dimensions morphologiques vertébrales (mm) — source : littérature (Panjabi 1991)
# Format : { level: { width, depth, height, pedicle_width, pedicle_height } }
VERTEBRA_DIMS: dict[str, dict[str, float]] = {
    # Cervicale
    "C3": {"width": 38, "depth": 28, "height": 14, "pedicle_width": 5.5, "pedicle_height": 7.0},
    "C4": {"width": 40, "depth": 28, "height": 14, "pedicle_width": 5.7, "pedicle_height": 7.0},
    "C5": {"width": 42, "depth": 29, "height": 15, "pedicle_width": 6.0, "pedicle_height": 7.2},
    "C6": {"width": 44, "depth": 29, "height": 15, "pedicle_width": 6.2, "pedicle_height": 7.3},
    "C7": {"width": 46, "depth": 30, "height": 16, "pedicle_width": 7.0, "pedicle_height": 7.5},
    # Thoracique
    "T1": {"width": 46, "depth": 30, "height": 17, "pedicle_width": 7.5, "pedicle_height": 9.0},
    "T2": {"width": 45, "depth": 31, "height": 18, "pedicle_width": 7.0, "pedicle_height": 9.5},
    "T3": {"width": 44, "depth": 31, "height": 19, "pedicle_width": 6.8, "pedicle_height": 9.5},
    "T4": {"width": 43, "depth": 32, "height": 19, "pedicle_width": 6.5, "pedicle_height": 9.8},
    "T5": {"width": 43, "depth": 32, "height": 20, "pedicle_width": 6.5, "pedicle_height": 10.0},
    "T6": {"width": 43, "depth": 32, "height": 20, "pedicle_width": 6.7, "pedicle_height": 10.0},
    "T7": {"width": 44, "depth": 33, "height": 21, "pedicle_width": 7.0, "pedicle_height": 10.2},
    "T8": {"width": 44, "depth": 33, "height": 21, "pedicle_width": 7.5, "pedicle_height": 10.5},
    "T9": {"width": 44, "depth": 33, "height": 22, "pedicle_width": 7.8, "pedicle_height": 10.8},
    "T10": {"width": 45, "depth": 34, "height": 22, "pedicle_width": 8.2, "pedicle_height": 11.0},
    "T11": {"width": 47, "depth": 35, "height": 23, "pedicle_width": 9.5, "pedicle_height": 11.5},
    "T12": {"width": 48, "depth": 35, "height": 24, "pedicle_width": 9.8, "pedicle_height": 12.0},
    # Lombaire
    "L1": {"width": 42, "depth": 32, "height": 26, "pedicle_width": 8.7, "pedicle_height": 12.0},
    "L2": {"width": 44, "depth": 33, "height": 27, "pedicle_width": 9.1, "pedicle_height": 12.5},
    "L3": {"width": 47, "depth": 35, "height": 28, "pedicle_width": 11.2, "pedicle_height": 13.0},
    "L4": {"width": 49, "depth": 36, "height": 28, "pedicle_width": 14.3, "pedicle_height": 13.5},
    "L5": {"width": 51, "depth": 37, "height": 27, "pedicle_width": 18.1, "pedicle_height": 13.8},
    # Sacrum (approximé comme 1 vertèbre)
    "S1": {"width": 62, "depth": 50, "height": 26, "pedicle_width": 20.0, "pedicle_height": 15.0},
}


def generate_vertebra_mesh(level: str, dims: dict, output_dir: Path) -> dict | None:
    """
    Génère le maillage tétraédrique d'une vertèbre avec Gmsh.

    Args:
        level    : niveau vertébral (ex: "L3")
        dims     : dimensions morphologiques (mm)
        output_dir: répertoire de sortie

    Returns:
        dict avec les nœuds et éléments (format API), ou None si Gmsh indisponible.
    """
    try:
        import gmsh
    except ImportError:
        print(f"[WARN] gmsh non installé — maillage simplifié pour {level}")
        return _generate_simple_mesh(level, dims)

    output_dir.mkdir(parents=True, exist_ok=True)
    msh_path  = output_dir / f"{level}.msh"
    json_path = output_dir / f"{level}.json"

    gmsh.initialize()
    gmsh.option.setNumber("General.Terminal", 0)  # Supprimer les logs Gmsh
    gmsh.model.add(level)

    try:
        w = dims["width"]  / 2   # demi-largeur (mm)
        d = dims["depth"]  / 2   # demi-profondeur
        h = dims["height"]       # hauteur corps

        # ── Corps vertébral : ellipsoïde aplati ──
        body_tag = gmsh.model.occ.addEllipsoid(0, 0, h / 2, w, d * 0.8, h / 2)

        # ── Pédicules : 2 cylindres latéraux ──
        ped_r = dims["pedicle_width"] / 2
        ped_l = d * 0.7
        peds = []
        for side in (-1, 1):
            x_offset = side * w * 0.55
            cyl = gmsh.model.occ.addCylinder(
                x_offset, 0, h * 0.4,          # point de départ
                0, -ped_l, 0,                   # direction postérieure
                ped_r
            )
            peds.append(cyl)

        # ── Union corps + pédicules ──
        all_tags = [(3, body_tag)] + [(3, p) for p in peds]
        fused, _ = gmsh.model.occ.fuse(all_tags[:1], all_tags[1:])

        gmsh.model.occ.synchronize()

        # ── Paramètres de maillage (élément target ~3 mm) ──
        gmsh.option.setNumber("Mesh.Algorithm3D", 4)  # Frontal-Delaunay
        gmsh.option.setNumber("Mesh.CharacteristicLengthMin", 2.0)
        gmsh.option.setNumber("Mesh.CharacteristicLengthMax", 5.0)
        gmsh.model.mesh.generate(3)  # Maillage 3D (tétraèdres)
        gmsh.model.mesh.optimize("Netgen")

        # Sauvegarder .msh
        gmsh.write(str(msh_path))

        # ── Extraction des nœuds et éléments pour l'API ──
        node_tags, node_coords, _ = gmsh.model.mesh.getNodes()
        n_nodes = len(node_tags)

        nodes = []
        for i, tag in enumerate(node_tags):
            c = node_coords[3 * i: 3 * i + 3]
            nodes.append({"id": int(tag), "x": c[0], "y": c[1], "z": c[2]})

        # Éléments TET4 (type 4 dans Gmsh)
        _, tet_tags, tet_nodes = gmsh.model.mesh.getElements(3)
        elements = []
        if len(tet_tags) > 0 and len(tet_tags[0]) > 0:
            tags  = tet_tags[0]
            conns = tet_nodes[0]
            n_per_elem = 4  # tet4
            for i, tag in enumerate(tags):
                ns = conns[n_per_elem * i: n_per_elem * i + n_per_elem]
                elements.append({
                    "id": int(tag),
                    "type": "tet4",
                    "nodes": [int(n) for n in ns],
                })

        mesh_data = {
            "level": level,
            "dimensions": dims,
            "n_nodes": len(nodes),
            "n_elements": len(elements),
            "nodes": nodes,
            "elements": elements,
            "material": {
                "youngs_modulus_pa": 14_000_000.0,
                "poisson_ratio": 0.3,
                "density_kg_m3": 1900.0,
                "is_cortical": True,
            },
        }

        # Sauvegarder .json
        json_path.write_text(json.dumps(mesh_data, indent=2))
        print(f"  ✅ {level:4s} — {len(nodes):5d} nœuds, {len(elements):6d} éléments → {msh_path.name}")

        return mesh_data

    finally:
        gmsh.finalize()


def _generate_simple_mesh(level: str, dims: dict) -> dict:
    """
    Génère un maillage hexaédral simple (8 nœuds, 1 élément) sans Gmsh.
    Utilisé quand Gmsh n'est pas disponible.
    """
    w = dims["width"]  / 2
    d = dims["depth"]  / 2
    h = dims["height"]

    nodes = [
        {"id": 1, "x": -w, "y": -d, "z": 0},
        {"id": 2, "x":  w, "y": -d, "z": 0},
        {"id": 3, "x":  w, "y":  d, "z": 0},
        {"id": 4, "x": -w, "y":  d, "z": 0},
        {"id": 5, "x": -w, "y": -d, "z": h},
        {"id": 6, "x":  w, "y": -d, "z": h},
        {"id": 7, "x":  w, "y":  d, "z": h},
        {"id": 8, "x": -w, "y":  d, "z": h},
    ]
    elements = [{"id": 1, "type": "hex8", "nodes": [1, 2, 3, 4, 5, 6, 7, 8]}]

    return {
        "level": level,
        "dimensions": dims,
        "n_nodes": 8,
        "n_elements": 1,
        "nodes": nodes,
        "elements": elements,
        "material": {
            "youngs_modulus_pa": 14_000_000.0,
            "poisson_ratio": 0.3,
            "density_kg_m3": 1900.0,
            "is_cortical": True,
        },
        "simplified": True,
    }


def main():
    output_dir = Path(__file__).parent / "meshes"
    output_dir.mkdir(exist_ok=True)

    # Sélection des niveaux
    if len(sys.argv) > 1:
        levels = [a.upper() for a in sys.argv[1:] if a.upper() in VERTEBRA_DIMS]
        if not levels:
            print(f"[ERR] Niveaux invalides. Disponibles : {list(VERTEBRA_DIMS.keys())}")
            sys.exit(1)
    else:
        levels = list(VERTEBRA_DIMS.keys())

    print(f"\n🦴 Génération des maillages vertébraux — {len(levels)} niveaux\n")

    generated = 0
    for level in levels:
        dims = VERTEBRA_DIMS[level]
        result = generate_vertebra_mesh(level, dims, output_dir)
        if result:
            # Sauvegarder le JSON simplifié si Gmsh non dispo
            json_path = output_dir / f"{level}.json"
            if not json_path.exists():
                json_path.write_text(json.dumps(result, indent=2))
                print(f"  📦 {level:4s} — maillage simplifié ({result['n_nodes']} nœuds)")
            generated += 1

    print(f"\n✅ {generated}/{len(levels)} maillages générés dans {output_dir}/\n")


if __name__ == "__main__":
    main()
