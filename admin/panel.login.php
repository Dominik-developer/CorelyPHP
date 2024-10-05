<!DOCTYPE html>
<?php
session_start();



if((isset($_SESSION['adminLoged'])) && ($_SESSION['aminLoged'] == true))
{
    //unset($_SESSION['adminLoged']);
    header('Location: panel.php');
    exit();

    //jesli nie chcemy by zosrtały wykonane następne instrukcje w skrypcie php 
    //znajdujące sie poniej instrukcji header naley uzyć exit(); 
    //nastąpi natychmiastowe przekierowanie 
    // nie kończymy imprzy, wychodzimy po angielsku 

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
            <a>ADMIN LOGIN PANEL</a>
            <br>
        </div>
        <div id="loginBoxForm">
            <form action="panel_login.alg.php" method="POST">
                
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
    
<span id="smallScreen"> Screen to small to use admin panel</span>

</body>
</html>