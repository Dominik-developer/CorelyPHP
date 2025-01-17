<?php

session_start();

if(!isset ($_SESSION['adminLoged']))
{
    header('Location: ../panel.login.php');
    exit();
}

//additional files
require '../panel.connect.php';


$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if (isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['newPassAgain'])) {

    if ($_POST['newPass'] == $_POST['newPassAgain']) {

        if ($conn->connect_errno!=0) {
            $_SESSION['message'] = 'connection to db fail';
            #echo 'Error: '.$conn->connect_error;
            header('Location: ../panel.php?window=settings');
            exit();
        }else{

            $ID = $_SESSION['id'];
    
            $sql = "SELECT `password` FROM `admin` WHERE id = '$ID' ";
    
            if($result = @$conn->query(sprintf($sql)))
            {
                $num = $result->num_rows;
    
                if($num >0)
                {
                    $row = $result->fetch_assoc();

                    if (password_verify($_POST['oldPass'], $row['password'])) {

                        $new_password = $_POST['newPass'];
                        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                        $sql = "UPDATE `admin` SET `password` = ? WHERE `id` = ?";
                        $stmt = $conn->prepare($sql);

                        if (!$stmt) {
                            die("Błąd przygotowania zapytania: " . $conn->error);
                        }

                        $stmt->bind_param("si", $password_hash, $ID);

                        if ($stmt->execute()) {
                            $_SESSION['message'] = 'Password changed successfully.';
                            header('Location: ../panel.php?window=settings');
                        } else {
                            $_SESSION['message'] = 'Error: something went wrong during updating password.<br>'. $stmt->error;
                        }

                        $stmt->close();
                        $conn->close();

                    } else {
                        $_SESSION['message'] = 'Old password is wrong';
                        header('Location: ../panel.php?window=settings');
                    }

                } else {
                    $_SESSION['message'] = 'more rows found than needed';
                    header('Location: ../panel.php?window=settings');
                }
            }
            $conn->close();
            exit();
        }
    } else {
        $_SESSION['message'] = 'new password different than one written again ';
        header('Location: ../panel.php?window=settings');
        exit();   
    }

} else {
    $_SESSION['message'] = 'POST table doesnt have all data';
    header('Location: panel.php?window=settings');
    exit(); 
}