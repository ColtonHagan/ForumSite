<?php
        /* for now I'm adding all of this stuff but I plan on adding include connect.php */
        $server     = 'localhost'; 
        $username   = 'root'; 
        $password   = 'root'; 
        $database   = 'forum'; 
        $port       = '3307'; 
        
        $db = null; 
        
        try 
        {  
            $db = new PDO("mysql:dbname=".$database.";host=".$server.";port=".$port, 
            $username, $password); 
        } 
        // connects to the forum database
        catch (PDOException $e) 
        { 
            //echo 'Message: ' .$e->getMessage(); 
            exit('Error: could not establish database connection'); 
        } 
        
        //gets timestamp
        //if(isset($_POST['timestamp'])){
        //    $timestamp = $_POST['timestamp'];
        //}

        function GetAllPosts($user_id, $user_level){
            global $db;
            $rows = $db->query("SELECT * FROM posts ORDER BY id ASC;"); 
        
            $rows->execute();

        
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
                if ($hidden == 0 || $user_level > 1){
                    //add the topic name the name
                    //and add the category maybe one or the other in h3
                    
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
            }
        
        }
  
?>

