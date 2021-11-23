<?php 
session_start (); 
include 'connect.php'; 
include("header.php");
?> 

<?php 


$viewStatus = $_REQUEST['viewClass']; 
$post = $_REQUEST['pst']; 

if ($viewStatus == "in") $viewStatus = 1;
else $viewStatus = 0;

$sql = "INSERT INTO  
            posts(id, category_id, topic_id, user_id, hidden, name) VALUES (?, ?, ?, ?, ?, ?)"; 

$stmt= $db->prepare($sql); 
$status = $stmt->execute([NULL, $viewStatus, $post]);

if ($status != 1) 
{ 
    echo 'Something went wrong while adding post. Please try again later.'; 
} 
else 
{ 
    echo 'Successfully added post '.$post .'. You can now go <a href="index.php">Home</a>'; 
} 