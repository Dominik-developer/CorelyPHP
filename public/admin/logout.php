<?php
declare(strict_types=1);

session_start();

//$_SESSION['login'] = false;
$_SESSION = [];

// Usuń ciasteczko sesji
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

// Usuń ciasteczko "login" jeśli istnieje
setcookie('login', '', time() - 3600, '/');

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');

header('Location:login.php');
exit();
