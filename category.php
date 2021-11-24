<?php 
session_start (); 
include 'connect.php'; 
include("header.php");

$viewStatus = $_REQUEST['viewClass']; 
$category = $_REQUEST['categoryTitle']; 

if ($viewStatus == "in") $viewStatus = 1;
else $viewStatus = 0;

if ($category != "")
{

    $sql = "INSERT INTO  
                categories(id, hidden, name) VALUES (?, ?, ?)"; 

    $stmt= $db->prepare($sql); 
    $status = $stmt->execute([NULL, $viewStatus, $category]);

    if ($status != 1) 
    { 
        echo 'Something went wrong while adding category. Please try again later.'; 
    } 
    else 
    { 
        echo 'Successfully added category '.$category .'. You can now go <a href="index.php">Home</a>'; 
    } 

}