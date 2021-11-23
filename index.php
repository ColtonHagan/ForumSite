<?php 
include 'header.php'; 
 
    if(isset($_SESSION['signed_in'])) 
    { 
        $level = $_SESSION['level'];

        switch($level){
            case 4:
                ?>
                <button id="mkCat">Make Category</button>
                <?php
            case 3:
                ?>
                <button id="mkTop">Make Topic</button>
                <?php
            case 2:
                ?>
                <button id="mkPos">Make Post</button>
                <?php
                break;
            case 1:
                echo 'Log in to post';
                break;
        }
    } 

include 'footer.php'; 
?> 



<!-- Location in ssh: /var/www/html/schradt -->
<!-- Site: http://csci397b.cs.wwu.edu/schradt/b56NNAzc/Lab5/index.php -->
<!-- DB: csci397b.cs.wwu.edu/phpmyadmin -->