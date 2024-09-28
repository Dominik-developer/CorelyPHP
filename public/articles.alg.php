<?php


function articles($restored_title){

    require 'connect.php';


    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($conn->connect_errno) {
        echo "Error: " . $conn->connect_error;
        return;
    } else {

        $query = $restored_title;

        //echo $query;

        $conn = @new mysqli($host, $db_user, $db_password, $db_name);

        $sql = "SELECT * FROM `articles` WHERE title = '$query'";
        //echo $sql;  

        if ($result = @$conn->query($sql)) {

            $num = $result->num_rows;

            if($num = 1)
            {

                $row = $result->fetch_assoc();

                echo ' it works';

                echo '<br>'.$row['title'].'<br>'.$row['text'].'<br>'.$row['photo_path'].'<br>';


                
                
            } else {
            
                echo 'last error ';
                echo('Location: error.html');

            }
            
        } else {
            echo 'Error in SQL query';
        }

        $conn->close(); 
    }
}