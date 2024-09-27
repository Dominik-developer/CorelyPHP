<!DOCTYPE html>
<?php

session_start();

include_once 'functions.php';
require_once 'service.alg.php';
include_once 'articles.alg.php';

service();


$restored_title = str_replace('_', ' ', $_GET['title']); //optionally use - insted of _

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $restored_title; ?></title>

    <link rel="stylesheet" href="main.css" />

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

                //echo 'article will be here in future';
                //echo '<br>';
                //echo $_GET['title'];
                //echo $restored_title;
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
