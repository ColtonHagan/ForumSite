<?php 
 
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
catch (PDOException $e) 
{ 
    //echo 'Message: ' .$e->getMessage(); 
    exit('Error: could not establish database connection'); 
} 


function GetAllCategories(){

    global $db;
    $rows = $db->query("SELECT * FROM categories ORDER BY name ASC;"); 

    $rows->execute();

    foreach ($rows as $row){
         echo("<option value='".$row['id']."'>".$row["name"]."</option>");
    }

}


function checkHidden($category){
    global $db;
   // echo '<script>console.log("' .$category . '")</script>';
    $rows = $db->query("SELECT id, hidden, name FROM categories" . " WHERE id = $category;");
    $rows->execute();
    //echo '<script>console.log("After Query")</script>';
    //$rCount = $rows -> rowCount();
    $rowAry = $rows->fetch($rows->FETCH_ASSOC); // This grabs the first row 
    //echo '<script>console.log("' .$rowAry["name"] . '")</script>';

    if($rowAry["hidden"] == 1){
        return 1;
    }
    return 0;
}

function displayPost($post) {
    global $db;

    $row = $db->query("SELECT * FROM posts WHERE name = $post;");

    if(checkHidden($post) == 1){
        echo '<h1>Cannot display this post</h1>';
    }
    echo("<div class = 'post' id ='post".$row['id']."'>");
    echo("<h2>".$row['name']."</h2>");
    echo("<p>".$row['content']."</p>");
}


    
?>
