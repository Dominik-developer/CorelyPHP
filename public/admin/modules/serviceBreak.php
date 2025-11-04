    <article class="window">
        <section class="main" id="service">
            <h2>Service Break</h2>
            <section class="content">
                <?php
                    updateMaintenance();
                ?>
                <form action="./serviceBreak" method="POST">
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