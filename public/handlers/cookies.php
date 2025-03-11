<?php

require 'visits.alg.php'; 

function cookie($page): void {

    if (!isset($_COOKIE['visitor_id'])) {

        $cookie_id = bin2hex(random_bytes(16));
        setcookie('visitor_id', $cookie_id, time() + (3600 * 24 * 365), "/CorelyPHP-1.1.0/public/"); // path may need to be changed
    } else {
        $cookie_id = $_COOKIE['visitor_id'];
    }

    updateVisitCount($cookie_id, $page);

}

    //$page = basename($_SERVER['PHP_SELF']);  