<?php 
session_start (); 
include 'connect.php'; 
include("header.php");

$category = $_REQUEST['rmCategory1']; 

if ($category != "")
{

    $sql = "DELETE FROM 
                categories WHERE id = ?"; 

    $stmt= $db->prepare($sql); 
    $status = $stmt->execute([$category]);

    $sql = "DELETE FROM 
                topics WHERE category_id = ?"; 

    $stmt= $db->prepare($sql); 
    $status = $stmt->execute([$category]);
    
    $sql = "DELETE FROM 
                posts WHERE category_id = ?"; 

    $stmt= $db->prepare($sql); 
    $status = $stmt->execute([$category]);


    if ($status != 1) 
    { 
        echo 'Something went wrong while deleting category. Please try again later.'; 
    } 
    else 
    { 
        echo 'Successfully deleted category '.$category .'. You can now go <a href="index.php">Home</a>'; 
    } 

}