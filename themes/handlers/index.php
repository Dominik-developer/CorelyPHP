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

function getAvailableThemes(): array {
    $themesDir = dirname(__DIR__) . '/'; // one higher: "themes/"
    
    if (!is_dir($themesDir)) {
        return [];
    }

    $themes = array_filter(scandir($themesDir), function($folder) use ($themesDir) {
        return is_dir($themesDir . $folder) && 
               !in_array($folder, ['.', '..', 'handlers']);
    });

    //print_r(array_values($themes));

    return array_values($themes); // reset indexes
}
