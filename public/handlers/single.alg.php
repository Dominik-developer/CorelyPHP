<?php



function articles($restored_title): void {
    require 'connect.php';

    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno) {
        header("HTTP/1.1 500 Internal Server Error");
        header("Location: ./error_404.php");
        exit();
    }

    // prepared statement
    //$stmt = $conn->prepare("SELECT * FROM `articles` WHERE title = ?");
    $stmt = $conn->prepare("SELECT title, photo_path, text, date_of_publish FROM `articles` WHERE title = ?");
    $stmt->bind_param("s", $restored_title);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        echo'
            <article> 
                <header id="title">
                    <a>' . htmlspecialchars($row['title']) . '</a>
                </header>
                
                <div id="photo">
                    <img src="../' . htmlspecialchars($row['photo_path']) . '" alt="photo from article">
                </div>

                <p>
                    ' . htmlspecialchars($row['text']) . '
                <p>

                <footer id="date_of_pub">
                    <p>
                        Date of publish: ' . htmlspecialchars($row['date_of_publish']) . '
                    </p>
                </footer>
            </article>';
    } else {
        header("HTTP/1.1 404 Not Found");
        header("Location: ./error_404.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
