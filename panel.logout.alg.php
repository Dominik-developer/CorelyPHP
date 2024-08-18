<?php

    session_start();

    session_unset(); //session_destroy();

    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Cache-Control: post-check=0, pre-check=0', false);
    header('Pragma: no-cache');
    header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');

    header('Location:panel.login.php');//panel.logout.out.php
    exit();
