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
$latestPostId = $rowAry['name'];

echo("Latest post: " . $latestPostId);

}

?>