<?php 
session_start (); 
include 'connect.php'; 
include("header.php");

$post = $_REQUEST['rmPost']; 

if ($post != "")
{

    $sql = "DELETE FROM 
                posts WHERE id = ?"; 

    $stmt= $db->prepare($sql); 
    $status = $stmt->execute([$post]);
    
    if ($status != 1) 
    { 
        echo 'Something went wrong while deleting post. Please try again later.'; 
    } 
    else 
    { 
        echo 'Successfully deleted post '.$post .'. You can now go <a href="index.php">Home</a>'; 
    } 

}