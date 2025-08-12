<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit(json_encode(['error' => 'Only POST allowed']));
}

$id = (int)($_POST['id'] ?? 0);
if (!$id) {
    http_response_code(400);
    exit(json_encode(['error' => 'Invalid id']));
}

$stmt = $pdo->prepare('DELETE FROM tasks WHERE id = ?');
$stmt->execute([$id]);

echo json_encode(['success' => true]);
?>