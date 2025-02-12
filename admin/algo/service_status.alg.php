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

if ($conn->connect_errno!=0) {
    $_SESSION['message'] = 'connection do db fail';
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
            } else {
                $_SESSION['message'] = 'Error during updating: row ID error.<!--No rows updated, check the ID.-->';
            }
        } else {
            $_SESSION['message'] = 'Something went wrong during updating status.';
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = 'Failed to prepare the SQL statement.';
    }

} else {
    $_SESSION['message'] = 'Something went wrong, try again.';
    header('Location: ../panel.php?window=service-break');
    exit();
}







/*



    $setting_id = $_POST['setting_id'];

        $sql = "SELECT `service_status` FROM `service` WHERE id=1 ";

        if($result = @$conn->query(sprintf($sql)))
        {

            $num = $result->num_rows;

            if($num >0)
            {

                $row = $result->fetch_assoc();

                //Value change
                $new_value = $row["service_status"] ? 0 : 1;

                //DB update
                $sql_update = "UPDATE `service` SET service_status = $new_value WHERE id = $setting_id";

                if ($conn->query($sql_update) === TRUE) {

                    $_SESSION['message'] = 'Service status value changed successfully';
                    header('Location: ../panel.php?window=service-break');
                } else {
                    $_SESSION['message'] = 'Error: something went wrong during updating status';
                    #echo $conn->error;
                    header('Location: ../panel.php?window=service-break');
                }

            } else{ 
                $_SESSION['message'] = 'more rows found than needed';
                header('Location: ../panel.php?window=service-break');
            }
        }
        $conn->close();
        exit();
    } else {
            $_SESSION['message'] = 'something went wrong, try again';
            header('Location: ../panel.php?window=service-break');
            exit();
        }


