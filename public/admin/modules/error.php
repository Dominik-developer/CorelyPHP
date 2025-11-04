<?php

    if(empty($params[1])) {
        redirect('/admin/dashboard');
    }

    $code = $params[1] ?? 404;

    if($code != 404 && $code != 500 && $code != 403 && $code != 503) {
        redirect('/admin/error/404');
        exit();
    }

    //http_response_code($code);
?>

<article class="window">
        <section class="main" id="error">
            <h2>Something went wrong</h2>
            <section class="content">
                <h1>Error <?php echo $code; ?></h1>
                <span>Please reload the page with the button below:</span>
                <br>
                <br>
                <span><a href="/admin/dashboard"><button>Reload</button></a></span>
            </section>
        </section>
    </article>