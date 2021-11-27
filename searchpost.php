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
            $post_user_id = $row['user_id'];
            $author = $db->query("SELECT username, id FROM user_accounts WHERE id = $post_user_id;"); 
            $author->execute();
            $authAry = $author->fetch($author->FETCH_ASSOC);     
            echo("<div class = 'post' id ='post".$row['id']."'>");
            echo("<h3 style='float:right;'>Posted by: ".$authAry['username']."</h3>");
            echo("<h2>".$row['name']."</h2>");
            echo("<p>".$row['content']."</p>");
            if ($post_user_id == $user_id || $user_level > 2){ 
                echo('<form method = "post" action="deletepost.php" class="form-container">');
                echo('<input type="hidden" name="rmPost" value="'.$row["id"].'">');
                echo('<button type="submit" class="btn">delete</button>');
                echo("</form>");
            }
            echo("</div>");
            return;
        }
    }
    
    
}


include("footer.php");
?>