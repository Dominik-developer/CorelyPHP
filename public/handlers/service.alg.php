<?php

function service(): void
{

    require 'connect.php';

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno!=0)
    {
        //echo "Error: ".$conn->connect_error;
        echo 'Error.';
        header('Location: ./error.php');
    }
    else
    {
        $sql = "SELECT `service_status` FROM `service` WHERE id=1 ";

        if($result = @$conn->query(sprintf($sql)))
        {
        
            $num = $result->num_rows;
            
            if($num >0)
            {
                $row = $result->fetch_assoc();
                
                $_SESSION['service_status'] = $row['service_status'];

                if(!$_SESSION['service_status'] == 0)
                {
                    //unset($_SESSION['status']);
                    header('Location: service.php');
                }
                else
                {
                    //$_SESSION['user_session'] = session_id(); // Przypisanie identyfikatora sesji
                }
                
            }else{
            
            //$_SESSION['bigError'];
            //unset($_SESSION['status']);

            echo 'Last error.';
            header('Location: ./error.php');

            }
        }
        $conn->close();
    }
}
