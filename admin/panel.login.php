<?php
declare(strict_types=1);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if((isset($_SESSION['adminLoged'])) && ($_SESSION['adminLoged'] == true))
{
    header('Location: panel.php');
    exit();
    // nie kończymy imprezy, wychodzimy po angielsku 
}

// cache control
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


// for dev
define('ENV_DEV', false);
if(ENV_DEV == true){
    $_SESSION['adminLoged'] = true;
    header('Location: panel.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="panel.login.css" />

</head>
<body>

<main>
    <div id="loginBox">
        <div id="loginBoxTitle">
            <a>ADMIN LOGIN PANEL</a>
            <br>
        </div>
        <div id="loginBoxForm">
            <form action="panel.login.alg.php" method="POST">
                
                <input type="text" id="login" name="login" placeholder="Login:" required="require">
                <br>
                <input type="password" id="password" name="password" placeholder="Password:" required="require">
                <br>
                <input type="submit" value="Log in">
                <br><br>
            </form>
            <?php
                if(isset($_SESSION['loginError'])) echo $_SESSION['loginError'];
            ?>
        </div>
        <div>
            <?php
            echo '<br><br><br>';

            include_once "./v_auth/version.php";

            echo '<p style="color:red">';
                if (version_compare(PHP_VERSION, PHP_VERSION_REQ, '<')) {
                    echo('The required PHP version is ' . PHP_VERSION_REQ . ' or higher. The installed version is: ' . PHP_VERSION . '<br><br>');
                    echo('Version: ' . PHP_VERSION_ADVICE);
                }
            echo '</p>';
            ?>
        </div>
    </div>
</main>

<footer>
    <a>&copy 2024 - <?php echo date("Y"); ?> Admin Panel</a>
</footer>
    
<span id="smallScreen"> Screen to small to use admin panel</span>

</body>
</html>
