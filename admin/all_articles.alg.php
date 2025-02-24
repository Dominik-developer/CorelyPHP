<?php
declare(strict_types=1);

if (!isset($_SESSION['adminLoged'])) {
    header('Location: panel.login.php');
    exit();
}

function all() {

    //additional files
    require 'panel.connect.php';

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno) {
        $_SESSION['message'] = 'connection to db fail';
        #echo "Error: " . $conn->connect_error;
        header('Location: panel.php?window=all-articles');
        exit(); 
    } else {
        $sql = "SELECT * FROM articles";
        $result = $conn->query($sql); 

        if ($result->num_rows > 0) {
            echo '<table class="data-table">';
            echo '<thead><tr><th>ID</th><th>Title</th><th>Date of Published</th><th>Content</th><th>Image Path</th><th>View</th><th>Edit</th></tr></thead>';
            echo '<tbody>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['title'] . '</td>';
                echo '<td>' . $row['date_of_publish'] . '</td>';
                echo '<td>' . substr($row['text'], 0, 50) . '...</td>'; 
                echo '<td>' . $row['photo_path'] . '</td>';
                echo '<td><a class="custom-button green" href="../public/single.php?title='.$row['title'].'" target="_blank">View</a></td>';
                echo '<td><a class="custom-button orange" href="panel.php?window=edit-article&id='.$row['ID'].'">Edit</a></td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<table class="data-table">';
            echo '<thead><tr><th>ID</th><th>Title</th><th>Date of Published</th><th>Content</th><th>Image Path</th><th>View</th><th>Edit</th></tr></thead>';
            echo '<tbody>';

            $info = 'No data';

                echo '<tr>';
                echo '<td>' . $info . '</td>';
                echo '<td>' . $info . '</td>';
                echo '<td>' . $info . '</td>';
                echo '<td>' . $info . '</td>'; 
                echo '<td>' . $info . '</td>';
                echo '<td>' . $info . '</td>';
                echo '<td>' . $info . '</td>';
                echo '</tr>';

            echo '</tbody>';
            echo '</table>';
            
            $_SESSION['message'] = 'No data found. Database empty.';
        }

        $conn->close();
    }
}

?>

