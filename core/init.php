<?php
declare(strict_types=1);
session_start();

ob_start();

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include "db.php";
include "functions.php";

?>