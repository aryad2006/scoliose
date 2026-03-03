<?php
// Webhook de retour score depuis le backend VERTEX
require('../../config.php');
require_once($CFG->dirroot . '/mod/vertex/lib.php');

// Seules les requêtes POST signées sont acceptées
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['error' => 'Method Not Allowed']));
}

$body = file_get_contents('php://input');
if (empty($body)) {
    http_response_code(400);
    die(json_encode(['error' => 'Empty body']));
}

$data = json_decode($body, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    die(json_encode(['error' => 'Invalid JSON']));
}

// Vérification signature HMAC-SHA256
$secret    = $CFG->vertex_jwt_secret ?? ($CFG->passwordsaltmain ?? 'vertex-dev-secret');
$received  = $_SERVER['HTTP_X_VERTEX_SIGNATURE'] ?? '';
$expected  = hash_hmac('sha256', $body, $secret);
if (!hash_equals($expected, $received)) {
    http_response_code(401);
    die(json_encode(['error' => 'Invalid signature']));
}

// Champs requis
$required = ['vertex_id', 'moodle_user_id', 'surgery_score'];
foreach ($required as $f) {
    if (!isset($data[$f])) {
        http_response_code(422);
        die(json_encode(['error' => "Missing field: $f"]));
    }
}

$vertexId = (int) $data['vertex_id'];
$userId   = (int) $data['moodle_user_id'];

// Vérifier que l'activité existe
if (!$DB->record_exists('vertex', ['id' => $vertexId])) {
    http_response_code(404);
    die(json_encode(['error' => 'Vertex activity not found']));
}

// Enregistrer le score
vertex_receive_score($vertexId, $userId, $data);

http_response_code(200);
echo json_encode(['status' => 'ok', 'vertex_id' => $vertexId, 'user_id' => $userId]);
