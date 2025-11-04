<?php 
    // check if user is root
    if(checkAdminRole() !== 'root') {

        http_response_code(403);
        //include __DIR__ . '/../errors/403.php';
        redirect("./error");
        exit;
    }
?>
    <article class="window">
        <section class="main" id="maintenance">
            <h2>Maintnance mode</h2>
            <section class="content">
                <?php
                    updateMaintenance();
                ?>
                <form action="./serviceBreak" method="POST">
                    <input type="hidden" name="setting_id" value="1">
                        <div class="row align-checkbox">
                            <input type="checkbox" id="visibility-checkbox" name="visibility" required="required">
                            <label for="visibility-checkbox">I confirm the change of maintenance mode.</label>
                        </div>
                        <br>
                        <div class="row">
                            <button type="submit" name="toggle">Change status</button>
                        </div>        
                </form>
            </section>
        </section>
    </article>