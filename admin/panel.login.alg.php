<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
    header('Location:panel.login.php');
    exit();
}

require_once 'panel.connect.php';

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno!=0)
{
    echo "Error: ".$conn->connect_error;
} else {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    echo 'hash:'.$password_hash;

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");

    if($result = @$conn->query(sprintf("SELECT * FROM admin WHERE login='%s' ", mysqli_real_escape_string($conn, $login))))
    {   
        $num_adm = $result->num_rows;
        
        if($num_adm >0)
        {   
            $row = $result->fetch_assoc(); 

            if (password_verify($password, $row['password'])) {

                $_SESSION['adminLoged'] = true; 
                            
                $_SESSION['id'] = $row['id'];
                $_SESSION['login'] = $row['login'];
                $_SESSION['password'] = $row['password'];

                unset($_SESSION['loginError']);
                $result->free_result(); 
                
                header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
                header('Cache-Control: post-check=0, pre-check=0', false); // For HTTP/1.0 compatibility
                header('Pragma: no-cache'); // For HTTP/1.0 compatibility

                //Set the Expires header to ensure that the page is considered expired
                header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');

                header('Location: panel.php');

            } else {
                $_SESSION['loginError'] = '<span id="logErr" style="color:red">Error! Login or password wrong.</span>';
                header('Location: panel.login.php'); 
            }

        }else{
            $_SESSION['loginError'] = '<span id="logErr" style="color:red">Error! Login or password wrong.</span>';
            header('Location: panel.login.php'); 
        }
    }

    $conn->close();
}

exit();
