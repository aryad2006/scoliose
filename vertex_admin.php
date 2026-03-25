<?php
/**
 * VERTEX© — Dashboard Admin
 * Accessible via : https://doctraining.ma/vertex_admin.php
 */
require_once(__DIR__ . '/config.php');
require_once($CFG->libdir . '/adminlib.php');

require_login();
require_capability('moodle/site:config', context_system::instance());

$PAGE->set_url(new moodle_url('/vertex_admin.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('VERTEX© Dashboard Admin');
$PAGE->set_heading('VERTEX© Dashboard Admin');
$PAGE->set_pagelayout('admin');

// ── Données ──────────────────────────────────────────────────────────────────

$total_users  = $DB->count_records_select('user', 'deleted = 0 AND confirmed = 1 AND id > 1');
$week_ago     = time() - 7 * 24 * 3600;
$new_users    = $DB->count_records_select('user', 'timecreated > ? AND deleted = 0 AND confirmed = 1 AND id > 1', [$week_ago]);
$month_ago    = time() - 30 * 24 * 3600;
$month_users  = $DB->count_records_select('user', 'timecreated > ? AND deleted = 0 AND confirmed = 1 AND id > 1', [$month_ago]);
$total_enrols = $DB->count_records_select('user_enrolments', 'status = 0');

// Coupons
$coupons_active = 0;
$coupons_used   = 0;
$coupons_total  = 0;
if ($DB->get_manager()->table_exists('local_vertex_coupons')) {
    $coupons_total  = $DB->count_records('local_vertex_coupons');
    $coupons_used   = $DB->count_records('local_vertex_coupons', ['status' => 'used']);
    $coupons_active = $DB->count_records('local_vertex_coupons', ['status' => 'active']);
}

// 10 derniers inscrits
$recent_users = $DB->get_records_sql(
    "SELECT u.id, u.firstname, u.lastname, u.email, u.timecreated, u.lastaccess
     FROM {user} u
     WHERE u.deleted = 0 AND u.confirmed = 1 AND u.id > 1
     ORDER BY u.timecreated DESC
     LIMIT 10"
);

// Inscrits par cours
$course_stats = $DB->get_records_sql(
    "SELECT c.id, c.fullname, c.shortname, COUNT(ue.id) as enrolled,
            MAX(ue.timestart) as last_enrol
     FROM {course} c
     LEFT JOIN {enrol} e ON e.courseid = c.id
     LEFT JOIN {user_enrolments} ue ON ue.enrolid = e.id AND ue.status = 0
     WHERE c.id > 1
     GROUP BY c.id, c.fullname, c.shortname
     ORDER BY enrolled DESC, c.fullname"
);

// ── Rendu ─────────────────────────────────────────────────────────────────────

echo $OUTPUT->header();
?>
<style>
.vx { font-family: 'Segoe UI', Arial, sans-serif; max-width: 1100px; margin: 0 auto; padding: 20px; }
.vx h1 { color: #1565C0; font-size: 1.6em; margin-bottom: 6px; }
.vx-subtitle { color: #666; font-size: 0.9em; margin-bottom: 24px; }
.vx-grid4 { display: grid; grid-template-columns: repeat(4,1fr); gap: 14px; margin-bottom: 28px; }
.vx-card { border-radius: 12px; padding: 18px 16px; color: white; text-align: center; }
.vx-card.blue   { background: linear-gradient(135deg, #1565C0, #42A5F5); }
.vx-card.green  { background: linear-gradient(135deg, #2E7D32, #66BB6A); }
.vx-card.orange { background: linear-gradient(135deg, #BF360C, #FF7043); }
.vx-card.purple { background: linear-gradient(135deg, #4A148C, #AB47BC); }
.vx-card.teal   { background: linear-gradient(135deg, #00695C, #26A69A); }
.vx-card.red    { background: linear-gradient(135deg, #B71C1C, #EF5350); }
.vx-num { font-size: 2.2em; font-weight: 700; line-height: 1; }
.vx-label { font-size: 0.8em; opacity: 0.92; margin-top: 5px; }
.vx-grid3 { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; margin-bottom: 28px; }
.vx-btn { display: block; text-align: center; padding: 12px 10px; border-radius: 10px; text-decoration: none !important; font-size: 0.88em; font-weight: 600; border: 2px solid; transition: all .15s; }
.vx-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.1); }
.vx-btn-blue   { background: #E3F2FD; color: #1565C0 !important; border-color: #90CAF9; }
.vx-btn-green  { background: #E8F5E9; color: #2E7D32 !important; border-color: #A5D6A7; }
.vx-btn-orange { background: #FFF3E0; color: #BF360C !important; border-color: #FFCC80; }
.vx-btn-purple { background: #F3E5F5; color: #6A1B9A !important; border-color: #CE93D8; }
.vx-section { background: white; border-radius: 12px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
.vx-section h2 { font-size: 1em; font-weight: 700; color: #1565C0; text-transform: uppercase; letter-spacing: .5px; margin: 0 0 14px; padding-bottom: 8px; border-bottom: 2px solid #E3F2FD; }
table.vx-table { width: 100%; border-collapse: collapse; font-size: 0.88em; }
.vx-table th { background: #F8F9FA; padding: 8px 10px; text-align: left; font-weight: 600; color: #555; border-bottom: 2px solid #E0E0E0; }
.vx-table td { padding: 7px 10px; border-bottom: 1px solid #F0F0F0; vertical-align: middle; }
.vx-table tr:last-child td { border-bottom: none; }
.vx-table tr:hover td { background: #FAFAFA; }
.badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-size: 0.82em; font-weight: 600; }
.badge-blue   { background: #E3F2FD; color: #1565C0; }
.badge-green  { background: #E8F5E9; color: #2E7D32; }
.badge-orange { background: #FFF3E0; color: #BF360C; }
.badge-gray   { background: #F5F5F5; color: #757575; }
.vx-alert { background: #FFF8E1; border-left: 4px solid #FFC107; padding: 10px 14px; border-radius: 6px; font-size: 0.88em; margin-bottom: 16px; }
</style>

<div class="vx">
  <h1>⚕️ VERTEX© Dashboard Admin</h1>
  <div class="vx-subtitle">doctraining.ma · <?= date('d/m/Y H:i') ?> · Moodle <?= $CFG->release ?></div>

  <?php if (!$total_users): ?>
  <div class="vx-alert">⚠️ Aucun praticien inscrit pour le moment.</div>
  <?php endif; ?>

  <!-- Stats -->
  <div class="vx-grid4">
    <div class="vx-card blue">
      <div class="vx-num"><?= $total_users ?></div>
      <div class="vx-label">Praticiens inscrits</div>
    </div>
    <div class="vx-card green">
      <div class="vx-num">+<?= $new_users ?></div>
      <div class="vx-label">Nouveaux cette semaine</div>
    </div>
    <div class="vx-card orange">
      <div class="vx-num">+<?= $month_users ?></div>
      <div class="vx-label">Nouveaux ce mois</div>
    </div>
    <div class="vx-card purple">
      <div class="vx-num"><?= $total_enrols ?></div>
      <div class="vx-label">Inscriptions aux formations</div>
    </div>
  </div>

  <!-- Coupons -->
  <div class="vx-section">
    <h2>🎟️ Coupons</h2>
    <div class="vx-grid4" style="margin-bottom:0">
      <div class="vx-card teal"><div class="vx-num"><?= $coupons_total ?></div><div class="vx-label">Total créés</div></div>
      <div class="vx-card green"><div class="vx-num"><?= $coupons_active ?></div><div class="vx-label">Actifs (non utilisés)</div></div>
      <div class="vx-card orange"><div class="vx-num"><?= $coupons_used ?></div><div class="vx-label">Utilisés</div></div>
      <div class="vx-card red"><div class="vx-num"><?= $coupons_total - $coupons_active - $coupons_used ?></div><div class="vx-label">Révoqués / Expirés</div></div>
    </div>
  </div>

  <!-- Raccourcis -->
  <div class="vx-section">
    <h2>⚡ Actions rapides</h2>
    <div class="vx-grid3">
      <a href="<?= $CFG->wwwroot ?>/local/vertex_coupons/admin.php" class="vx-btn vx-btn-blue">🎟️ Gérer les coupons</a>
      <a href="<?= $CFG->wwwroot ?>/local/vertex_coupons/enroll_direct.php" class="vx-btn vx-btn-green">➕ Inscrire un praticien</a>
      <a href="<?= $CFG->wwwroot ?>/local/vertex_coupons/subscribers.php" class="vx-btn vx-btn-orange">👥 Voir les abonnés</a>
      <a href="<?= $CFG->wwwroot ?>/admin/user.php" class="vx-btn vx-btn-blue">👤 Gestion utilisateurs</a>
      <a href="<?= $CFG->wwwroot ?>/report/log/index.php?id=1" class="vx-btn vx-btn-purple">📊 Journal d'activité</a>
      <a href="<?= $CFG->wwwroot ?>/admin/index.php" class="vx-btn vx-btn-orange">⚙️ Administration Moodle</a>
    </div>
  </div>

  <!-- Derniers inscrits -->
  <div class="vx-section">
    <h2>🆕 Derniers praticiens inscrits</h2>
    <table class="vx-table">
      <tr><th>Nom</th><th>Email</th><th>Inscription</th><th>Dernière connexion</th><th>Actions</th></tr>
      <?php foreach ($recent_users as $u): ?>
      <tr>
        <td><strong><?= htmlspecialchars($u->firstname . ' ' . $u->lastname) ?></strong></td>
        <td><?= htmlspecialchars($u->email) ?></td>
        <td><span class="badge badge-blue"><?= date('d/m/Y', $u->timecreated) ?></span></td>
        <td><?= $u->lastaccess ? date('d/m/Y H:i', $u->lastaccess) : '<span class="badge badge-gray">Jamais</span>' ?></td>
        <td><a href="<?= $CFG->wwwroot ?>/user/profile.php?id=<?= $u->id ?>">Profil</a> · <a href="<?= $CFG->wwwroot ?>/user/editadvanced.php?id=<?= $u->id ?>">Éditer</a></td>
      </tr>
      <?php endforeach; ?>
      <?php if (empty($recent_users)): ?>
      <tr><td colspan="5" style="text-align:center;color:#999;padding:20px">Aucun praticien inscrit</td></tr>
      <?php endif; ?>
    </table>
  </div>

  <!-- Formations -->
  <div class="vx-section">
    <h2>📚 Praticiens inscrits par formation</h2>
    <table class="vx-table">
      <tr><th>Formation</th><th>Inscrits</th><th>Dernière inscription</th><th></th></tr>
      <?php foreach ($course_stats as $c): ?>
      <tr>
        <td><a href="<?= $CFG->wwwroot ?>/course/view.php?id=<?= $c->id ?>"><?= htmlspecialchars($c->fullname) ?></a></td>
        <td>
          <?php if ($c->enrolled > 0): ?>
            <span class="badge badge-green"><?= (int)$c->enrolled ?></span>
          <?php else: ?>
            <span class="badge badge-gray">0</span>
          <?php endif; ?>
        </td>
        <td><?= $c->last_enrol ? date('d/m/Y', $c->last_enrol) : '—' ?></td>
        <td><a href="<?= $CFG->wwwroot ?>/enrol/users.php?id=<?= $c->id ?>">Gérer</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>

</div>
<?php
echo $OUTPUT->footer();
