<?php 
include 'connect.php'; 
include 'header.php'; 
 
$activity = $_REQUEST['activity']; 
if ($activity == "signup") 
{ 
    date_default_timezone_set('America/Los_Angeles'); 
    $name = $_REQUEST['user_name']; 
    $pass = password_hash($_REQUEST['user_pass'], PASSWORD_DEFAULT); 
    $email = $_REQUEST['user_email']; 
   
    $sql = "INSERT INTO  
            users(user_id, user_name, user_pass, user_email , user_level)  
            VALUES (?, ?, ?, ?, ?)"; 
 
    $stmt= $db->prepare($sql); 
    $status = $stmt->execute([NULL, $name, $pass, $email, date("Y-m-d H:i:s"), 0]); 
 
    if ($status != 1) 
    { 
        echo 'Something went wrong while signing up. Please try again later.'; 
    } 
    else 
    { 
        echo 'Successfully signed up. You can now <a href="signin.php">sign in</a>'; 
    } 
} 
else 
{ 
    echo '<h3>Sign up</h3>'; 
    echo '<form method="get" action="" id="signUpForm"> 
        <input type="hidden" name="activity" value="signup"> 
        <label>Username: <input type="text" name="user_name" id="user"></label> 
        <br>
        <label>Password: <input type="password" name="user_pass" id="pass"></label> 
        <label>Password again: <input type="password" name="user_pass_check" id = "pass2"></label> 
        <input type="button" value="Sign up" onclick="validateSignUp()"/> 
     </form>'; 
} 
 
include 'footer.php'; 
?> 