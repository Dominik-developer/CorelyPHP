
<?php
    
    
        if (isset($_GET['id']) && ctype_digit($_GET['id']) && (int)$_GET['id'] > 0) {
        
        //require_once 'data_loading.alg.php';

        //$articleData = edit_dataLoading($_GET['id']);

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
                        Article dditing will be available again since version 2.1.0.
                        <div id="table-container-inner">
                            <?php
                                //include 'all_articles.alg.php';
                                //all();
                            ?>
                        </div>
                    </section>
                </section>
            </article>
        <?php

        }