<?php

if(isset($_POST["category"])){
    $category = $_POST["category"];
    echo(GetAllTopics($category));
}

function GetAllTopics($category){
    $server     = 'localhost'; 
    $username   = 'root'; 
    $password   = 'root'; 
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

    $rows = $db->query("SELECT id, name FROM categories WHERE id = $category;");
    $rows->execute();
    $rowAry = $rows->fetch($rows->FETCH_ASSOC); // This grabs the first row 
    $chosenCategoryId = $rowAry['id'];

    $rows = $db->query("SELECT id, name FROM topics WHERE category_id = $chosenCategoryId ORDER BY name ASC;");
    $rows->execute();

    $topics = "";
    foreach ($rows as $row){
        $topics .= "<option value='".$row['id']."'>".$row["name"]."</option>";
    }
    return $topics;

}

?>
