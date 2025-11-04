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