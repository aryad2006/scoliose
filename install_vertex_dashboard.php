<?php
/**
 * VERTEX© — Installation du bloc Dashboard Admin
 * Crée le plugin block_vertex_dashboard et l'ajoute à la page d'accueil.
 *
 * Usage : php install_vertex_dashboard.php
 * Exécuter depuis la racine Moodle : ~/sites/doctraining.ma/
 */

define('CLI_SCRIPT', true);
require(__DIR__ . '/config.php');

$blocks_dir = $CFG->dirroot . '/blocks/vertex_dashboard';

// ─── 1. Créer les fichiers du bloc ───────────────────────────────────────────

@mkdir($blocks_dir, 0755, true);
@mkdir($blocks_dir . '/lang/fr', 0755, true);

// version.php
file_put_contents($blocks_dir . '/version.php', '<?php
defined(\'MOODLE_INTERNAL\') || die();
$plugin->version   = 2026032501;
$plugin->requires  = 2022041900;
$plugin->component = \'block_vertex_dashboard\';
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = \'1.0\';
');

// lang/fr/block_vertex_dashboard.php
file_put_contents($blocks_dir . '/lang/fr/block_vertex_dashboard.php', '<?php
defined(\'MOODLE_INTERNAL\') || die();
$string[\'pluginname\'] = \'VERTEX© Dashboard Admin\';
$string[\'vertex_dashboard:addinstance\'] = \'Ajouter le bloc Dashboard Admin\';
$string[\'vertex_dashboard:myaddinstance\'] = \'Ajouter le bloc Dashboard Admin au tableau de bord\';
');

// block_vertex_dashboard.php
file_put_contents($blocks_dir . '/block_vertex_dashboard.php', '<?php
defined(\'MOODLE_INTERNAL\') || die();

class block_vertex_dashboard extends block_base {

    public function init() {
        $this->title = \'VERTEX© Admin\';
    }

    public function applicable_formats() {
        return [\'site-index\' => true, \'my\' => true];
    }

    public function get_content() {
        global $DB, $CFG, $OUTPUT;

        if (!is_siteadmin()) {
            $this->content = new stdClass();
            $this->content->text = \'\';
            return $this->content;
        }

        if ($this->content !== null) {
            return $this->content;
        }

        // ── Stats globales ──
        $total_users   = $DB->count_records_select(\'user\', \'deleted = 0 AND confirmed = 1 AND id > 1\');
        $week_ago      = time() - 7 * 24 * 3600;
        $new_users     = $DB->count_records_select(\'user\', \'timecreated > ? AND deleted = 0 AND confirmed = 1 AND id > 1\', [$week_ago]);
        $total_courses = $DB->count_records_select(\'course\', \'id > 1\');
        $total_enrols  = $DB->count_records_select(\'user_enrolments\', \'status = 0\');

        // ── Coupons (plugin vertex_coupons) ──
        $coupons_total  = 0;
        $coupons_used   = 0;
        $coupons_active = 0;
        if ($DB->get_manager()->table_exists(\'local_vertex_coupons\')) {
            $coupons_total  = $DB->count_records(\'local_vertex_coupons\');
            $coupons_used   = $DB->count_records(\'local_vertex_coupons\', [\'status\' => \'used\']);
            $coupons_active = $DB->count_records(\'local_vertex_coupons\', [\'status\' => \'active\']);
        }

        // ── 5 derniers inscrits ──
        $recent_users = $DB->get_records_sql(
            "SELECT u.id, u.firstname, u.lastname, u.email, u.timecreated
             FROM {user} u
             WHERE u.deleted = 0 AND u.confirmed = 1 AND u.id > 1
             ORDER BY u.timecreated DESC
             LIMIT 5"
        );

        // ── Inscrits par cours ──
        $course_stats = $DB->get_records_sql(
            "SELECT c.id, c.fullname, COUNT(ue.id) as enrolled
             FROM {course} c
             LEFT JOIN {enrol} e ON e.courseid = c.id
             LEFT JOIN {user_enrolments} ue ON ue.enrolid = e.id AND ue.status = 0
             WHERE c.id > 1
             GROUP BY c.id, c.fullname
             ORDER BY enrolled DESC, c.fullname"
        );

        // ── HTML ──
        ob_start();
        ?>
        <style>
        .vx-dashboard { font-family: \'Segoe UI\', Arial, sans-serif; color: #1a1a2e; }
        .vx-stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 20px; }
        .vx-stat-card { background: linear-gradient(135deg, #1565C0, #1976D2); color: white; border-radius: 10px; padding: 14px 16px; text-align: center; }
        .vx-stat-card.green  { background: linear-gradient(135deg, #2E7D32, #388E3C); }
        .vx-stat-card.orange { background: linear-gradient(135deg, #E65100, #F57C00); }
        .vx-stat-card.purple { background: linear-gradient(135deg, #6A1B9A, #8E24AA); }
        .vx-stat-num { font-size: 2em; font-weight: 700; line-height: 1; }
        .vx-stat-label { font-size: 0.78em; opacity: 0.9; margin-top: 4px; }
        .vx-shortcuts { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 20px; }
        .vx-btn { display: block; text-align: center; padding: 10px 8px; border-radius: 8px; text-decoration: none !important; font-size: 0.85em; font-weight: 600; transition: opacity .2s; }
        .vx-btn:hover { opacity: 0.85; }
        .vx-btn-blue   { background: #E3F2FD; color: #1565C0 !important; border: 1px solid #90CAF9; }
        .vx-btn-green  { background: #E8F5E9; color: #2E7D32 !important; border: 1px solid #A5D6A7; }
        .vx-btn-orange { background: #FFF3E0; color: #E65100 !important; border: 1px solid #FFCC80; }
        .vx-section-title { font-size: 0.9em; font-weight: 700; color: #1565C0; text-transform: uppercase; letter-spacing: .5px; margin: 16px 0 8px; border-bottom: 2px solid #E3F2FD; padding-bottom: 4px; }
        .vx-table { width: 100%; border-collapse: collapse; font-size: 0.82em; }
        .vx-table th { background: #F5F5F5; padding: 6px 8px; text-align: left; font-weight: 600; color: #555; }
        .vx-table td { padding: 5px 8px; border-bottom: 1px solid #F0F0F0; }
        .vx-table tr:last-child td { border-bottom: none; }
        .vx-badge { display: inline-block; padding: 2px 8px; border-radius: 12px; font-size: 0.8em; font-weight: 600; }
        .vx-badge-blue { background: #E3F2FD; color: #1565C0; }
        .vx-badge-green { background: #E8F5E9; color: #2E7D32; }
        </style>

        <div class="vx-dashboard">

          <!-- Stats -->
          <div class="vx-stats">
            <div class="vx-stat-card">
              <div class="vx-stat-num"><?= $total_users ?></div>
              <div class="vx-stat-label">Praticiens inscrits</div>
            </div>
            <div class="vx-stat-card green">
              <div class="vx-stat-num">+<?= $new_users ?></div>
              <div class="vx-stat-label">Nouveaux cette semaine</div>
            </div>
            <div class="vx-stat-card orange">
              <div class="vx-stat-num"><?= $total_courses ?></div>
              <div class="vx-stat-label">Formations actives</div>
            </div>
            <div class="vx-stat-card purple">
              <div class="vx-stat-num"><?= $total_enrols ?></div>
              <div class="vx-stat-label">Inscriptions totales</div>
            </div>
          </div>

          <!-- Raccourcis -->
          <div class="vx-section-title">⚡ Raccourcis</div>
          <div class="vx-shortcuts">
            <a href="<?= $CFG->wwwroot ?>/local/vertex_coupons/admin.php" class="vx-btn vx-btn-blue">🎟️ Gérer les coupons<br><small><?= $coupons_active ?> actifs · <?= $coupons_used ?> utilisés</small></a>
            <a href="<?= $CFG->wwwroot ?>/local/vertex_coupons/enroll_direct.php" class="vx-btn vx-btn-green">➕ Inscrire un praticien</a>
            <a href="<?= $CFG->wwwroot ?>/local/vertex_coupons/subscribers.php" class="vx-btn vx-btn-orange">👥 Voir les abonnés</a>
            <a href="<?= $CFG->wwwroot ?>/admin/user.php" class="vx-btn vx-btn-blue">👤 Gestion utilisateurs</a>
            <a href="<?= $CFG->wwwroot ?>/report/log/index.php" class="vx-btn vx-btn-blue">📊 Rapports activité</a>
            <a href="<?= $CFG->wwwroot ?>/admin/index.php" class="vx-btn vx-btn-orange">⚙️ Administration</a>
          </div>

          <!-- Derniers inscrits -->
          <div class="vx-section-title">🆕 Derniers praticiens inscrits</div>
          <table class="vx-table">
            <tr><th>Nom</th><th>Email</th><th>Date</th></tr>
            <?php foreach ($recent_users as $u): ?>
            <tr>
              <td><a href="<?= $CFG->wwwroot ?>/user/profile.php?id=<?= $u->id ?>"><?= htmlspecialchars($u->firstname . \' \' . $u->lastname) ?></a></td>
              <td><?= htmlspecialchars($u->email) ?></td>
              <td><?= date(\'d/m/Y\', $u->timecreated) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($recent_users)): ?>
            <tr><td colspan="3" style="text-align:center;color:#999;">Aucun praticien inscrit</td></tr>
            <?php endif; ?>
          </table>

          <!-- Formations -->
          <div class="vx-section-title">📚 Inscrits par formation</div>
          <table class="vx-table">
            <tr><th>Formation</th><th>Inscrits</th></tr>
            <?php foreach ($course_stats as $c): ?>
            <tr>
              <td><a href="<?= $CFG->wwwroot ?>/course/view.php?id=<?= $c->id ?>"><?= htmlspecialchars($c->fullname) ?></a></td>
              <td><span class="vx-badge <?= $c->enrolled > 0 ? \'vx-badge-green\' : \'vx-badge-blue\' ?>"><?= (int)$c->enrolled ?></span></td>
            </tr>
            <?php endforeach; ?>
          </table>

        </div>
        <?php
        $html = ob_get_clean();

        $this->content = new stdClass();
        $this->content->text = $html;
        return $this->content;
    }
}
');

echo "[OK] Fichiers du bloc créés dans $blocks_dir\n";

// ─── 2. Enregistrer le bloc en base ──────────────────────────────────────────

$existing = $DB->get_record('block', ['name' => 'vertex_dashboard']);
if (!$existing) {
    $DB->insert_record('block', [
        'name'        => 'vertex_dashboard',
        'cron'        => 0,
        'lastcron'    => 0,
        'visible'     => 1,
    ]);
    echo "[OK] Bloc enregistré en base\n";
} else {
    echo "[INFO] Bloc déjà enregistré (id={$existing->id})\n";
}

// ─── 3. Ajouter le bloc à la page d'accueil (si pas déjà présent) ────────────

// Contexte de la page d'accueil (contextlevel=10, instanceid=1)
$frontpage_context = $DB->get_record('context', ['contextlevel' => 10, 'instanceid' => 1]);
if (!$frontpage_context) {
    echo "[ERREUR] Contexte page d'accueil introuvable\n";
    exit(1);
}

$existing_block = $DB->get_record('block_instances', [
    'blockname'     => 'vertex_dashboard',
    'parentcontextid' => $frontpage_context->id,
]);

if (!$existing_block) {
    $block_instance = (object)[
        'blockname'          => 'vertex_dashboard',
        'parentcontextid'    => $frontpage_context->id,
        'showinsubcontexts'  => 0,
        'requiredbytheme'    => 0,
        'pagetypepattern'    => 'site-index',
        'subpagepattern'     => null,
        'defaultregion'      => 'content',
        'defaultweight'      => -10,
        'configdata'         => '',
        'timecreated'        => time(),
        'timemodified'       => time(),
    ];
    $bid = $DB->insert_record('block_instances', $block_instance);

    // Créer le contexte du bloc
    $DB->insert_record('context', [
        'contextlevel' => 80,
        'instanceid'   => $bid,
        'path'         => $frontpage_context->path . '/' . $bid,
        'depth'        => $frontpage_context->depth + 1,
    ]);

    echo "[OK] Bloc ajouté à la page d'accueil (id=$bid)\n";
} else {
    echo "[INFO] Bloc déjà présent sur la page d'accueil\n";
}

// ─── 4. Vider le cache ───────────────────────────────────────────────────────
purge_all_caches();
echo "[OK] Cache vidé\n";

echo "\n=== Dashboard admin installé avec succès ===\n";
echo "Visiter : https://doctraining.ma/\n";
