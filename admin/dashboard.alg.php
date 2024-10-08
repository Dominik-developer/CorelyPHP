<?php

session_start();

if(!isset ($_SESSION['adminLoged']))
{
    header('Location:panel.login.php');
    exit();
}


function dasboard_data() {

    //echo 'dashboard';


    echo'
        <div id="data">
            <div class="column">
                <header>
                    Data
                </header>
                <section class="columnContent">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae nostrum id numquam officia magnam quos! Perspiciatis inventore placeat nemo quos ipsa explicabo quia neque tempore pariatur autem beatae sunt vero est tempora tenetur similique harum accusantium iusto nostrum ipsam, blanditiis id. Optio, reprehenderit. Consequuntur beatae deleniti quisquam, hic ab molestias?
                </section>
            </div>

            <!--<div class="column">
                <header>
                    Real time data
                </header>
                <section class="columnContent">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae nostrum id numquam officia magnam quos! Perspiciatis inventore placeat nemo quos ipsa explicabo quia neque tempore pariatur autem beatae sunt vero est tempora tenetur similique harum accusantium iusto nostrum ipsam, blanditiis id. Optio, reprehenderit. Consequuntur beatae deleniti quisquam, hic ab molestias?
                </section>-->
            </div>
        </div>
        ';


}

