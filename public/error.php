<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error page</title>

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
        <h1><!--404-->Error page</h1>
    </header>

    <main>
        
        <p>Something went wrong.<!--Don't worry, you didn't do anything wrong. We just couldn't find what you are looking for.--><br><br>Try to search what you have been looking for on main page:</p>
        
        <p>Link: <a href="index.php">Blog main page</a></p>
    </main>

</body>
</html>