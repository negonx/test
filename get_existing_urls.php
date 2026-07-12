<?php
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors','0');
error_reporting(0);

try {
    require_once __DIR__ . '/config/database.php';
    $database = new Database();
    $pdo = $database->connect();

    $stmt = $pdo->query("SELECT * FROM streams ORDER BY id DESC LIMIT 500");
    echo json_encode([
        "status"=>"success",
        "total"=>$stmt->rowCount(),
        "data"=>$stmt->fetchAll(PDO::FETCH_ASSOC)
    ]);
} catch (Throwable $e) {
    echo json_encode([
        "status"=>"error",
        "message"=>$e->getMessage()
    ]);
}
exit;
