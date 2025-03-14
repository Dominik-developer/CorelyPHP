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

if (isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['newPassAgain'])) {

    if ($_POST['newPass'] == $_POST['newPassAgain']) {

        if ($conn->connect_errno!=0) {
            $_SESSION['message'] = 'Connection to db fail.';
            #echo 'Error: '.$conn->connect_error;
            header('Location: ../panel.php?window=password');
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
                            $_SESSION['message'] = 'Error during prepearing statement:' . $conn->error . '.';
                            header('Location: ../panel.php?window=password');
                        }

                        $stmt->bind_param("si", $password_hash, $ID);

                        if ($stmt->execute()) {
                            $_SESSION['message'] = 'Password changed successfully.';
                            header('Location: ../panel.php?window=password');
                        } else {
                            $_SESSION['message'] = 'Error: something went wrong during updating password.<br>'; //$stmt->error;
                            header('Location: ../panel.php?window=password');
                        }

                        $stmt->close();
                        $conn->close();

                    } else {
                        $_SESSION['message'] = 'Old password is wrong.';
                        header('Location: ../panel.php?window=password');
                    }

                } else {
                    $_SESSION['message'] = 'More rows found than needed.';
                    header('Location: ../panel.php?window=password');
                }
            }
            $conn->close();
            $_SESSION['message'] = 'Error fetching data.';
            header('Location: ../panel.php?window=password');
            exit();
        }
    } else {
        $_SESSION['message'] = 'New password different than one written again.';
        header('Location: ../panel.php?window=password');
        exit();   
    }

} else {
    $_SESSION['message'] = 'POST table doesnt have all data.';
    header('Location: panel.php?window=password');
    exit(); 
}