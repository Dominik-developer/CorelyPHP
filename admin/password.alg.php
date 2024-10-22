<?php

session_start();

if(!isset ($_SESSION['adminLoged']))
{
    header('Location:panel.login.php');
    exit();
}


//additional files
require_once 'panel.connect.php';


$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if (isset($_POST['oldPass']) && isset($_POST['newPass']) && isset($_POST['newPassAgain'])) {

    if ($_POST['newPass'] == $_POST['newPassAgain']) {

        if ($conn->connect_errno!=0) {
            $_SESSION['message'] = 'connection to db fail';
            #echo 'Error: '.$conn->connect_error;
            header('Location:panle.php');
            exit();
        }else{
    
            $sql = "SELECT `login`, `password` FROM `admin` WHERE id=1 ";
    
            if($result = @$conn->query(sprintf($sql)))
            {
    
                $num = $result->num_rows;
    
                if($num >0)
                {
    
                    $row = $result->fetch_assoc();
    
                    if($_POST['oldPass'] == $row['password']) {

                        $new_password = $_POST['newPass'];

                        //DB update
                        $sql_update = "UPDATE `admin` SET `password` = '$new_password' WHERE id=1 ";

                        if ($conn->query($sql_update) === TRUE) {
    
                            $_SESSION['message'] = 'Password changed successfully.';
                            header('Location: panel.php');
                        } else {
                            $_SESSION['message'] = 'Error: something went wrong during updating password';
                            #echo $conn->error;
                            header('Location: panel.phps');
                        }
    
                    } else {
                        $_SESSION['message'] = 'Old password is wrong';
                        header('Location:panel.php');
                    }

                } else {
                    $_SESSION['message'] = 'more rows found than needed';
                    header('Location: panel.phps');
                }
            }
            $conn->close();
            exit();
        }
    } else {
        $_SESSION['message'] = 'new password different than one writen again';
        header('Location:panel.php');
        exit();   
    }

} else {
    $_SESSION['message'] = 'POST table doesnt have all data';
    header('Location:panel.php');
    exit(); 
}

