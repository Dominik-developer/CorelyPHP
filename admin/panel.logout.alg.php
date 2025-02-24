<?php
declare(strict_types=1);

session_start();

$_SESSION['adminLoged'] = false;

session_unset();

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0', false);
header('Pragma: no-cache');
header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');

header('Location:panel.login.php');
exit();
