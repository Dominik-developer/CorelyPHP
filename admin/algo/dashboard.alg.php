<?php
declare(strict_types=1);

if(!isset ($_SESSION['adminLoged']))
{
    header('Location: ../panel.login.php');
    exit();
}

function dashboard_data(): string {

    return'
        <div id="hello">
            Welcome on admin panel for your blog!
            <br>
            We are evolving for you! :)
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

