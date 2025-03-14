<?php

session_start();

require_once './handlers/service.alg.php';

    service();

    header('Location: main.php');

