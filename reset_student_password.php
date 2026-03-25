<?php
/**
 * VERTEX© — Réinitialise le mot de passe d'un utilisateur
 * Usage : php reset_student_password.php
 */
define('CLI_SCRIPT', true);
require(__DIR__ . '/config.php');

$email    = 'aryad2006@gmail.com';
$new_pass = 'Vertex2026!';

$user = $DB->get_record('user', ['email' => $email, 'deleted' => 0]);
if (!$user) {
    echo "[ERREUR] Utilisateur introuvable : $email\n";
    exit(1);
}

// Mettre à jour le mot de passe
$user->password = hash_internal_user_password($new_pass);
$user->auth = 'manual';
$user->confirmed = 1;
$DB->update_record('user', $user);

echo "[OK] Mot de passe réinitialisé\n";
echo "  Email    : $email\n";
echo "  Password : $new_pass\n";
echo "  Nom      : {$user->firstname} {$user->lastname}\n";
