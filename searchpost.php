<?php
session_start (); 
include("connect.php"); 
include("header.php");
$level = $_SESSION['level'];
$id = $_REQUEST['post_id'];
if(isset($_POST['single-post'])){
    
    global $db;
    $rows = $db->query("SELECT * FROM posts ORDER BY id ASC;"); 
    $rows->execute();
    foreach ($rows as $row){
        $current_id = $row['id'];
        if ($id == $current_id){          
            echo("<div class = 'post' id ='post".$row['id']."'>");
            echo("<h2>".$row['name']."</h2>");
            echo("<p>".$row['content']."</p>");
            echo("</div>");
        }
    }
    
    
}


include("footer.php");
?>