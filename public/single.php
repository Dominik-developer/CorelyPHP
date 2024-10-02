<!DOCTYPE html>
<?php

session_start();

include_once 'functions.php';
require_once 'service.alg.php';
include_once 'single.alg.php';
include 'connect.php';

service();

$restored_title = str_replace('_', ' ', $_GET['title']); //optionally use - insted of _

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $restored_title; ?></title>

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
        <!--<a>===></a>-->
        <a class="current"><?php echo $restored_title; ?></a>
    </nav>

    <main>
        <section class="main">
            <?php
                articles($restored_title);
            ?>
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
