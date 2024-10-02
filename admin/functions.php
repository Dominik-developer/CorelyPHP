
<style>
    <?php /*include "main.css"; */?>

    /* -- CSS DEBUGGING -- */
    * {
        /*border: 1px solid red;*/
    }

</style>

<?php

    function addArticle() {
    ?>
    <article class="article">
        <section class="menuBar">
            <a>Add new article</a>
        </section>

        <section class="mainSection">
            <article class="mainArticle visible">
                <div class="form-container">
                    <h2>New article</h2>
                    <form action="all.test.php" method="POST" enctype="multipart/form-data">
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
            <a class="menuBarLink">All Articles</a>
            <!--<a class="menuBarLink">Search</a>-->

        </section>

        <section class="mainSection">
            <article class="mainArticle visible" id="articleBreak">
                <div id="table-container">
                    <h2>All articles</h2>
                        <?php

                            include 'all_articles.alg.php';

                            all();
                        ?>
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
    <article class="article ">
        <!--<section class="settings bar"></section>-->
        <section class="menuBar">
            <a class="menuBarLink">General settings</a>
            <a class="menuBarLink">Password</a>
            <!--<a class="menuBarLink">Theme</a>
            <a class="menuBarLink">Link 4</a>-->

        </section>

        <section class="mainSection" id="mainSettings">
            <article class="mainArticle visible">

                <a>Ustawienia</a>
                <!--<section class="mainArticleSection">
                    <header class="mainArticleHeader">
                        <a>Ustawienia 1</a>
                    </header>
                    <div class="mainArticleDiv">
                        Ustawienia 11
                    </div>
                </section>

                <section class="mainArticleSection">
                    <header class="mainArticleHeader">
                        <a>Ustawienia 2</a>
                    </header>
                    <div class="mainArticleDiv">
                        Ustawienia 22
                    </div>
                </section>
            </article>

            <article class="mainArticle" id="article2">
                <section class="mainArticleSection">
                    <header class="mainArticleHeader">
                        <a>Change your password</a>
                    </header>
                    <div class="mainArticleDiv">
                        Pass 1
                    </div>
                    <div class="mainArticleDiv">
                        Pass 2
                    </div>-->
                </section>
            </article>

            <!--<article class="mainArticle" id="article3"></article>
            <article class="mainArticle" id="article4"></article>-->

        </section>            
    </article>     
    <?php
    };

    