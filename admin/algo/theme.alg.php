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

function updateUserTheme($newTheme): void {

    require '../panel.connect.php';

    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno) {
        $_SESSION['message'] = 'Connection failed: '.$conn->connect_error;
        header('Location: ../panel.php?window=themes');
        exit();
    }
 
    $query = "UPDATE `settings` SET `value` = ? WHERE `name` = 'active_theme'";
    
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        $_SESSION['message'] = 'Error prep query: '.$conn->error;
        header('Location: ../panel.php?window=themes');
        exit();
    }

    $stmt->bind_param("s", $newTheme);
    if (!$stmt->execute()) {
        $_SESSION['message'] = 'Error during query: '.$stmt->error;
        header('Location: ../panel.php?window=themes');
        exit();
    }

    $stmt->close();
    $conn->close();
}

include dirname(__DIR__, 2) . '/themes/handlers/index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['theme'])) {
    $newTheme = $_POST['theme'];
    
    if (in_array($newTheme, getAvailableThemes())) {

        updateUserTheme($newTheme);

        $_SESSION['message'] = 'Theme changed to: '.htmlspecialchars($newTheme);
        header('Location: ../panel.php?window=themes');
        exit();
    } else {
        $_SESSION['message'] = 'Invalid theme!';
        header('Location: ../panel.php?window=themes');
        exit();
    }
}
