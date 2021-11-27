<?php
session_start (); 
include("connect.php"); 
include("header.php");

$level = $_SESSION['level'];
$id = $_SESSION['id'];
    function getfilterposts($user_id, $user_level){
        if(isset($_POST['submit-search'])){
            $search = $_REQUEST['searchParam'];
            $category =  $_REQUEST['filters'];
            $key = false;

            global $db;
            $rows = $db->query("SELECT * FROM posts ORDER BY id ASC;");     
            $rows->execute();
            foreach ($rows as $row){
                
                $hidden = $row['hidden'];
                $category_id = $row['category_id'];
                $name = $row['name'];
                $id = $row['id'];
                $content = $row['content'];
                if ($hidden == 0 || $user_level > 1){
                    $post_user_id = $row['user_id'];
                    //the content id

                    if($category_id == $category || $category == 0){
                        //if it is the right category
                        //or if the filter is all categories
                        if(str_contains($name,$search)){
                            $key = true;
                            //if the keyword is in the name of the post
                        }
                        if(str_contains($content,$search)){
                            $key = true;
                            //if the keyword is in the content
                        }
                    }else{
                        $key = false;
                    }
 
                    if($key == true){?>
                        <form method = "post" action="searchpost.php">
                            <input type="hidden" name="post_id" value="<?= $id ?>">
                            <button type="submit" name = "single-post">go to the article: <?php echo($name)?></button>
                        </form>
                    <?php
                    }
                        
                }
            }
        }
    }
    getfilterposts($id, $level);
    include("footer.php");

?>
