<?php

session_start();


if(!isset ($_SESSION['adminLoged'])) {
    header('Location: panel.login.php');
    exit();
}

require_once './admin/panel.connect.php';

$conn = @new mysqli($host, $db_user, $db_password, $db_name);

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit('POST request method required');
}

if(empty($_POST['title']) || empty($_FILES['textUpload']['name']) || empty($_FILES['photoUpload']['name'])) {
    $_SESSION['message'] = 'Error, POST table empty.';
    header('Location: panel.php');
    exit();

} else {
    //echo '1 ';

    if ($_FILES["photoUpload"]["error"] !== UPLOAD_ERR_OK) {

        switch ($_FILES["photoUpload"]["error"]) {
            case UPLOAD_ERR_PARTIAL:
                $_SESSION['message'] = 'File only partially uploaded.';
                header('Location: panel.php');
                exit();
            case UPLOAD_ERR_NO_FILE:
                $_SESSION['message'] = 'No file was uploaded.';
                header('Location: panel.php');
                exit();
            case UPLOAD_ERR_EXTENSION:
                $_SESSION['message'] = 'File upload stopped by a PHP extension.';
                header('Location: panel.php');
                exit();
            case UPLOAD_ERR_FORM_SIZE:
                $_SESSION['message'] = 'File exceeds MAX_FILE_SIZE in the HTML form.';
                header('Location: panel.php');
                exit();
            case UPLOAD_ERR_INI_SIZE:
                $_SESSION['message'] = 'File exceeds upload_max_filesize in php.ini .';
                header('Location: panel.php');
                exit();
            case UPLOAD_ERR_NO_TMP_DIR:
                $_SESSION['message'] = 'Temporary folder not found.';
                header('Location: panel.php');
                exit();
            case UPLOAD_ERR_CANT_WRITE:
                $_SESSION['message'] = 'Failed to write file.';
                header('Location: panel.php');
                exit();
            default:
            $_SESSION['message'] = 'Unknown upload error.';
                header('Location: panel.php');
                exit();
        }
    }

    if ($_FILES["photoUpload"]["size"] > 1048576) {
        $_SESSION['message'] = 'File too large (max 1MB).';
        header('Location: panel.php');
        exit();
    }

    //echo '2 ';

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $textUpload = file_get_contents($_FILES['textUpload']['tmp_name']);
    $photo = $_FILES['photoUpload'];

    //echo '3 ';

    if ($conn->connect_errno != 0) {
        $_SESSION['message'] = 'db connection fail.';
        header('Location: panel.php');
        #echo "Error: " . $conn->connect_error;
        #throw new Exception(mysqli_connect_errno());
    } else {

        $sql = "SELECT * FROM articles WHERE title = '$title'";  
        //echo '4 ';
        if($result = $conn->query($sql)) {
            $num = $result->num_rows;
            //echo '5 ';
            if($num != 0) {
                $_SESSION['message'] = 'Article with this title already exist.';
                header('Location: panel.php');
            } else {
                //echo '6 ';
                $pathinfo = pathinfo($_FILES["photoUpload"]["name"]);

                $base = $pathinfo["filename"];

                $base = preg_replace("/[^\w-]/", "_", $base);
                //echo '7 ';
                $filename = $base . "." . $pathinfo["extension"];

                //$destination = "/Applications/XAMPP/xamppfiles/htdocs/serwer/panel/articles_photos/" . $filename; //old mac
                $destination = "/Applications/XAMPP/xamppfiles/htdocs/server/panel_new/articles_photos/" . $filename; // new mac 
                //echo '8 ';
                // Add a numeric suffix if the file already exists
                $i = 1;

                while (file_exists($destination)) {
                    //echo '9 ';
                    $filename = $base . "($i)." . $pathinfo["extension"];
                    //$destination = "/Applications/XAMPP/xamppfiles/htdocs/serwer/panel/articles_photos/" . $filename; //old
                    $destination = "/Applications/XAMPP/xamppfiles/htdocs/server/panel_new/articles_photos/" . $filename; // new

                    $i++;
                }
                //echo '10 ';
                if ( ! move_uploaded_file($_FILES["photoUpload"]["tmp_name"], $destination)) {

                    echo $destination. '<br>';
                    $_SESSION['message'] = "Can't move uploaded file.";
                    header('Location: panel.php');
                }
                //echo '11 ';
                //echo $destination;

                $target_file = 'articles_photos/'.$filename;

                // inserting data into db
                $sql_insert = $sql_insert = "INSERT INTO articles (title, text, photo_path) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param('sss', $title, $textUpload, $target_file);

                //echo '12 ';
                if ($stmt_insert->execute()) {
                    //echo '13.1 ';
                    $_SESSION['message'] = 'Article was succesfully addes to db.';
                    header('Location: panel.php');
                } else {
                    $_SESSION['message'] = 'Error during adding data to db.';
                    header('Location: panel.php');
                    #echo "Błąd podczas dodawania artykułu: " . $conn->error;
                    //echo '13.2 ';
                }
                
                //echo '14 ';
                $stmt_insert->close();

                #$_SESSION['message'] = 'File uploaded successfully.';
                #header('Location: panel.php');
            }

        } else {
            $_SESSION['message'] = 'Error occur during checking title.';
            header('Location: panel.php?window=add-article');
            #throw new Exception($conn->error);
        }
        $conn->close();
        exit();
    }
}

exit();