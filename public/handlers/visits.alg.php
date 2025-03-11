<?php

function updateVisitCount($cookie_id, $page): void {

    require 'connect.php'; 

    $conn = new mysqli($host, $db_user, $db_password, $db_name);

    if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sprawdzamy, czy w tabeli visitors istnieje już taki rekord (unikalny cookie_id)
    $query = "SELECT * FROM visitors WHERE cookie_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $cookie_id);  // Łączymy parametr cookie_id
    $stmt->execute();
    $result = $stmt->get_result();

    // Jeśli użytkownik nie istnieje, dodajemy nowy rekord
    if ($result->num_rows === 0) {
        $query = "INSERT INTO visitors (cookie_id, visit_count, first_visit) 
                  VALUES (?, 1, CURRENT_TIMESTAMP)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $cookie_id);
        $stmt->execute();
    } else {
        // Jeśli już istnieje, aktualizujemy licznik odwiedzin
        $query = "UPDATE visitors SET visit_count = visit_count + 1 
                  WHERE cookie_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $cookie_id);
        $stmt->execute();
    }

    // Teraz aktualizujemy liczbę odwiedzin na stronie
    $query = "INSERT INTO page_views_daily (page, visit_date, visit_count) 
              VALUES (?, CURRENT_DATE, 1)
              ON DUPLICATE KEY UPDATE visit_count = visit_count + 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $page);  // Łączymy parametr strony
    $stmt->execute();

    $stmt->close();
}
?>

