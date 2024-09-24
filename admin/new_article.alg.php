<?php

session_start();


if(!isset ($_SESSION['adminLoged'])) {
    header('Location: panel.login.php');
    exit();
}

require_once 'panel.connect.php';

mysqli_report(MYSQLI_REPORT_STRICT);

$conn = @new mysqli($host, $db_user, $db_password, $db_name);


if(empty($_POST['title']) || empty($_FILES['textUpload']['name']) || empty($_FILES['photoUpload']['name'])) {
    echo 'POST ERROR';
    header('Location: panel.php');
    exit();
}


$title = mysqli_real_escape_string($conn, $_POST['title']);
$textUpload = file_get_contents($_FILES['textUpload']['tmp_name']);
$photo = $_FILES['photoUpload'];




if ($conn->connect_errno != 0) {
    echo "Error: " . $conn->connect_error;
    throw new Exception(mysqli_connect_errno());
} else {
    // Sprawdzenie, czy artykuł o danym tytule już istnieje
    $sql = "SELECT * FROM articles WHERE title = '$title'";  
    if($result = $conn->query($sql)) {
        $num = $result->num_rows;

        if($num != 0) {
            echo 'ERROR: Artykuł o tym tytule już istnieje!';
            //header('Location: error.html');
            exit();
        } else {

            $target_dir = "articles_photos/"; // sciezka do folderu
            $photo_extension = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION)); //pobiera dane o zdjęciu

            // Zastąp spacje i inne niebezpieczne znaki w tytule
            $sanitized_title = preg_replace('/[^a-zA-Z0-9-_]/', '_', $title); // Zmienia niebezpieczne znaki na '_'
            $new_photo_name = $sanitized_title . '.' . $photo_extension;
            $target_file = $target_dir . $new_photo_name;





            // Sprawdzenie rozszerzenia pliku graficznego
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($photo_extension, $allowed_types)) {

                // Przenoszenie pliku do folderu articles_photos
                if (move_uploaded_file($photo['tmp_name'], $target_file)) {



                    // Wstawianie artykułu do bazy danych z zapisaniem ścieżki do zdjęcia
                    $sql_insert = "INSERT INTO articles (title, text, photo_path) VALUES (?, ?, ?)";
                    $stmt_insert = $conn->prepare($sql_insert);
                    $stmt_insert->bind_param('sss', $title, $textUpload, $target_file);


                    if ($stmt_insert->execute()) {
                        echo "Artykuł został pomyślnie dodany do bazy danych.";
                        header("Location: panel.php"); // Przekierowanie po sukcesie
                    } else {
                        echo "Błąd podczas dodawania artykułu: " . $conn->error;
                    }

                    $stmt_insert->close();

                } else {
                    echo "Błąd podczas przesyłania pliku.";
                    exit();
                }
            } else {
                echo "Nieprawidłowy format pliku. Dozwolone formaty: JPG, JPEG, PNG, GIF.";
                exit();
            }
        }
    } else {
        throw new Exception($conn->error);
    }

    $conn->close();
}

exit();

