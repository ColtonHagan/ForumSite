<?php 
session_start (); 
include 'connect.php'; 
include("header.php");

$user_id = $_REQUEST['user_id'];
$category = $_REQUEST['category2']; 
$topic = $_REQUEST['topics']; 
$post_contents = $_REQUEST['con'];
$post_title = $_REQUEST['pst'];


$hidden = checkHidden($category);

// Not sure how to get user_id
$sql = "INSERT INTO  
            posts(id, category_id, topic_id, user_id, hidden, name, content) VALUES (?, ?, ?, ?, ?, ?, ?)"; 

$stmt= $db->prepare($sql); 
$status = $stmt->execute([NULL,$category,$topic, $user_id, $hidden, $post_title, $post_contents]);

if ($status != 1) 
{ 
    echo 'Something went wrong while adding post. Please try again later.'; 
} 
else 
{ 
    echo 'Successfully added post '.$post .'. You can now go <a href="index.php">Home</a>'; 
} 