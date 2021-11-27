<?php
session_start (); 
include("connect.php"); 
include("header.php");

$level = $_SESSION['level'];
$id = $_SESSION['id'];
if (isset($id) && isset($level)){
    getfilterposts($id, $level);
}

function getfilterposts($user_id, $user_level){
    $search = $_REQUEST['searchParam'];
    $category = $_REQUEST['filters'];
    $key = false;

    global $db;
    $rows = $db->query("SELECT * FROM posts ORDER BY id ASC;");     
    $rows->execute();
    foreach ($rows as $row){
        
        $hidden = $row['hidden'];
        $category_id = $row['category_id'];
        $name = $row['name'];
        $postid = $row['id'];
        $content = $row['content'];
        if ($hidden == 0 || $user_level > 1){
            $post_user_id = $row['user_id'];
            //the content id

            if($category_id == $category || $category == 0){
                //if it is the right category
                //or if the filter is all categories
                if(strpos($name, $search) !== false){
                    $key = true;
                    //if the keyword is in the name of the post
                }
                else if(strpos($content, $search) !== false){
                    $key = true;
                    //if the keyword is in the content
                }
                else{
                    $key = false;
                }
            }else{
                $key = false;
            }

            if($key){
                $post_user_id = $row['user_id'];
                $author = $db->query("SELECT username, id FROM user_accounts WHERE id = $post_user_id;"); 
                $author->execute();
                $authAry = $author->fetch($author->FETCH_ASSOC); 

                $cat = $db->query("SELECT name, id FROM categories WHERE id = ".$row['category_id']); 
                $cat->execute();
                $catAry = $cat->fetch($cat->FETCH_ASSOC);

                $top = $db->query("SELECT name, id FROM topics WHERE id = ".$row['topic_id']); 
                $top->execute();
                $topAry = $top->fetch($top->FETCH_ASSOC); 
                echo('
                <form method = "post" action="searchpost.php">
                    <p>Category: '.$catAry["name"].' | Topic: '.$topAry["name"].'</p>
                    <p>Title: '.$name.' | Content: '.strlen($content).' characters</p>
                    <p>By: '.$authAry["username"].'
            
                    <input type="hidden" name="post_id" value="'.$postid.'">
                    <button type="submit" name = "single-post">go to the article</button></p>
                </form><hr>');
            }
                
        }
    }
}
include("footer.php");

?>
