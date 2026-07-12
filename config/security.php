<?php
if (session_status() === PHP_SESSION_NONE) {
    ini_set("session.cookie_httponly",1);
    ini_set("session.use_strict_mode",1);
    session_start();
}
function secure_headers(){
 if(!headers_sent()){
  header("X-Frame-Options: SAMEORIGIN");
  header("X-Content-Type-Options: nosniff");
 }
}
function secure_session_login(){
    if(session_status() === PHP_SESSION_ACTIVE){
        session_regenerate_id(false);
    }
}
function csrf_token(){ if(empty($_SESSION["csrf"])) $_SESSION["csrf"]=bin2hex(random_bytes(32)); return $_SESSION["csrf"]; }
function verify_csrf($t){ return isset($_SESSION["csrf"]) && hash_equals($_SESSION["csrf"],$t); }
?>
