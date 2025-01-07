<?php
// functions with structure of windows for admin panel 

session_start();

if(!isset ($_SESSION['adminLoged']))  // secruity 
{
    header('Location:panel.login.php');
    exit();
}

    function dashboard() {
    ?>
    <article class="article">
        <section class="menuBar">
            <a class="menuBar">Dashboard</a>
        </section>

        <section class="mainSection">
            <article class="mainArticle visible" id="articleDashboard">
                <div class="form-container" >
                    <h2></h2>
                        <?php

                            //include 'dashboard.alg.php';
                            echo 'error dashboard';
                            //dashboard_data();
                        ?>
                </div>
            </article>
        </section>
    </article>
    <?php
    };

    
    function addArticle() {
    ?>
    <article class="article">
        <section class="menuBar">
            <a>Add new article</a>
        </section>

        <section class="mainSection">
            <article class="mainArticle visible" id="articleAdd">
                <div class="form-container">
                    <h2>New article</h2>
                    <form action="new.alg.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-25">
                                <label for="title">Article title</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="title" name="title" required="required" placeholder="Title.." patter="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="textUpload">Article text</label>
                            </div>
                            <div class="col-75">
                                <input type="file" id="textUpload" name="textUpload" required="required" accept=".txt, .doc, .docx" enctype="multipart/form-data">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="photoUpload">Article photo</label>
                            </div>
                            <div class="col-75">
                                <input type="file" id="photoUpload" name="photoUpload" required="required" accept="image/png, image/jpeg" enctype="multipart/form-data">
                            </div>
                        </div>
                        <div class="row align-checkbox">
                            <input type="checkbox" id="visibility-checkbox" name="visibility" required="required">
                            <label for="visibility-checkbox">I confirm the publication of a new article</label>
                        </div>
                        <br>
                        <div class="row">
                            <input type="submit" value="Submit">
                        </div>
                    </form>
                </div>
            </article>
        </section>
    </article>
    <?php
    };


    function allArticles() {
    ?>
    <article class="article">
        <section class="menuBar">
            <a class="menuBar">All Articles</a>
            <!--<a class="menuBarLink">Search</a>-->
        </section>

        <section class="mainSection">
            <article class="mainArticle visible" id="articleAll">
                <div class="form-container" id="table-container">
                    <h2>All articles</h2>
                        <div id="table-container-inner">
                            <?php

                            include 'all_articles.alg.php';

                                //all();
                            ?>
                        </div>
                </div>
            </article>
        </section>
    </article>
    <?php
    };


    function serviceBreak() {
    ?>
    <article class="article">
        <section class="menuBar">
            <a>Service Break</a>
        </section>
        
        <section class="mainSection" >
            <article class="mainArticle visible" id="articleBreak">
                <div id="form-container">
                    <h2>Change status of service break</h2>
                    <form action="service_status.alg.php" method="POST">
                        <input type="hidden" name="setting_id" value="1">
                        <div class="row align-checkbox">
                            <input type="checkbox" id="visibility-checkbox" name="visibility" required="required">
                            <label for="visibility-checkbox">I confirm the change of status of service break</label>
                        </div>
                        <br>
                        <div class="row">
                            <button type="submit" name="toggle">Change status</button>
                        </div>
                    </form>
                </div>
            </article>
        </section>
    </article>
    <?php
    };


    function settings() {
    ?>
    <article class="article">
        <section class="menuBar">
            <a class="menuBar">Password</a>
            <!--<a class="menuBarLink">Password</a>-->
        </section>

        <section class="mainSection" >
            <article class="mainArticle visible" id="articleBreak">
                <div id="form-container">
                    <h2>Change Password</h2>
                    <form action="password.alg.php" method="POST">
                        <div class="row">
                            <input type="text" name="oldPass" placeholder="Old Password:" required="required">
                        </div>
                        <br>
                        <div class="row">
                            <input type="text" name="newPass" placeholder="New Password:" required="required">
                        </div>
                        <br>
                        <div class="row">
                            <input type="text" name="newPassAgain" placeholder="Repeat New Password:" required="required">
                        </div>
                        <br>
                        <div class="row align-checkbox">
                            <input type="checkbox" id="passwordChange-checkbox" name="passwordChange" required="required">
                            <label for="passwordChange-checkbox">I confirm the change of password</label>
                        </div>
                        <br>
                        <div class="row">
                            <button type="submit" name="send">Submit</button>
                        </div>
                    </form>
                </div>
            </article>
        </section>            
    </article>     
    <?php
    };



    