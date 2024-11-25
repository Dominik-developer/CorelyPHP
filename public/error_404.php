<!DOCTYPE html>
<?php

session_start();

include_once 'functions.php';
require_once 'service.alg.php';
include 'connect.php';

service();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 error </title>

    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" href="single.css" />

</head>
<body>
    <header>
        <?php
            head();
        ?>
    </header>

    <nav>
        <a href="main.php">Home Page</a>
        / 
        <a class="current">404 Page</a>
    </nav>

    <main>
        <section class="main">

            <h1 style="font-size: 60px;">4 0 4</h1>
            
            <h2>Page not found</h2> 

            Get back to home page: <a href="main.php">Home page </a>
                
        </section>

        <section id="white-space"></section>
    </main>

    <footer>
        <?php
            foot();
        ?>
    </footer>

</body>
</html>
