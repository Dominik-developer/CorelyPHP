<?php

session_start();

if (!isset($_SESSION['adminLoged'])) {
    header('Location: panel.login.php');
    exit();
}

function edit_dataLoading($articleID) {
    require 'panel.connect.php';

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno) {
        $_SESSION['message'] = 'connection to db fail';
        header('Location: panel.php?window=edit-article');
        exit(); 
    } else {
        $sql = "SELECT * FROM articles WHERE id = $articleID";
        $result = $conn->query($sql); 

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $conn->close();
            return $row; 
            
        } else {
            $_SESSION['message'] = 'No data found. Database empty.';
            $conn->close();
            return null; 
        }
    }
}





