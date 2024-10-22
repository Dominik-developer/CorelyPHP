
<!DOCTYPE html>
<?php

session_start();
 
if(!isset ($_SESSION['adminLoged']))
{
    header('Location:panel.login.php');
    exit();
}


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // Sesja wygasła - usuń dane sesji
    session_unset();     // Usuń wszystkie zmienne sesji
    session_destroy();   // Zniszcz sesję
}
$_SESSION['LAST_ACTIVITY'] = time(); // Aktualizacja czasu ostatniej aktywności


//additional files
require_once 'panel.connect.php';
include_once 'functions.php';

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel #<?php echo $_SESSION['id'];?></title>

    <!-----===== SECRUITY TAGS ===== -->
    <meta name="robots" content="noindex, nofollow">

    <meta http-equiv="Cache-Control" content="no-store">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!--<meta http-equiv="Content-Security-Policy" content="default-src 'self';">-->

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="referrer" content="no-referrer">

    <!-----====== CSS ====== -->
    <link rel="stylesheet" type="text/css" href="panel.css">
    <link rel="stylesheet" type="text/css" href="main.css" >

    <!-----==== Boxicons CSS ==== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>

    <nav>
        <div class="logo">
            <i class="bx bx-menu menu-icon"></i>
            <span class="logo-name">Admin Panel #<?php echo $_SESSION['id']; ?></span>
        </div>

        <div class="sidebar">
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <span class="logo-name">Admin Panel </span>
            </div>

            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list" id="allBtn">
                        <a class="nav-link">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="link">Dashboard</span>
                        </a>
                    </li>
                    <!--<li class="list" id="section1Btn">
                        <a href="#" class="nav-link">
                            <i class="bx bx-bar-chart-alt-2 icon"></i>
                            <span class="link">Revenue</span>
                        </a>
                    </li>-->
                    <li class="list">
                        <a class="nav-link" id="section1Btn">
                            <i class="bx bxs-grid icon"></i>
                            <span class="link">All articles</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" id="section2Btn">
                            <i class="bx bx-plus-circle icon"></i>
                            <span class="link">Add article</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" id="section3Btn">
                            <i class="bx bx-hard-hat icon"></i>
                            <span class="link">Service break</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" id="section#Btn">
                            <i class="bx bx-pie-chart-alt-2 icon"></i>
                            <span class="link">Analytics</span>
                        </a>
                    </li>
                    <!--<li class="list">
                        <a href="#" class="nav-link" id="section#Btn">
                            <i class="bx bx-folder-open icon"></i>
                            <span class="link">Files</span>
                        </a>
                    </li>-->
                    
                </ul>

                <div class="bottom-content">
                    <ul>
                        <li class="list">
                            <a class="nav-link" id="section4Btn">
                                <i class="bx bx-cog icon"></i>
                                <span class="link">Settings</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="panel.logout.alg.php" class="nav-link" id="logOut">
                                <i class="bx bx-log-out icon logOut"></i>
                                <span class="link logOut">Log out</span>
                            </a>
                        </li>
                    </ul>
                    <!--<a class="list";>&copy 2024 - <?php echo date("Y"); ?> Admin Panel</a>-->
                </div>
            </div>
        </div>
    </nav>

    <main>
        <section class="section" id="allSection">
            <?php

                dashboard();
            ?>
        </section>

        <section class="section" id="section1">
            <?php
                allArticles();
            ?>
        </section>

        <section class="section" id="section2">
            <?php
                addArticle();
            ?>
        </section>

        <section class="section" id="section3">
            <?php
                serviceBreak();
            ?>
        </section>

        <!--<section class="main" id="section#">
            <?php
                //echo 'analitics';
            ?>
        </section>-->

        <section class="section visible" id="section4">
            <?php
                settings();
            ?>
        </section>
        
    </main>

    <section class="overlay"></section>

    
    <?php
        if (isset($_SESSION['message'])) {
            echo "
            <div class='overlayPopout' id='overlay'>
                <div class='popout'>
                    <span class='close-btn' id='close-btn'>&times;</span>
                    <p>{$_SESSION['message']}</p>
                </div>
            </div>";
            unset($_SESSION['message']);
        }
    ?>

    <!-- ---- JS ---- -->
    <script type="text/javascript" src="index.js"></script>

</body>
</html>