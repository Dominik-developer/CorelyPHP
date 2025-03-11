<?php

// header
function head(): void{
    
    echo '<h1> Blog </h1>';
}

// main
function all_articles(): void{

    require 'connect.php';

    $conn = @new mysqli($host, $db_user, $db_password, $db_name);
    //error_reporting(E_ALL);
    //ini_set('display_errors', 1);

    if ($conn->connect_errno) {
        echo 'Error';
        return;
    } else {

        $sql = "SELECT `ID`, `title`, `text`, photo_path FROM `articles` ";
        $result = $conn->query($sql); 
        
        if ($result->num_rows > 0) {
            $i=1;

            while ($row = $result->fetch_assoc()) {

                $sanitized_title = preg_replace('/[^a-zA-Z0-9-_.!ąćęłńóśźżĄĆĘŁŃÓŚŹŻ]/', '_', $row['title']); //optionally use - insted of _

                //$restored_title = str_replace('_', ' ', $sanitized_title);

                echo '
                    <article class="wrapper">
                        <a href="single.php?title=' . urlencode($sanitized_title) . '" style="text-decoration:none; color:inherit;">
                            <div class="articleTitle">
                                '. $row['title'] . '<br>
                            </div>
                            <div class="articleSummary">
                            
                                <img src="../'.$row['photo_path'].'" alt="photo from article ">
                                
                                <br>

                                <td>' . substr($row['text'], 0, 50) . '...<td>
                               
                            </div>
                        </a>
                    </article> <br>';
                
                $i = $i+1;

            }
        } else {
            echo "No results found.";
        }

        $conn->close(); 
    }
}


//footer
function foot(): void{

    $date = date("Y");
    
    echo "
        <div>
            <a>&copy 2024 - {$date} Dominik-developer <!--project:one®--></a>
            <br><br>
             <a> Contact: www.blog@example.com</a> <!--<a>+00 000 000 000  </a>-->
        </div>";
   
}
