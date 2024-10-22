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
}
else
{
    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $password = htmlentities($password, ENT_QUOTES, "UTF-8");

    if($result = @$conn->query(sprintf("SELECT * FROM admin WHERE login='%s' AND password='%s' ",
        mysqli_real_escape_string($conn, $login),
        mysqli_real_escape_string($conn, $password) )))
    {   
        $num_adm = $result->num_rows;
        
        if($num_adm >0)
        {

            $_SESSION['adminLoged'] = true; //zalogowany = true
            
            $row = $result->fetch_assoc();
            
            $_SESSION['id'] = $row['id'];
            $_SESSION['login'] = $row['login'];
            $_SESSION['password'] = $row['password'];


            unset($_SESSION['loginError']);
            $result->free_result(); 
            
            header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
            header('Cache-Control: post-check=0, pre-check=0', false); // Dla zgodności z HTTP/1.0
            header('Pragma: no-cache'); // Dla zgodności z HTTP/1.0

            // Ustawienie nagłówka Expires, aby upewnić się, że strona jest uznawana za przeterminowaną
            header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');

            header('Location: panel.php');

        }else{

            $_SESSION['loginError'] = '<span id="logErr" style="color:red">Error! Login or password wrong.</span>';
            header('Location: panel.login.php');
        }
    }

    $conn->close();
}


exit();
