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

if (isset($_POST['toggle'])) {
    $setting_id = $_POST['setting_id'];

    if ($conn->connect_errno!=0) {

        echo "Error: ".$conn->connect_error;
    }else{

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

                    echo ("Service status value changed successfully.");
                    header("Location: panel.php");
                }else{

                    echo ("Error: something went wrong during updating status."). $conn->error;
                }

            }else{

                echo 'last error';
                echo('Location: error.html'); //header: ; in future
                exit();
            }
        }
        $conn->close();
    }
}else{

    echo('something went wrong, try again');
    echo('Location: error.html');
    exit();
}

exit();






