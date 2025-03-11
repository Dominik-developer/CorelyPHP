<?php

require 'visits.alg.php'; 

function cookie($page): void {
    if (isset($_COOKIE['cookiesAccepted']) && $_COOKIE['cookiesAccepted'] === 'true') {
        setcookie("cookiesAccepted", "true", time() + (3600 * 24 * 365), "/public/"); //path may need to be changed for client

        if (!isset($_COOKIE['visitor_id'])) {
            $cookie_id = bin2hex(random_bytes(16));
            setcookie('visitor_id', $cookie_id, time() + (3600 * 24 * 365), "/public/");
        } else {
            $cookie_id = $_COOKIE['visitor_id'];
        }

        updateVisitCount($cookie_id, $page);
    } else {
        setcookie('visitor_id', "", time() - 3600, "/public/");
    }
}
 