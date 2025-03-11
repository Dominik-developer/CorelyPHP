<!DOCTYPE html>
<?php

session_start();

include './handlers/functions.php';
require_once './handlers/service.alg.php';
require_once './handlers/cookies.php';
include_once './handlers/single.alg.php';

service();

if (!isset($_GET['title']) || empty(trim($_GET['title'])) || !preg_match('/^[a-zA-Z0-9 _-]{1,50}$/', $_GET['title'])) {
    header("HTTP/1.1 404 Not Found");
    header("Location: error_404.php");
    exit();
}

//$page = 'single.php?title='.$_GET['title'];
$page = 'single.php';
cookie($page);

$restored_title = str_replace('_', ' ', filter_var($_GET['title'], FILTER_SANITIZE_SPECIAL_CHARS)); //optionally use - insted of _

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($restored_title); ?></title> <!-- XSS prevention -->

    <link rel="stylesheet" href="./CSS/main.css" />
    <link rel="stylesheet" href="./CSS/single.css" />

    <script src="./JS/popout.js"></script>

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
        <a class="current"><?php echo htmlspecialchars($restored_title); ?></a>
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
