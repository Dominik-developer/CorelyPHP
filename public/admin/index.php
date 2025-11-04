<?php

require_once ("../../core/init.php");

if(!logged_in()) {
    redirect("./login.php");
    exit();
}

// router system
$URLparams = include 'router.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <!-----===== SECRUITY TAGS ===== -->
    <meta name="robots" content="noindex, nofollow">

    <meta http-equiv="Cache-Control" content="no-store">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!--<meta http-equiv="Content-Security-Policy" content="default-src 'self';">-->

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="referrer" content="no-referrer">

    <!-----====== CSS ====== -->
    <link rel="stylesheet" type="text/css" href="/admin/CSS/panel.css">
    <link rel="stylesheet" type="text/css" href="/admin/CSS/window.css" >

    <!-----==== Boxicons CSS ==== -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-----==== noscript = CSS & JS ==== -->
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
            <span class="logo-name topbar"> Admin Panel</span>
            <!--<span class="logo-name topbar" id="name-right"></span>-->
        </div>

        <div class="sidebar">
            <div class="logo">
                <i class="bx bx-menu menu-icon"></i>
                <span class="logo-name">Admin Panel </span>
            </div>

            <div class="sidebar-content">
                <ul class="lists">
                    <li class="list">
                        <a class="nav-link" href="./dashboard">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="link">Dashboard</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link"  href="./allArticles">
                            <i class="bx bxs-grid icon"></i>
                            <span class="link">All articles</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" href="./addArticle">
                            <i class="bx bx-plus-circle icon"></i>
                            <span class="link">Add article</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" href="./editArticle">
                            <i class="bx bx-edit-alt icon"></i>
                            <span class="link">Edit article</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" href="./themes">
                            <i class="bx bxs-color icon"></i>
                            <span class="link">Themes</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" href="./serviceBreak">
                            <i class="bx bx-hard-hat icon"></i>
                            <span class="link">Service break</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" href="./analytics">
                            <i class="bx bx-pie-chart-alt-2 icon"></i>
                            <span class="link">Analytics</span>
                        </a>
                    </li>
                    <li class="list">
                        <a class="nav-link" href="./files">
                            <i class="bx bx-folder-open icon"></i>
                            <span class="link">Files</span>
                        </a>
                    </li>
                </ul>

                <div class="bottom-content">
                    <ul>
                        <li class="list">
                            <a class="nav-link" id="section4Btn" href="./settings">
                                <i class="bx  bx-cog icon"></i> 
                                <span class="link">Settings</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="logout.php" class="nav-link" id="logOut">
                                <i class="bx bx-log-out icon logOut"></i>
                                <span class="link logOut">Log out</span>
                            </a>
                        </li>
                    </ul>
                    <a class="list";>&copy 2024 -  <?php echo date("Y"); ?></a>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <?php
            // main window loading system
            $moduleFilePath = basename($URLparams[0]);

            $fullPath = "modules/$moduleFilePath.php";

            if(file_exists($fullPath)) {
                include $fullPath;

            } else {
                include "modules/error.php";
            }
        ?>
    </main>

    <section class="overlay"></section>

    <?php
    /* ---- POPOUT ---- */
        popout_message()
    ?>

    <!-- ---- JS ---- -->
    <script type="text/javascript" src="./JS/index.js"></script>

</body>
</html>