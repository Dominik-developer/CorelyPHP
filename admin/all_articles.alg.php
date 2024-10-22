<?php

session_start();

if (!isset($_SESSION['adminLoged'])) {
    header('Location: panel.login.php');
    exit();
}

function all() {

//additional files
require 'panel.connect.php';

    //$conn = @new mysqli($host, $db_user, $db_password, $db_name);

    #error_reporting(E_ALL);
    #ini_set('display_errors', 1);

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_errno) {
    $_SESSION['message'] = 'connection to db fail';
    #echo "Error: " . $conn->connect_error;
    header('Location:panel.php');
    exit(); 
} else {
    // Zaktualizowane zapytanie, które pobiera dodatkowe informacje
    $sql = "SELECT * FROM articles";
    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {
        echo '<table class="data-table">';
        echo '<thead><tr><th>ID</th><th>Title</th><th>Date of Published</th><th>Content</th><th>Image Path</th><th>View</th></tr></thead>';
        echo '<tbody>';
        // Pętla po wynikach
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['ID'] . '</td>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['date_of_publish'] . '</td>';
            echo '<td>' . substr($row['text'], 0, 50) . '...</td>'; // Skrócona treść
            echo '<td>' . $row['photo_path'] . '</td>';
            echo '<td><a href="http://localhost/serwer/admin%20panel/public/single.php?title='.$row['title'].'" target="_blank">Link</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        $_SESSION['message'] = 'no data found';
        header('Location:panel.php');

    }

    $conn->close();
}
}

