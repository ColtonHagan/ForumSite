<?php 
session_start (); 
include 'connect.php'; 
include("header.php");
?> 

<?php 


$title = $_REQUEST['topic_title']; 
$category = $_REQUEST['category']; 

$hidden = checkHidden($category);



$sql = "INSERT INTO  
            topics(id, category_id, hidden, name) VALUES (?, ?, ?, ?)"; 

$stmt= $db->prepare($sql); 
$status = $stmt->execute([NULL, $category, $hidden, $title]);

if ($status != 1) 
{ 
    echo 'Something went wrong while adding topic. Please try again later.'; 
} 
else 
{ 
    echo 'Successfully added topic '.$title .'. You can now go <a href="index.php">Home</a>'; 
} 