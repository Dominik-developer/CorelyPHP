<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'corely_cms');

function db_connect(): bool|mysqli {

    @$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (!$conn) {
        handleDatabaseError('Failed to connect to database.');
    }
    return $conn;
}

