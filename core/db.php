<?php
mysqli_report(MYSQLI_REPORT_OFF); // to turn off those big stupid warnings

include('config/database.php');

function handleDatabaseError($message = 'Database connection failed.') {

    http_response_code(500);
    $error_message = htmlspecialchars($message);
    include '../public/errors/500.php';
    exit;
}

$conn = db_connect();

function row_count($result) {

    global $conn;

    return mysqli_num_rows($result);
}

function escape($string) {

    global $conn;

    return mysqli_real_escape_string($conn, $string);
}

function query($query) {

    global $conn;

    return mysqli_query($conn, $query);
}

function confirm($result) {

    global $conn;

    if(!$result) {
        handleDatabaseError('Database query failed: ' . mysqli_error($conn));
    }
}

function fetch_array($result) {

    global $conn;   

    return mysqli_fetch_array( $result);
}
