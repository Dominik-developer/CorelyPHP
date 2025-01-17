<?php
session_start();

if (!isset($_SESSION['adminLoged'])) {
    header('Location: ../panel.login.php');
    exit();
}

require '../panel.connect.php';

$conn = new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    $_SESSION['message'] = 'Database connection error.';
    header('Location: ../panel.php?window=edit-article');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit('POST request method required');
}

if (isset($_POST['deleteText']) && isset($_POST['id'])) {
    if ($_POST['deleteText'] === 'Destroy-article') { 

        if (filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
            $articleId = (int)$_POST['id'];

            $sql = "DELETE FROM articles WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $articleId);

                if ($stmt->execute()) {
                    $_SESSION['message'] = 'Article was deleted successfully.';
                    $stmt->close();
                    $conn->close();
                    header('Location: ../panel.php?window=edit-article');
                    exit();
                } else {
                    $_SESSION['message'] = 'Error during deleting article. Try again.';
                }
                $stmt->close();
            } else {
                $_SESSION['message'] = 'Error preparing statement.';
            }
        } else {
            $_SESSION['message'] = 'Invalid article ID.';
        }
    } else {
        $_SESSION['message'] = 'Error in security message. Try again.';
    }
} else {
    $_SESSION['message'] = 'Error. No security message or article ID.';
}

$conn->close();

header('Location: ../panel.php?window=edit-article');
exit();

