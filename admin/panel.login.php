<!DOCTYPE html>
<?php
session_start();

if((isset($_SESSION['adminLoged'])) && ($_SESSION['aminLoged'] == true))
{
    //unset($_SESSION['adminLoged']);
    header('Location: panel.php');
    exit();
}

?>
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
            <a>Admin login panel</a>
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
    </div>
</main>

<footer>
    <a>&copy 2024 - <?php echo date("Y"); ?> Admin Panel</a>
</footer>
    
</body>
</html>
