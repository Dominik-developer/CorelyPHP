<?php
    // functions with structure of windows for admin panel 

if(!isset ($_SESSION['adminLoged']))  
{
    header('Location:panel.login.php');
    exit();
}

    // dashboard ==========================================
    function dashboard(){
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
    function allArticles(){
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
    function addArticle(){
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

  
    function editArticle(){
                
        if (isset($_GET['id']) && ctype_digit($_GET['id']) && (int)$_GET['id'] > 0) {
        
        require_once 'data_loading.alg.php';

        $articleData = edit_dataLoading($_GET['id']);

            if ($articleData === null) {
                
                echo "No article data found.";
            } else {
    ?>
            <article class="window">
                <section class="main" id="edit">
                    <h2>Edit article <?php echo "ID: " . $articleData['ID']; ?></h2>
                    <section class="content">
                        <form action="./algo/edit.alg.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-25">
                                    <label for="title">Article title</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="title" name="title" required="required" placeholder="Title.." patter="" value="<?php echo $articleData['title']; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="textUpload">Article text</label>
                                </div>
                                <div class="col-75">
                                    <textarea id="articleContent" name="articleContent" required="required" placeholder="Write your article content here..." rows="10" cols="50"><?php  echo $articleData['text']; ?></textarea>
                                </div>
                            </div>
                                <div class="col-25">
                                    <label for="photoUpload">See old photo</label>
                                </div>
                                <div class="col-75">
                                    <img src="<?php echo $articleData['photo_path']; ?>" alt="<?php echo $articleData['title']; ?> photo" width="150" height="120">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="photoUpload">Submit new photo</label>
                                </div>
                                <div class="col-75">
                                    <input type="file" id="photoUpload" name="photoUpload" required="required" accept="image/png, image/jpeg" enctype="multipart/form-data">
                                </div>
                            </div>
                                <br>
                            <div class="row align-checkbox">
                                <input type="checkbox" id="visibility-checkbox" name="visibility" required="required">
                                <label for="visibility-checkbox">I confirm the changes to the article.</label>
                            </div>
                                <br>
                            <div class="row align-checkbox">
                                <input type="submit" value="Submit">
                                <!--<button class="blue" type="submit" name="submit">Submit</button>--> <!-- if works, change for this one -->
                            </div>
                        </form>
                            <br>
                        <form action="./algo/delete.alg.php" method="POST">
                            <div class="row align-checkbox">
                                <input type="checkbox" id="passwordChange-checkbox" name="passwordChange" required="required">
                                <label for="passwordChange-checkbox">I confirm delete of article.</label>
                            </div>
                                    <br>
                            <div class="row">
                                <button class="red" type="submit" name="send">Delete article</button>
                            </div>
                        </form>
                    </section>
                </section>
            </article>
    <?php
            }

        } else {

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
    

    // service break ==========================================
    function serviceBreak(){
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


    // settings ==========================================
    function settings(){
    ?>
        
    <article class="window">
        <section class="main" id="settings">
            <h2>Settings</h2>
                <section class="content">
                    <!-- password -->
                    <form action="./algo/password.alg.php" method="POST">
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
    function error() {
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
