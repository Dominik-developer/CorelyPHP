<?php

require_once ("../../core/init.php");

// If user is already logged in, redirect to admin index
if (logged_in()) {
    redirect("./index.php");
    exit();
    // nie kończymy imprezy, wychodzimy po angielsku :)
}

// cache control
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="/admin/CSS/login.css" />

</head>
<body>

<main>
    <div id="loginBox">
        <div id="loginBoxTitle">
            <a>ADMIN LOGIN PANEL</a>
            <br>
        </div>
        <div id="loginBoxForm">
            <form action="login.php" method="POST">
                
                <input type="text" id="login" name="login" placeholder="Login:" required="require">
                <br>
                <input type="password" id="password" name="password" placeholder="Password:" required="require">
                <br>
                <input type="submit" value="Log in">
                <br><br>
            </form>
            <?php display_message(); ?>

			<?php validate_user_login(); ?>
        </div>
        <?php 
            /*<div>
            <a href="recover.php" tabindex="5" class="forgot-password">Forgot Password?</a>
            </div>
            <div>
                <a href="../index.php">Return to main site</a>
            </div>*/ 
        ?>
    </div>
</main>

<footer>
    <a>&copy 2024 - <?php echo date("Y"); ?> Admin Panel</a>
</footer>
    
<span id="smallScreen"> Screen to small to use admin panel</span>

</body>
</html>