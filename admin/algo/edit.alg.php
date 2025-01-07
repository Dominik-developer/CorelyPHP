<?php

session_start();

if (!isset($_SESSION['adminLoged'])) {
    header('Location: ../panel.login.php');
    exit();
}


function edit() {


    require '../panel.connect.php';

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    // code
    echo 'edit';
    
}