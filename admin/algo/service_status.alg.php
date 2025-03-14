<?php
declare(strict_types=1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset ($_SESSION['adminLoged']))
{
    header('Location: ../panel.login.php');
    exit();
}

//additional files
require '../panel.connect.php';

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno!=0) {
    $_SESSION['message'] = 'Connection do db fail.';
    header('Location: ../panel.php?window=service-break');
    exit();
}

if (isset($_POST['toggle'])) {

    $setting_id = $_POST['setting_id'];

    $stmt = $conn->prepare("UPDATE `service` SET `service_status` = `service_status` XOR 1 WHERE `id` = ?");
    if ($stmt) {
        $stmt->bind_param('i', $setting_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['message'] = 'Service status value changed successfully.';
                header('Location: ../panel.php?window=service-break');
            } else {
                $_SESSION['message'] = 'Error during updating: row ID error.<!--No rows updated, check the ID.-->';
                header('Location: ../panel.php?window=service-break');
            }
        } else {
            $_SESSION['message'] = 'Something went wrong during updating status.';
            header('Location: ../panel.php?window=service-break');
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = 'Failed to prepare the SQL statement.';
        header('Location: ../panel.php?window=service-break');
    }

} else {
    $_SESSION['message'] = 'Something went wrong, try again.';
    header('Location: ../panel.php?window=service-break');
    exit();
}
