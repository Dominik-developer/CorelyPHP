<?php

session_start();

if(!isset ($_SESSION['adminLoged'])) {
    header('Location: ../panel.login.php');
    exit();
}

//additional files
require '../panel.connect.php';




try {
    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    
    if (isset($_POST['new_title']) && isset($_POST['new_text']) && isset($_POST['id'])) {

        $article_id = $_POST['id'] ?? 0;
    
        // Validate article_id
        if (!is_numeric($article_id) || $article_id <= 0) {
            $_SESSION['message'] = 'Invalid article ID.';
            header('Location: ../panel.php?window=articles-list');
            exit();
        }
    
        $NEW_title = mysqli_real_escape_string($conn, $_POST['new_title'] ?? '');
        $NEW_text = mysqli_real_escape_string($conn, $_POST['new_text'] ?? '');
        $NEW_photo = $_FILES['new_photo'] ?? '';
        
        // Validate required fields
        if (empty($article_id) || empty($NEW_title) || empty($NEW_text)) {
            $_SESSION['message'] = 'All fields are required';
            header('Location: ../panel.php?window=edit-article&id='.$article_id);
            $conn->close();
            exit();
        }

        // Check database connection
        if ($conn->connect_errno != 0) {
            $_SESSION['message'] = 'Connection to db fail';
            header('Location: ../panel.php?window=edit-article&id='.$article_id);
            $conn->close();
            exit();
        } else {

            // Checking if article exists
            $sql_select = "SELECT id, photo_path FROM articles WHERE id = ?";
            $stmt = $conn->prepare($sql_select);
            $stmt->bind_param("i", $article_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {

                // Fetch existing photo path
                $row = $result->fetch_assoc();
                $existing_photo = $row['photo_path'];

                // If a new photo is submitted
                if(!empty($_FILES['new_photo']['name'])) {

                    // Remove the old photo if a new one is being uploaded
                    #=========usuwanie=strego=zdjecia=====

                    /** *
                        check in db what way i have path for photos saved and fix it in case it is the other way
                    */
                    if (!empty($existing_photo) && file_exists('/Applications/XAMPP/xamppfiles/htdocs/server/panel_new/' . $existing_photo)) {
                        unlink('/Applications/XAMPP/xamppfiles/htdocs/server/panel_new/' . $existing_photo);
                    }

                    // Check for upload errors
                    if ($_FILES["new_photo"]["error"] !== UPLOAD_ERR_OK) {
                        switch ($_FILES["new_photo"]["error"]) {
                            case UPLOAD_ERR_PARTIAL:
                                $_SESSION['message'] = 'File only partially uploaded.';
                                header('Location: ../panel.php?window=edit-article&id='.$article_id);
                                exit();
                            case UPLOAD_ERR_NO_FILE:
                                $_SESSION['message'] = 'No file was uploaded.';
                                header('Location: ../panel.php?window=edit-article&id='.$article_id);
                                exit();
                            case UPLOAD_ERR_EXTENSION:
                                $_SESSION['message'] = 'File upload stopped by a PHP extension.';
                                header('Location: ../panel.php?window=edit-article&id='.$article_id);
                                exit();
                            case UPLOAD_ERR_FORM_SIZE:
                                $_SESSION['message'] = 'File exceeds MAX_FILE_SIZE in the HTML form.';
                                header('Location: ../panel.php?window=edit-article&id='.$article_id);
                                exit();
                            case UPLOAD_ERR_INI_SIZE:
                                $_SESSION['message'] = 'File exceeds upload_max_filesize in php.ini .';
                                header('Location: ../panel.php?window=edit-article&id='.$article_id);
                                exit();
                            case UPLOAD_ERR_NO_TMP_DIR:
                                $_SESSION['message'] = 'Temporary folder not found.';
                                header('Location: ../panel.php?window=edit-article&id='.$article_id);
                                exit();
                            case UPLOAD_ERR_CANT_WRITE:
                                $_SESSION['message'] = 'Failed to write file.';
                                header('Location: ../panel.php?window=edit-article&id='.$article_id);
                                exit();
                            default:
                                $_SESSION['message'] = 'Unknown upload error.';
                                header('Location: ../panel.php?window=edit-article&id='.$article_id);
                                exit();
                        }
                    }

                    // Check photo size
                    if ($_FILES["new_photo"]["size"] > 1048576) {
                        $_SESSION['message'] = 'File too large (max 1MB).';
                        header('Location: ../panel.php?window=edit-article&id='.$article_id);
                        $conn->close();
                        exit();
                    }

                    // Generate a new filename for the photo
                    $pathinfo = pathinfo($_FILES["new_photo"]["name"]);
                    $base = preg_replace("/[^\w-]/", "_", $pathinfo["filename"]);
                    $filename = $base . "." . $pathinfo["extension"];
                    $destination = "/Applications/XAMPP/xamppfiles/htdocs/server/panel_new/articles_photos/" . $filename;

                    // Add a numeric suffix if file exists
                    $i = 1;
                    while (file_exists($destination)) {
                        $filename = $base . "($i)." . $pathinfo["extension"];
                        $destination = "/Applications/XAMPP/xamppfiles/htdocs/server/panel_new/articles_photos/" . $filename;
                        $i++;
                    }

                    if (!move_uploaded_file($_FILES["new_photo"]["tmp_name"], $destination)) {
                        $_SESSION['message'] = "Can't move uploaded file.";
                        header('Location: ../panel.php?window=edit-article&id='.$article_id);
                        $conn->close();
                        exit();
                    }

                    // Update photo path in database
                    $NEW_photo_path = 'articles_photos/'.$filename;
                    $sql_update = "UPDATE articles SET title = ?, text = ?, photo_path = ? WHERE id = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param('sssi', $NEW_title, $NEW_text, $NEW_photo_path , $article_id);

                } else {
                    // If no new photo is uploaded
                    $sql_update = "UPDATE articles SET title = ?, text = ? WHERE id = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param("ssi", $NEW_title, $NEW_text, $article_id);
                }

                if ($stmt_update->execute()) {
                    $_SESSION['message'] = 'Article was successfully updated.';
                    header('Location: ../panel.php?window=edit-article');
                    $stmt_update->close();
                    $conn->close();
                    exit();
                } else {
                    $_SESSION['message'] = 'Error during updating article.';
                    header('Location: ../panel.php?window=edit-article&id='.$article_id);
                    $stmt_update->close();
                    $conn->close();
                    exit();
                }

            } else {
                $_SESSION['message'] = 'Article with id: '.$article_id.' does not exist';
                header('Location: ../panel.php?window=edit-article&id=0');
                $stmt->close();
                $conn->close();
                exit();
            }
        }   

    } else {
        $_SESSION['message'] = 'POST table doesn\'t have all data';
        header('Location: panel.php?window=edit-article&id='.$article_id);
        $conn->close();
        exit(); 
    }

} catch (mysqli_sql_exception $e) {
    $_SESSION['message'] = 'Database connection error: ' . $e->getMessage();
    header('Location: ../panel.php?window=edit-article&id=0');
    $conn->close();
    exit();

} finally {
    
    if (isset($conn) && $conn instanceof mysqli) {
        $conn->close();
    }
}
