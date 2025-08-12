<?php
require_once 'db.php';
$rows = $pdo->query('SELECT id, task_name FROM tasks ORDER BY id DESC')->fetchAll();
header('Content-Type: application/json');
echo json_encode($rows);
?>