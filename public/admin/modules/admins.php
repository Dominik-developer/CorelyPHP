<?php 
    // check if user is root
    if(checkAdminRole() !== 'root') {

        http_response_code(403);
        //include __DIR__ . '/../errors/403.php';
        redirect("./error");
        exit;
    }
?>
<article class="window">
        <section class="main" id="admins">
            <h2>Admins</h2>
            <section class="content">
                <div id="table-container-inner">
                    Admins will be available since version 2.1.0.
                </div>
            </section>
        </section>
    </article>