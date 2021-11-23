<?php 
include 'header.php'; 
 
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) 
{ 
    echo 'You are already signed in.<br>'; 
    echo '<br><a href="index.php">Home</a><br>'; 
    echo '<a href="signout.php">Sign out</a><br>'; 
} 
else 
{ 
    echo '<h3>Sign in</h3>'; 
    echo '<form method="post" action="signedin.php" id="signInForm"> 
        <input type="hidden" name="activity" value="signin"> 
        <label>Username: <input type="text" name="user_name" id="user"></label> 
        <label>Password: <input type="password" name="user_pass" id="pass"></label> 
        <input type="button" value="Sign in" onclick="validateSignIn()"/> 
        </form>'; 
} 
 
include 'footer.php'; 
?> 
