<?php 
 
$server     = 'localhost'; 
$username   = 'projectGroup'; 
$password   = 'password@123'; 
$database   = 'forum'; 
$port       = '3307';
 
$db = null; 
 
try 
{ 
    $db = new PDO("mysql:dbname=".$database.";host=".$server.";port=".$port, 
    $username, $password); 
} 
catch (PDOException $e) 
{ 
    //echo 'Message: ' .$e->getMessage(); 
    exit('Error: could not establish database connection'); 
} 
 
$rows = $db->query("SELECT * FROM user_accounts;");

// this was just showing the first row
//$rowAry = $rows->fetch($rows->FETCH_ASSOC); 
//print_r ($rowAry['user_id']);

// $rCount = $rows -> rowCount();
// echo ($rCount);
// echo("<br/>");

// while($rCount > 0){
//     $rowAry = $rows->fetch($rows->FETCH_ASSOC); 
//     print_r ($rowAry['user_id']);
//     print_r ($rowAry[2]);
//     echo("<br/>");
//     $rCount--;
// }


// shows all rows, must use a while loop though to see all rows
// foreach ($rows as $row){
//     echo($row['user-id']);
// }

 
     
?> 