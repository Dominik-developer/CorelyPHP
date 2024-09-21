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

if((!isset($_POST['title'])) || (!isset($_POST['textUpload'])) || (!isset($_POST['photoUpload'])) )
{
    header('Location:panel.login.php');
    exit();
}
    $title = $_POST['title'];
    
    // Odczyt pliku tekstowego (textUpload)
    $textUpload = file_get_contents($_FILES['textUpload']['tmp_name']);

    // Odczyt pliku graficznego (photoUpload)
    $photoUpload = file_get_contents($_FILES['photoUpload']['tmp_name']);


    if ($conn->connect_errno!=0) {

        echo "Error: ".$conn->connect_error;
    }else{

        $sql = "SELECT * FROM articles WHERE title = $title ";

        if($result = @$conn->query(sprintf($sql)))
        {

            $num = $result->num_rows;

            if($num != 0)
            {
                echo('ERROR: file with this title already exist!!');
                echo('Location: error.html'); //header: ; in future
                exit();

            }else{

                //$row = $result->fetch_assoc();
                
                //test
                echo $textUpload;

                // Przygotowanie zapytania do wstawienia danych
                //$stmt_insert = $conn->prepare("INSERT INTO articles (title, text, photo_1) VALUES (?, ?, ?)");
                //$stmt_insert->bind_param('ssb', $title, $textUpload, $photoUpload); // 'b' oznacza dane binarne

                /*
                if ($stmt_insert->execute()) {
                    echo "Article was successfully added to the database.";
                    // header("Location: panel.php"); // Odkomentuj, jeśli potrzebujesz przekierowania
                } else {
                    echo "Error: Something went wrong during inserting the article: " . $conn->error;
                }
            
                $stmt_insert->close();

                */
                
                
            }
        }
        $conn->close();
    }

//exit();
