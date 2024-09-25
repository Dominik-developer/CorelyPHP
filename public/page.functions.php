<?php

session_start();


// header
function head(){
    ?>

    <h1> Home page</h1>
    
    <?php
}

// main
function all_articles(){

    require 'connect.php';


    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($conn->connect_errno) {
        echo "Error: " . $conn->connect_error;
        return;
    } else {

        //$sql = "SELECT title FROM articles";
        //$result = $conn->query($sql); 

        $sql = "SELECT `ID`, `title` FROM `articles` ";
        $result = $conn->query($sql); 
        
        if ($result->num_rows > 0) {
            $i=1;

            // Pętla po wynikach
            while ($row = $result->fetch_assoc()) {

                //echo $row['ID'];

                echo '
                    <article class="wrapper" onclick="redirectToArticle('.$row['ID'].')" >
                        <!--<section class="" >-->
                            <div class="articleTitle">
                                '. $row['title'] . '<br>
                            </div>
                            <div class="articleSummary">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio voluptatem animi itaque molestias suscipit ad eum. Dolorem non aliquid eveniet!
                            </div>
                        <!--</section>--> 
                    </article> <br>';
                

                $i = $i+1;


                //echo 'Artykuł '. $i . ': '. $row['title'] . "<br>";
            }
        } else {
            echo "Brak wyników";
        }

        $conn->close(); 
    }
    ?>
    <script>
        function redirectToArticle(id) {
        window.location.href = "single.php?id=" + id;
        }
    </script>


    <?php

}




//footer
function foot(){
    ?>

    <a>&copy 2024 - <?php echo date("Y"); ?> Dominik Szczepański <!--project:one®--></a>
    
    <?php
}

