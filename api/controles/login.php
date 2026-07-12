<?php
require_once __DIR__.'/../../auth/session.php';

function login($username,$password){

    global $pdo;

    $username = preg_replace('/[^a-zA-Z0-9_@!%&*#]/','',$username);

    if(!$username || !$password){
        return [
            "title"=>"Usuário ou senha inválidos",
            "icon"=>"error"
        ];
    }

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE user=:u LIMIT 1");
    $stmt->execute([':u'=>$username]);

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$admin){
        return [
            "title"=>"Usuário ou senha incorretos",
            "icon"=>"error"
        ];
    }

    $ok = password_verify($password,$admin['pass']) ||
          hash_equals((string)$admin['pass'],(string)$password);

    if(!$ok){
        return [
            "title"=>"Usuário ou senha incorretos",
            "icon"=>"error"
        ];
    }

    create_user_session([
        'id'=>$admin['id'],
        'usuario'=>$username,
        'nivel_admin'=>$admin['nivel_admin'] ?? 0
    ]);

    $_SESSION['logged_in_fxtream'] = true;
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['username'] = $username;
    $_SESSION['token'] = bin2hex(random_bytes(32));

    if(function_exists('create_user_session')){
        create_user_session([
            'id'=>$admin['id'],
            'usuario'=>$username,
            'nivel_admin'=>$admin['nivel_admin'] ?? 1
        ]);
    }

    $up = $pdo->prepare("UPDATE admin SET token=:t WHERE id=:id");
    $up->execute([
        ':t'=>$_SESSION['token'],
        ':id'=>$admin['id']
    ]);

    return [
        "title"=>"Login efetuado com sucesso",
        "url"=>"clientes.php",
        "icon"=>"success"
    ];
}
