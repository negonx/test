<?php
require_once __DIR__.'/../config/security.php';
function require_login(){
 if(empty($_SESSION['logado'])){ header('Location: index.php'); exit; }
}
function user_level(){ return $_SESSION['nivel_admin'] ?? 0; }
?>
