<?php
require_once 'db.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit(json_encode(['error'=>'Only POST allowed']));
}

$id        = (int)($_POST['id'] ?? 0);
$task_name = trim($_POST['task_name'] ?? '');
$completed = isset($_POST['completed']) ? (int)$_POST['completed'] : 0;

if (!$id || $task_name === '') {
    http_response_code(400);
    exit(json_encode(['error'=>'Invalid data']));
}

$stmt = $pdo->prepare('UPDATE tasks SET task_name = ?, completed = ? WHERE id = ?');
$stmt->execute([$task_name, $completed, $id]);

echo json_encode(['success'=>true]);
?>