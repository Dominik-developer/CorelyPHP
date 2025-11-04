<?php 
    // check if user is root
    if(checkAdminRole() !== 'root') {

        http_response_code(403);
        //include __DIR__ . '/../errors/403.php';
        redirect("./error");
        exit;
    }
?>

<?php
    echo "Approvals module.";
?>