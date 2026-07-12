<?php
require_once __DIR__ . '/database.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

try {
    $database = new Database();
    $pdo = $database->connect();
} catch (Throwable $e) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        'status'=>'error',
        'message'=>'Falha na conexão com banco de dados'
    ]);
    exit;
}
