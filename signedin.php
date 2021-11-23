<?php 
session_start (); 
include 'connect.php'; 
include("header.php");
?> 

<?php 
 
 
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true) 
{ 
    echo 'You are already signed in.<br>'; 
    echo '<br><a href="index.php">Home</a><br>'; 
    echo '<a href="signout.php">Sign out</a><br>'; 
} 
else 
{ 
    $activity = $_REQUEST['activity']; 
 
    if ($activity == "signin") 
    { 
        $name = $_REQUEST['user_name']; 
        $pass = $_REQUEST['user_pass']; 
         
        $query = "SELECT id, username, level, password FROM user_accounts" .  
                 " WHERE username = '$name';"; 
 
        $rows = $db->query($query); 
 
        if($rows == null) 
        { 
            echo 'Something went wrong while signing in. Please try again.'; 
        } 
        else 
        { 
            $rowAry = $rows->fetch($rows->FETCH_ASSOC); 
             
            if((password_verify($pass, $rowAry['password']) == false) || 
                 (count($rowAry) == 0) ||  
                 ($rowAry == null)) 
            { 
                echo 'You have supplied a wrong user/password combination. Please try 
again.'; 
            } 
            else 
            { 
                session_regenerate_id(); 
                $_SESSION['signed_in'] = true; 
                $_SESSION['id']    = $rowAry['id']; 
                $_SESSION['username']  = $rowAry['username']; 
                $_SESSION['level'] = $rowAry['level']; 
                 
                echo 'Welcome, ' . $_SESSION['username'] . '.<br>'; 
                echo '<br><a href="index.php">Home</a><br>'; 
                echo '<a href="signout.php">Sign out</a><br>'; 
            } 
        } 
    } 
} 
 
include 'footer.php'; 
?>