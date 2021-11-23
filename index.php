<?php 
session_start (); 
include('connect.php'); 
include("header.php");
?> 


<?php 

    if(isset($_SESSION['signed_in'])) 
    { 
        ?>
        <div id="forms">
        <?php
        $level = $_SESSION['level'];

        switch($level){
            case 4:
                ?>
                <button id="mkCat" onclick="displayForm('categoryForm')">Make Category</button>
                <div class="form-popup" id="categoryForm">
                    <form method = "post" action="category.php" class="form-container">
                        <h1>Create Category</h1>
                        
                        <label for="viewClass">View class:</label>
                        <select name="viewClass" id="viewClass" placeholder="-view placeholder-">
                            <option value="viewPlaceholder">-view placeholder-</option>
                            <option value="in">logged in to view</option>
                            <option value="out">viewed by all</option>
                        </select>
                        <br>
                        <label for="category">Category title:</label>
                        <input type="text"name="category"/>
                        <br>
                        <button type="submit" class="btn">Submit</button>
                        <button type="button" class="btn cancel" onclick="hideForm('categoryForm')">Close</button>
                    </form>
                </div>
                <?php
            case 3:
                ?>
                <button id="mkTop" onclick="displayForm('topicForm')">Make Topic</button>
                <div class="form-popup" id="topicForm">
                    <form method = "post" action="topic.php" class="form-container">
                        <h1>Create Topic</h1>
                    
                        <label for="category">Choose a category:</label>
                        <select name="category" id="category" placeholder="-Select a category-">
                            <?php
                            GetAllCategories();
                            ?>
                        </select>
                        <br>
                        <label for="topic_title">Topic title:</label>
                        <input type="text"name="topic_title"/>
                        <br>
                        <button type="submit" class="btn">Submit</button>
                        <button type="button" class="btn cancel" onclick="hideForm('topicForm')">Close</button>
                    </form>
                </div>
                <?php
            case 2:
                ?>
                <button id="mkPos" onclick="displayForm('postForm')">Make Post</button>
                <div class="form-popup" id="postForm">
                    <form method = "post" action="post.php" class="form-container">
                        <h1>Create Post</h1>
                    
                        <label for="category">Choose a category:</label>
                        <select name="category" id="category" placeholder="-Select a category-">
                            <option value="placeholder">-Select a category-</option>
                            <option value="science">Science</option>
                            <option value="politics">Politics</option>
                            <option value="social">Social</option>
                            <option value="economy">Economy</option>
                            <option value="education">Education</option>
                            <option value="art">Art</option>
                            <option value="personal">Personal</option>
                        </select>
                        <br>
                        <label for="tpc">Choose a topic:</label>
                        <select name="topics" id="topics" placeholder="-Select a topic-">
                            <option value="placeholder">-Select a topic-</option>
                            <option value="science">Science</option>
                            <option value="politics">Politics</option>
                        </select>
                        <br>
                        <label for="pst">Post title:</label>
                        <input type="text"name="pst"/>
                        <br>
                        <label for="pst">write your post:</label>
                        <textarea name="pst"></textarea>
                        <br>
                        <button type="submit" class="btn">Submit</button>
                        <button type="button" class="btn cancel" onclick="hideForm('postForm')">Close</button>
                    </form>
                </div>
                <?php
                break;
            case 1:
                echo 'Log in to post';
                break;
        }
        ?>
            <hr>
            </div>
        <?php
    } 
        ?>
        <h1>Posts here</h1>
        <?php

include 'footer.php'; 
?> 

<!-- Location in ssh: /var/www/html/schradt -->
<!-- Site: http://csci397b.cs.wwu.edu/schradt/b56NNAzc/Lab5/index.php -->
<!-- DB: csci397b.cs.wwu.edu/phpmyadmin -->