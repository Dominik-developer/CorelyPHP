<?php

session_start();

/*if (!isset($_SESSION['adminLoged'])) {
    header('Location: panel.login.php');
    exit();
}*/

function all() {
    
            require 'panel.connect.php';


            $conn = @new mysqli($host, $db_user, $db_password, $db_name);
            error_reporting(E_ALL);
            ini_set('display_errors', 1);

            // Sprawdzanie błędów połączenia
            if ($conn->connect_errno) {
                echo "Error: " . $conn->connect_error;
                return; // Dodano return, aby zakończyć funkcję w przypadku błędu
            } else {

                // Wykonanie zapytania
                $sql = "SELECT title FROM articles";
                //$sql ="SELECT title FROM articles;";
                $result = $conn->query($sql); 
                
            

                // Sprawdzenie czy są wyniki
                if ($result->num_rows > 0) {
                    $i=1;
                    // Pętla po wynikach
                    while ($row = $result->fetch_assoc()) {
                        echo 'Artykuł '. $i . ': '. $row['title'] . "<br>";
                        $i = $i+1;
                    }
                } else {
                    echo "Brak wyników";
                }

                $conn->close(); 
            }

}




