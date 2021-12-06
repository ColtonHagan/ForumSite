<?php
session_start (); 
include("connect.php"); 
include("header.php");

$level = $_SESSION['level'];
$id = $_SESSION['id'];
if (isset($id) && isset($level)){
    getfilterposts($id, $level);
}
else{
    getfilterposts(-1, 1);
}

function getfilterposts($user_id, $user_level){
    $search = strtolower($_REQUEST['searchParam']);
    $category = $_REQUEST['filters'];
    $key = false;

    global $db;
    $rows = $db->query("SELECT * FROM posts ORDER BY id ASC;");     
    $rows->execute();
    $hiddenCount = 0;
    $results = 0;
    foreach ($rows as $row){
        
        $hidden = $row['hidden'];
        $category_id = $row['category_id'];
        $topic_id = $row['topic_id'];
        $name = $row['name'];
        $postid = $row['id'];
        $content = $row['content'];

        $cat = $db->query("SELECT name, id FROM categories WHERE id = ".$category_id); 
        $cat->execute();
        $catAry = $cat->fetch($cat->FETCH_ASSOC);

        $top = $db->query("SELECT name, id FROM topics WHERE id = ".$topic_id); 
        $top->execute();
        $topAry = $top->fetch($top->FETCH_ASSOC); 

        $post_user_id = $row['user_id'];
        //the content id

        if($category_id == $category || $category == 0){
            //if it is the right category
            //or if the filter is all categories
            if(strpos(strtolower($catAry["name"]), $search) !== false){
                $key = true;
                //if the keyword is in the name of the post
            }
            else if(strpos(strtolower($topAry["name"]), $search) !== false){
                $key = true;
                //if the keyword is in the name of the post
            }
            else if(strpos(strtolower($name), $search) !== false){
                $key = true;
                //if the keyword is in the name of the post
            }
            else if(strpos(strtolower($content), $search) !== false){
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
            if ($hidden == 0 || $user_level > 1){
                $results++;
                $post_user_id = $row['user_id'];
                $author = $db->query("SELECT username, id FROM user_accounts WHERE id = $post_user_id;"); 
                $author->execute();
                $authAry = $author->fetch($author->FETCH_ASSOC); 

                echo('
                <form method = "post" action="searchpost.php">
                    <p>Category: '.$catAry["name"].' | Topic: '.$topAry["name"].'</p>
                    <p>Title: '.$name.' | Content: '.strlen($content).' characters</p>
                    <p>By: '.$authAry["username"].'
            
                    <input type="hidden" name="post_id" value="'.$postid.'">
                    <button type="submit" name = "single-post">go to the article</button></p>
                </form><hr>');
            }
            else{
                $hiddenCount++;
            }
        }
    }
    if ($results < 1){
        echo('No results were found relating to your search...');
    }
    else if ($level < 2 && $hiddenCount > 0){
        echo('<h3 style="color:red;">Some posts are hidden... Sign in to see them!</h3><hr>');
    }
}
include("footer.php");

?>
