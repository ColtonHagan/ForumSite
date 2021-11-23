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
 

// this was just showing the first row

// $rCount = $rows -> rowCount();
// echo ($rCount);
// echo("<br/>");

function GetAllCategories(){
    echo '<script>console.log("Starting get all categories")</script>';
    // $server     = 'localhost'; 
    // $username   = 'projectGroup'; 
    // $password   = 'password@123'; 
    // $database   = 'forum'; 
    // $port       = '3307';
    
    // $db = null; 
    
    // try 
    // { 
    //     $db = new PDO("mysql:dbname=".$database.";host=".$server.";port=".$port, 
    //     $username, $password); 
    // } 
    // catch (PDOException $e) 
    // { 
    //     //echo 'Message: ' .$e->getMessage(); 
    //     exit('Error: could not establish database connection'); 
    // } 
    global $db;
    $rows = $db->query("SELECT * FROM categories;"); 

    $rows->execute();
    $rCount = $rows -> rowCount();
    //echo(($rows == null ? "<option>hi</option>" : "<option>".$rCount."</option>"));

    foreach ($rows as $row){
         echo("<option value='".$row['id']."'>".$row["name"]."</option>");
     }
    
    //$data = $rows -> fetch(PDO::FETCH_ASSOC);
    //while($rCount > 0)){
       // $rowAry = $rows->fetch($rows->FETCH_ASSOC);
        //echo '<script>console.log("Whilin")</script>';
       // $name = $data['name'];
       // $id = $data['id'];
       // echo "<option value='".$id."'>".$name."</option>";
        //<option value="science">Science</option>
        //$rCount--;
    //}

    echo '<script>console.log("Finished")</script>';

}

// $query = "SELECT id, username, level, password FROM user_accounts" .  
//                  " WHERE username = '$name';"; 

function checkHidden($category){
    global $db;
   // echo '<script>console.log("' .$category . '")</script>';
    $rows = $db->query("SELECT id, hidden, name FROM categories" . " WHERE id = $category;");
    $rows->execute();
    //echo '<script>console.log("After Query")</script>';
    //$rCount = $rows -> rowCount();
    $rowAry = $rows->fetch($rows->FETCH_ASSOC); // This grabs the first row 
    //echo '<script>console.log("' .$rowAry["name"] . '")</script>';
    
    

    if($rowAry["hidden"] == 1){
        return 1;
    }
        


    // while($rCount > 0){
    //     $rowAry = $rows->fetch($rows->FETCH_ASSOC); 
    //     if($rowAry["hidden"] == 1 && $rowAry["name"] == $category){
    //         return true;
    //     }
    //     $rCount--;
    // }

    return 0;
}

// shows all rows, must use a while loop though to see all rows
// foreach ($rows as $row){
//     echo($row['user-id']);
// }

 
     
?> 