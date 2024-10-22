<?php

session_start();

if(!isset ($_SESSION['adminLoged']))
{
    header('Location:panel.login.php');
    exit();
}


function dasboard_data() {

    echo'
        <div id="hello">
            Welcome on admin panel for your blog!

        </div>
        ';
}
?>

<style>

    div#hello{
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        display: flex;
        margin-top: -10%;
        font-size: x-large;
    }
</style>

