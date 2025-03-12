<?php


function themeChecker(): string {

    require 'connect.php'; 

    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM settings WHERE name = 'active_theme' ";
    $stmt = $conn->prepare($query); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $result = $row['value'];

        return $result;
    } else {
        return 'default';
    }
}