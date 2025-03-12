<?php
declare(strict_types=1);

// functions with structure of windows for admin panel 

if(!isset ($_SESSION['adminLoged']))  
{
    header('Location:panel.login.php');
    exit();
}
    // dashboard ==========================================
    function dashboard(): void{
    ?>

    <article class="window">
        <section class="main" id="dashboard">
            <h2>Dashboard</h2>
            <section class="content">
                <?php
                    include './algo/dashboard.alg.php';
                    dashboard_data();
                ?>
            </section>
        </section>
    </article>

    <?php
    }


    // all articles ==========================================
    function allArticles(): void{
    ?>

    <article class="window">
        <section class="main" id="all">
            <h2>All articles</h2>
            <section class="content">
                <div id="table-container-inner">
                    <?php
                        include 'all_articles.alg.php';
                        all();
                    ?>
                </div>
            </section>
        </section>
    </article>

    <?php
    }


    // add article ==========================================
    function addArticle(): void{
    ?>

    <article class="window">
        <section class="main" id="add">
            <h2>Add article</h2>
            <section class="content">
                <form action="./algo/new.alg.php" method="POST" enctype="multipart/form-data">
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
                        <br>
                    <div class="row align-checkbox">
                        <input type="checkbox" id="visibility-checkbox" name="visibility" required="required">
                        <label for="visibility-checkbox">I confirm the publication of a new article.</label>
                    </div>
                        <br>
                    <div class="row">
                        <input type="submit" value="Post">
                    </div>
                </form>
            </section>
        </section>
    </article>

    <?php
    }


    // edit article ==========================================

  
    function editArticle(): void{
                
        if (isset($_GET['id']) && ctype_digit($_GET['id']) && (int)$_GET['id'] > 0) {
        
        require_once 'data_loading.alg.php';

        $articleData = edit_dataLoading($_GET['id']);

        if ($articleData === null) {

            echo "<p>No article data found.</p>";
        } else {
    
        ?>
            <article class="window">
                <section class="main" id="edit">
                    <h2>Edit article <?php echo "ID: " . $articleData['ID']; ?></h2>
                    <section class="content">
                        <form action="./algo/edit.alg.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?php echo $articleData['ID']; ?>">

                            <div class="row">
                                <div class="col-25">
                                    <label for="new_title">Article title</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="new_title" name="new_title" required="required" placeholder="Title.." patter="" value="<?php echo $articleData['title']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="new_text">Article text</label>
                                </div>
                                <div class="col-75">
                                    <textarea id="new_text" name="new_text" required="required" placeholder="Write your article content here..." rows="10" cols="50"><?php  echo $articleData['text']; ?></textarea>
                                </div>
                            </div>
                                <div class="col-25">
                                    <label for="old_photo">Old photo</label>
                                </div>
                                <div class="col-75">
                                    <img name="old_photo" src="<?php echo '../'.$articleData['photo_path']; ?>" alt="<?php echo $articleData['title']; ?> photo" width="150" height="120">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="new_photo">Submit new photo</label>
                                </div>
                                <div class="col-75">
                                    <input type="file" id="new_photo" name="new_photo" accept="image/png, image/jpeg" enctype="multipart/form-data">
                                </div>
                            </div>
                                <br>
                            <div class="form-container">
                                <div class="form-left">
                                    <input type="hidden" name="id" value="<?php echo $articleData['ID']; ?>">
                                    <div class="row align-checkbox">
                                        <input type="checkbox" id="visibility-checkbox" name="visibility" required="required">
                                        <label for="visibility-checkbox">I confirm the changes to the article.</label>
                                    </div>
                                    <div class="row">
                                        <input type="submit" value="Submit changes">
                                    </div>
                                </div>
                        </form>
                            <br>
                                <div class="form-right">
                                    <form action="./algo/delate.alg.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                                        <div class="row align-checkbox">
                                            <input type="checkbox" id="passwordChange-checkbox" name="passwordChange" required="required">
                                            <label for="passwordChange-checkbox">I confirm delete of article.</label>
                                        </div>
                                        <div class="row">
                                            <button class="red" type="submit" name="send">Delete article</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </section>
                </section>
            </article>
        <?php

        }// end of showing edit form

        } else { // no id, showing list of all articles

        ?>
            <article class="window">
                <section class="main" id="all">
                    <h2>Choose article to edit</h2>
                    <section class="content">
                        <div id="table-container-inner">
                            <?php
                                include 'all_articles.alg.php';
                                all();
                            ?>
                        </div>
                    </section>
                </section>
            </article>
        <?php

        }
    }

    // add theme ==========================================

    function themes(): void {
    ?>

    <article class="window">
        <section class="main" id="service">
            <h2>Add theme</h2>
            <section class="content">
                <!--<form action="./algo/theme.alg.php" method="POST">-->
                <form method="POST">
                    <input type="hidden" name="setting_id" value="1">
                        <div class="row align-checkbox">
                            <!-- FORM -->
                            <label for="visibility-checkbox">I confirm adding new theme.</label>
                        </div>
                        <br>
                        <div class="row">
                            <button type="submit" name="submit">Add theme</button>
                        </div>        
                </form>
            </section>
        </section>
    </article>

    <?php
    }
    

    // service break ==========================================
    function serviceBreak(): void{
    ?>
    
    <article class="window">
        <section class="main" id="service">
            <h2>Service Break</h2>
            <section class="content">
                <form action="./algo/service_status.alg.php" method="POST">
                    <input type="hidden" name="setting_id" value="1">
                        <div class="row align-checkbox">
                            <input type="checkbox" id="visibility-checkbox" name="visibility" required="required">
                            <label for="visibility-checkbox">I confirm the change of status of service break.</label>
                        </div>
                        <br>
                        <div class="row">
                            <button type="submit" name="toggle">Change status</button>
                        </div>        
                </form>
            </section>
        </section>
    </article>
    
    <?php
    }

    // analytics ==========================================
    function analytics(): void {
    ?>

    <article class="window">
        <section class="main" id="service">
            <h2>Analytics</h2>
            <section class="content">
                Analytics will be available since version 1.3.0
            </section>
        </section>
    </article>

    <?php
    }


    // settings ==========================================
    function settings(): void{
    ?>
        
    <article class="window">
        <section class="main" id="settings">
            <h2>Settings</h2>
                <section class="content">
                    <!-- password -->
                    <form action="./algo/password.alg.php" method="POST">
                        <div class="row">
                            <input type="password" name="oldPass" placeholder="Old Password:" required="required">
                        </div>
                        <br>
                        <div class="row">
                            <input type="password" name="newPass" placeholder="New Password:" required="required">
                        </div>
                        <br>
                        <div class="row">
                            <input type="password" name="newPassAgain" placeholder="Repeat New Password:" required="required">
                        </div>
                        <br>
                        <div class="row align-checkbox">
                            <input type="checkbox" id="passwordChange-checkbox" name="passwordChange" required="required">
                            <label for="passwordChange-checkbox">I confirm the change of password.</label>
                        </div>
                        <br>
                        <div class="row">
                            <button type="submit" name="send">Submit</button>
                        </div>
                    </form>
                </section>
            </section>
    </article>
        
    <?php
    }   

    // error ==========================================
    function error(): void {
    ?>

    <article class="window">
        <section class="main" id="error">
            <h2>Something went wrong</h2>
            <section class="content">
                <span>Something went wrong, please reload the page with the link below</span>
                <span><a href="panel.php?window=dashboard">Reload</a></span>
            </section>
        </section>
    </article>

    <?php
    }
