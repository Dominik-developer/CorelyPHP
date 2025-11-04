   <article class="window">
        <section class="main" id="content">
            <h2>Content</h2>
            <section class="content">

            <?php
                if(empty($URLparams[1])) {
            ?>
                <div class="tile-grid">
                    <div class="tiles">
                        <div class="tile"><a href="./content/all">All content</a></div>
                        <div class="tile"><a href="./content/new">New content</a></div>
                        <div class="tile"><a href="./content/edit">Edit content</a></div>
                        
                        <?php if(checkAdminRole() === 'root'): ?>
                            <!--<div class="tile"><a href="./four"></a></div>
                            <div class="tile"><a href="./five"></a></div>-->
                            <div class="tile"><a href="./content/approvals">Approvals</a></div>
                        <?php endif; ?>
                    </div>
                </div> 
            <?php
                } else {
                
                    $contentOptionFilePath = basename($URLparams[1]);

                    $fullOptionPath = "modules/content/$contentOptionFilePath.php";

                    if(file_exists($fullOptionPath)) {
                        include $fullOptionPath;

                    } else {
                        include "modules/error.php";
                    }
                }
            ?>
            </section>
        </section>
    </article>