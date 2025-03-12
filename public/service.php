<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service page</title>

    <!--== NO CACHE ==-->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <?php
        include "../themes/index.php";
    ?>

    <!-- == SYSTEM == -->
    <link rel="stylesheet" href="./CSS/popout.css" />
    <script src="./JS/popout.js"></script>
    <style>
        body{
            align-items: center;
            text-align: center;
            max-height: 100vh !important;
            overflow: hidden;
        }
    </style>
</head>

<body>
    <header>
        <h1>Service page</h1>
    </header>
    
    <main>
        <p>We are currently undergoing maintenance! <br>We apologize for the inconvenience.</p>
        <br>
        <a>Please try again later: </a><a href="index.php">Link: Blog main page </a>
    </main>
</body>
</html>