<?php

session_start();

require_once 'service.alg.php';
//require_once 'main.php';

    service();

    header('Location: main.php');



