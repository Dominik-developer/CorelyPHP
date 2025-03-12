
<?php

require '../themes/handlers/index.php';

$theme = themeChecker();

$theme = $theme ?? 'default';

    echo '      <!-- ====== CSS ====== --> ' . PHP_EOL;;
    echo '      <link rel="stylesheet" href="../themes/' . $theme . '/CSS/main.css">' . PHP_EOL;
    echo '      <link rel="stylesheet" href="../themes/' . $theme . '/CSS/single.css">' . PHP_EOL;

    //echo '      <!-- ====== Boxicons CSS ====== --> ' . PHP_EOL;
    //echo "      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>".  PHP_EOL;

    //echo '      <!-- ====== JS ====== --> ' . PHP_EOL;;
    //echo '      <script src="../themes/' . $theme . '/JS/index.js"></script>' . PHP_EOL;

    //echo '      <!-- ====== noscript = CSS = JS ====== --> ' . PHP_EOL;
    //echo '      <noscript></noscript>' . PHP_EOL;

