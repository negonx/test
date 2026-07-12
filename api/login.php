<?php
ob_start();
header('Content-Type: application/json; charset=utf-8');

try {
    require_once __DIR__.'/../config/bootstrap.php';
    require_once __DIR__.'/controles/login.php';

    $user = $_POST['username'] ?? $_GET['username'] ?? null;
    $pass = $_POST['password'] ?? $_GET['password'] ?? null;

    if (!$user || !$pass) {
        echo json_encode([
            'title'=>'Usuário e senha obrigatórios',
            'icon'=>'error'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    echo json_encode(login($user,$pass), JSON_UNESCAPED_UNICODE);
    exit;

} catch (Throwable $e) {

    echo json_encode([
        'title'=>'Erro interno',
        'icon'=>'error',
        'message'=>$e->getMessage()
    ], JSON_UNESCAPED_UNICODE);

    exit;
}
