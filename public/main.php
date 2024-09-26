<!DOCTYPE html>
<?php

session_start();

include_once 'functions.php';
require_once 'service.alg.php';

service();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home Page</title>

    <link rel="stylesheet" href="main.css" />

</head>
<body>
    <header>
        <?php
            head();
        ?>
    </header>

    <nav>
        <a class="current">Blog Home Page</a>
    </nav>

    <main>
        <section id="all">
            <?php
                all_articles();
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
