<?php
session_start();
header('Content-Type: application/json');

echo json_encode([
    'authenticated' => isset($_SESSION['user_id']),
    'user' => isset($_SESSION['user_id']) ? [
        'username' => $_SESSION['username'],
        'role' => $_SESSION['role']
    ] : null
]);
?>