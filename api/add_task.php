<?php
require_once 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit(json_encode(['error' => 'Only POST allowed']));
}

$task = trim($_POST['task_name'] ?? '');
if ($task === '') {
    http_response_code(400);
    exit(json_encode(['error' => 'Task name required']));
}

$stmt = $pdo->prepare('INSERT INTO tasks (task_name) VALUES (?)');
$stmt->execute([$task]);

echo json_encode([
    'id'        => $pdo->lastInsertId(),
    'task_name' => htmlspecialchars($task)
]);
?>