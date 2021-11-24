<?php 
session_start (); 
include 'connect.php'; 
include("header.php");

$topic = $_REQUEST['rmTopics']; 

if ($topic != "")
{

    $sql = "DELETE FROM 
                topics WHERE id = ?"; 

    $stmt= $db->prepare($sql); 
    $status = $stmt->execute([$topic]);
    
    $sql = "DELETE FROM 
                posts WHERE topic_id = ?"; 

    $stmt= $db->prepare($sql); 
    $status = $stmt->execute([$topic]);


    if ($status != 1) 
    { 
        echo 'Something went wrong while deleting topic. Please try again later.'; 
    } 
    else 
    { 
        echo 'Successfully deleted topic '.$topic .'. You can now go <a href="index.php">Home</a>'; 
    } 

}