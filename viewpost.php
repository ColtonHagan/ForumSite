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
                if ($hidden == 0 || $user_level > 1){
                    $post_user_id = $row['user_id'];
                    $author = $db->query("SELECT username, id FROM user_accounts WHERE id = $post_user_id;"); 
                    $author->execute();
                    $authAry = $author->fetch($author->FETCH_ASSOC);
                    //add the topic name the name
                    //and add the category maybe one or the other in h3
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
                }
            }
        
        }

        function postSearch($substring,$filter){
            global $db;
            $rows = $db->query("SELECT * FROM posts ORDER BY id ASC;"); 
            $rows->execute(); 
            $key = false;
            foreach ($rows as $row){    
                //if($filter == -1||)
                //very similar to get all posts
                if(str_contains($name,$substring)){
                    $key = true;
                }
                if(str_contains($content,$substring)){
                    $key = true;
                }
                if($key){
                    $hidden = $row['hidden'];
                    if ($hidden == 0 || $user_level > 1){
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
                    }
                }


            }

        }
  
?>

