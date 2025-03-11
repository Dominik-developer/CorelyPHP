<!DOCTYPE html>
<?php

session_start();

include './handlers/functions.php';
require_once './handlers/service.alg.php';
require_once './handlers/cookies.php';

service();

$page = 'main.php';
cookie($page);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home Page</title>

    <link rel="stylesheet" href="./CSS/main.css" />
    <link rel="stylesheet" href="./CSS/popout.css" />

    <script src="./JS/popout.js"></script>

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

    <?php
        cookie_popout()
    ?>
    
</div>
</body>
</html>
