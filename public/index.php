<?php

include_once("../core/init.php");


$isAdmin = isset($_SESSION['admin_login']);

// Check maintenance mode
if (!$isAdmin) {
    // 1. Check if flag file exists
    checkMaintenanceMode();

    // 2. Check maintenance status in DB
    $maintenance = getSettingValue('maintenance', 0);

    if ($maintenance == 1) {
        http_response_code(503);
        include __DIR__ . '/../public/errors/503.php';
        exit;
    }
}

?>

<?php include_once "includes/header.php"; ?>

<main>

    our website nigger

    <?php
        $pass = "pass";
        //echo password_hash($pass, PASSWORD_DEFAULT);
    ?>

</main>

<?php include_once "includes/footer.php"; ?>