
<!DOCTYPE html>
<?php

session_start();


if(!isset ($_SESSION['adminLoged']))
{
    header('Location: panel.login.php');
    exit();
}


if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // Session expired - delete session data
    session_unset();     // Delete all session variables
    session_destroy();   // Destroy session
}
$_SESSION['LAST_ACTIVITY'] = time(); // Last Activity Time Update


//additional files
require_once 'panel.connect.php';
include 'window_functions.php';

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
    <link rel="stylesheet" type="text/css" href="./CSS/panel.css">
    <link rel="stylesheet" type="text/css" href="./CSS/window.css" >

    <!-----==== Boxicons CSS ==== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-----==== noscript = CSS = JS ==== -->
    <noscript>
            <p class="noscript">JavaScript is disabled in your browser. Please enable JavaScript to use all the features of this site.
            <br><a href="panel.logout.alg.php">Log out</a></p>

        <style>
            nav,main{
                display: none;
            }

            body{
                background-color: #fff;
            }

            p.noscript {
                font-size: large;
                text-align: center;
                margin-top: 20%;
                color: red;
            }
        </style>
    </noscript>
</head>

<body>
    <nav>
        <div class="logo">
            <i class="bx bx-menu menu-icon topbar"></i>
            <span class="logo-name topbar">Admin Panel #<?php echo $_SESSION['id']; ?></span>
        </div>

        <div class="sidebar">
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <span class="logo-name">Admin Panel </span>
            </div>

            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list">
                        <a class="nav-link" href="?window=dashboard">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="link">Dashboard</span>
                        </a>
                    </li>
                    <!--<li class="list">
                        <a class="nav-link" href="?window=revenue">
                            <i class="bx bx-money icon"></i>
                            <span class="link">Revenue</span>
                        </a>
                    </li>-->
                    <li class="list">
                        <a class="nav-link"  href="?window=all-articles">
                            <i class="bx bxs-grid icon"></i>
                            <span class="link">All articles</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" href="?window=add-article">
                            <i class="bx bx-plus-circle icon"></i>
                            <span class="link">Add article</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" href="?window=edit-article&id=0">
                            <i class="bx bx-edit-alt icon"></i>
                            <span class="link">Edit article</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" href="?window=service-break">
                            <i class="bx bx-hard-hat icon"></i>
                            <span class="link">Service break</span>
                        </a>
                    </li>
                    <!--<li class="list">
                        <a class="nav-link" href="?window=analytics">
                            <i class="bx bx-pie-chart-alt-2 icon"></i>
                            <i class="bx bxs-analyse icon" ></i>
                            <span class="link">Analytics</span>
                        </a>
                    </li>-->
                    <!--<li class="list">
                        <a class="nav-link" href="?window=files">
                            <i class="bx bx-folder-open icon"></i>
                            <span class="link">Files</span>
                        </a>
                    </li>-->
                    
                </ul>

                <div class="bottom-content">
                    <ul>
                        <li class="list">
                            <a class="nav-link" id="section4Btn" href="?window=settings">
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
                    <a class="list";>&copy 2024 - <?php echo date("Y"); ?> Admin Panel</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?php

        $windows = ["dashboard", /*"revenue",*/ "all-article", "add-article", "edit-article", "service-break", /*"analytics", "files",*/ "settings"];
        $currentWindow = isset($_GET["window"]) ? $_GET["window"]: "dashboard";

        if($_GET["window"] == "dashboard" || !isset($_GET["window"]) ){
            
            dashboard();

        }else{ // if new widows added, there must be added new if statements added as well

            if($_GET["window"] == "all-articles"){

                allArticles();

            }elseif($_GET["window"] == "add-article"){

                addArticle();
                

            }elseif($_GET["window"] == "edit-article"){

                editArticle();

            }elseif($_GET["window"] == "service-break"){

                serviceBreak();

            }elseif($_GET["window"] == "settings"){

                settings();

            }else{ 
            
                error();

            }
        }
        ?>
    </main>

    <section class="overlay"></section>

    <?php
    /* ---- POPOUT ---- */
        if (isset($_SESSION['message'])) {
            echo "
            <div class='overlayPopout hidden' id='overlay'>
                <div class='popout'>
                    <span class='close-btn' id='close-btn'>&times;</span>
                    <p>{$_SESSION['message']}</p>
                </div>
            </div>";
            unset($_SESSION['message']);
        }
    ?>

    <!-- ---- JS ---- -->
    <script type="text/javascript" src="./JS/index.js"></script>

</body>
</html>