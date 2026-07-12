<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly','1');
    ini_set('session.use_strict_mode','1');
    session_start();
}

function create_user_session($u){
    $_SESSION['id']=$u['id'] ?? 0;
    $_SESSION['admin_id']=$u['id'] ?? 0;
    $_SESSION['username']=$u['usuario'] ?? '';
    $_SESSION['nivel_admin']=$u['nivel_admin'] ?? 0;
    $_SESSION['logged_in_fxtream']=true;
    $_SESSION['logado']=true;
    $_SESSION['authenticated']=true;
}
