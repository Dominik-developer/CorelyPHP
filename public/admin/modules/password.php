<article class="window">
        <section class="main" id="password"> <?php //id="settings" ?>
            <h2>Password</h2>
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