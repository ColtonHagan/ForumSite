<?php

$server     = 'localhost'; 
$username   = 'root'; 
$password   = 'root'; 
$database   = 'forum'; 
$port       = '3307';
 
$db = null; 
$latestPostId = -1;
if(isset($_POST["id"])){
    $id = $_POST["id"];
 
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

$rows = $db->query("SELECT * FROM posts ORDER BY id DESC;");
$rowAry = $rows->fetch($rows->FETCH_ASSOC); // This grabs the first row 
$latestPostName = $rowAry['name'];
$postid = $rowAry['id'];

echo('<form method = "post" action="searchpost.php" style="display:inline;">
        <input type="hidden" name="post_id" value="'.$postid.'">
        <button type="submit" name = "single-post">Latest Post: '.$latestPostName.'</button>
        </form>');

}

?>