<!DOCTYPE html>
<?php

session_start();

include_once 'page.functions.php';
require_once 'service.alg.php';

service();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog page: <?php ?></title>

    <link rel="stylesheet" href="main.css" />

</head>
<body>
    <header>
        <?php
            head();
        ?>
    </header>

    <nav>
        <a class="current"><?php ?></a>
    </nav>

    <main>
        <section class="main">
            <?php

                echo 'article will be here in future';
                echo '<br>';

                echo $_GET['id'];


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
