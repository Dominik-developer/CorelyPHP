<?php

/********************* Helper functions *********************/
function get_domain(): string{
    return $_SERVER['HTTP_HOST'];
}

function get_domain_with_protocol(): string{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on" ? 'https://' : 'http://';
    $base_domain = $protocol . $_SERVER['HTTP_HOST'];
    return $base_domain;
}

function clean_string($string): string {

    return htmlentities($string);
}

function redirect($location) { // fix it

    return header("Location: {$location}");
}

function set_message($message): void {

    if(!empty($message)) {
        
        $_SESSION['message'] = $message;

    } else {

        $message = "";
    }
}

function display_message(): void {

    if(isset($_SESSION['message'])) {

        echo $_SESSION['message'];
        unset($_SESSION['message']);

    } else {

        echo "";
    }
}

/*function token_generator() {

    $token = $_SESSION["token"] = md5(uniqid(mt_rand(), true));

    return $token;
}*/

function display_validation_errors($error): string {

    /*$error_message ='   <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">
                                <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button><strong>Warning! </strong>'. $error.'
                        </div>';
    */

    $error_message = '<span id="logErr" style="color:red">'.$error.'</span>';
    
    return $error_message;
}

function popout_message(): void {
    if (isset($_SESSION['message'])) {
            echo "
            <div class='overlayPopout' id='overlay'>
                <div class='popout'>
                    <span class='close-btn' id='close-btn'>&times;</span>
                    <p>{$_SESSION['message']}</p>
                </div>
            </div>";
        unset($_SESSION['message']);
    }
}

/*function email_exists($email) {

	$sql = "SELECT id FROM users WHERE email = '$email' ";

	$result = query($sql);

	if(row_count($result) == 1 ) {

		return true;

	} else {

		return false;
	}
}*/

/*function username_exists($username) {

    $sql = "SELECT id FROM users WHERE username = '$username' ";

    $result = query($sql);

    if(row_count($result) === 1) {

        return true;

    } else {

        return false;
    }
}*/

function send_email($email, $subject, $msg, $headers): bool {

    return mail($email, $subject, $msg, $headers);

}



/********************* Validate user login *********************/
function validate_user_login(): void {

    $errors = [];

    $min = 3;
    $max = 20;

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $login = clean_string($_POST['login']);
        $password = clean_string($_POST['password']);
        //$remember = isset($_POST['remember']); // may be needed in future
        $remember = 'off';

        if(empty($login)) {
            $errors[] = "Login field cannot be empty.";
        }

        if(empty($password)) {
            $errors[] = "Password field cannot be empty.";
        }

        if(!empty($errors)) {

            foreach($errors as $error) {
                
                echo display_validation_errors($error);
            }

        } else {

            if(login_user($login, $password, $remember)) {

                redirect("index.php");
            }

            echo display_validation_errors("Your credentials are not correct. <br>Please try again.");
        }
    }
}

function login_user($login, $password, $remember): bool {

    $login = escape($login);

    $sql = "SELECT * FROM admins WHERE username = '$login' AND active = 1"; // change 'username' to 'login' if needed

    $result = query($sql); 
    confirm($result);

    if(row_count($result) == 1) {

        $row = fetch_array($result);

        $db_password = $row['password'];

        //if(md5($password) == $db_password) // old password check
        if(password_verify($password, $db_password)) {

            if($remember == 'on') {

                setcookie('admin_login', $login, time() + 60*60*24*30, '/', '', isset($_SERVER['HTTPS']), true);

            } else {

                if(isset($_COOKIE['admin_login'])) {

                    unset($_SESSION['admin_login']);

                    setcookie('admin_login', '', time() - 3600, '/'); // delete cookie
                }
            }
            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);

            $_SESSION['admin_login'] = $login;

            return true;

        } else {
            return false;
        }

    } else {

        return false;
    }
}



/********************* Logged in function *********************/
function logged_in(): bool {

    if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] != "" || isset($_COOKIE['admin_login'])) {

        return true;

    } else {

        return false;
    }
}



/********************* Recover password *********************/




/********************* Status function *********************/
function getSettingValue($name, $default = NULL): mixed {
    
    $sql = "SELECT value FROM settings WHERE name = '$name' ";

    $result = query($sql);
    confirm($result);

    if(row_count($result) == 1) {

        $row = fetch_array($result);

        return $row['value'];
    } else {
        return $default;
    }
}

function setSettingValue($name, $value) {
    
    $name = escape($name);
    $value = escape($value);

    $sql = "UPDATE settings SET value = '$value' WHERE name = '$name' ";

    $result = query($sql);
    confirm($result);

    if($result) {
        $_SESSION['message'] = "Setting: ".$name." updated successfully.";
        return true;
    } else {
        $_SESSION['message'] = "Failed to update setting: ".$name.".";
        return false;
    }
}



/********************* Maintenance mode *********************/
function checkMaintenanceMode(): void {
    if (isset($_SESSION['admin_login']) && isset($_COOKIE['admin_login'])) {
        // Admin can bypass maintenance mode
        return;
    }

    if (file_exists('maintenance.flag')) {
        $reason = trim(file_get_contents( 'maintenance.flag'));
        http_response_code(503);
        include 'errors/503.php';
        exit;
    }
}

function updateMaintenance() {
    if (isset($_POST['toggle'])) {

        $currentStatus = (int) getSettingValue('maintenance', 0);

        $newStatus = $currentStatus === 1 ? 0 : 1;

        $status = setSettingValue('maintenance', $newStatus);

        if (!$status) {
            return;
        }

        $flagFile = __DIR__ . '/../public/maintenance.flag';

        if ($newStatus === 1) {
            // Tryb maintenance: utwórz plik z powodem
            $reason = "Service temporarily unavailable due to maintenance.";
            file_put_contents($flagFile, $reason);
        } else {
            // Wyłącz maintenance: usuń plik
            if (file_exists($flagFile)) {
                unlink($flagFile);
            }
        }
    //echo '<div class="success">Service break status changed successfully (now ' . ($newStatus ? 'ENABLED' : 'DISABLED') . ').</div>';
    }
}



/********************* Other functions *********************/

// Add other functions below as needed



