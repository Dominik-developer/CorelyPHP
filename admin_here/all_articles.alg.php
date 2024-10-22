<?php

session_start();

if (!isset($_SESSION['adminLoged'])) {
    header('Location: panel.login.php');
    exit();
}

function all() {

    require 'panel.connect.php';

$conn = @new mysqli($host, $db_user, $db_password, $db_name);
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sprawdzanie błędów połączenia
if ($conn->connect_errno) {
    echo "Error: " . $conn->connect_error;
    return;
} else {
    // Zaktualizowane zapytanie, które pobiera dodatkowe informacje
    $sql = "SELECT * FROM articles";
    $result = $conn->query($sql); 

    // Sprawdzenie, czy są wyniki
    if ($result->num_rows > 0) {
        echo '<table class="data-table">';
        echo '<thead><tr><th>ID</th><th>Title</th><th>Date</th><th>Content</th><th>Image Path</th><th>View</th></tr></thead>';
        echo '<tbody>';
        // Pętla po wynikach
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['ID'] . '</td>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['date_of_publish'] . '</td>';
            echo '<td>' . substr($row['text'], 0, 50) . '...</td>'; // Skrócona treść
            echo '<td>' . $row['photo_path'] . '</td>';
            echo '<td><a href="http://localhost/serwer/admin%20panel/public/single.php?title='.$row['title'].'">Link</a></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo "Brak wyników";
    }

    $conn->close();
}
}




