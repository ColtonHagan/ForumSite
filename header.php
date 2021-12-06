<?php
session_start (); 
?> 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8" /> 
    <title>Forum Site</title> 
    <link rel="stylesheet" href="styles/styles.css" type="text/css"> 
    <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head> 
<body> 
<h1>Early Internet Forum</h1> 
    <div id="wrapper"> 
        <div id="menu"> 
            <a class="item" href="index.php">Home</a> 
            <a class="item" id="postPopup" href="#">Sign in to be notified of new posts</a> 

            <div id="userbar"> 
<?php 
            if(isset($_SESSION['signed_in'])) 
            { 
                echo 'Hello ' . $_SESSION['username'] . '.&nbsp;&nbsp;&nbsp;<a 
href="signout.php"> Sign out </a>'; 
            } 
            else 
            { 
                echo '<a href="signin.php">Sign in</a> or <a href="signup.php">Create 
an account</a>.'; 
            } 
?> 
            </div> 
        </div> 
        <br><br> 
        <div id="content"> 