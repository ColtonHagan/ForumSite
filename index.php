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
        $id = $_SESSION['id'];

        switch($level){
            case 4:
                ?>
                <button id="mkCat" onclick="displayForm('categoryForm')">Make Category</button>
                <div class="form-popup" id="categoryForm">
                    <form method = "post" action="category.php" class="form-container">
                        <h1>Create Category</h1>
                        
                        <label for="viewClass">View class:</label>
                        <select name="viewClass" id="viewClass">
                            <option value="" disabled selected>-Select a visability-</option>
                            <option value="in">logged in to view</option>
                            <option value="out">viewed by all</option>
                        </select>
                        <br>
                        <label for="categoryTitle">Category title:</label>
                        <input required type="text"name="categoryTitle"/>
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
                    
                        <label for="category1">Choose a category:</label>
                        <select required name="category1" id="category1">
                            <option value="" disabled selected>-Select a category-</option>
                            <?php
                            GetAllCategories();
                            ?>
                        </select>
                        <br>
                        <label for="topicTitle">Topic title:</label>
                        <input required type="text"name="topicTitle"/>
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

                        <input type="hidden" name="user_id" value="<?= $id ?>">
                        <label for="category2">Choose a category:</label>
                        <select required class="category2" name="category2" id="category2">
                            <option value="" disabled selected>-Select a category-</option>
                            <?php
                            GetAllCategories();
                            ?>
                        </select>
                        <br>
                        <label for="topics">Choose a topic:</label>
                        <select required name="topics" id="topics">
                            <option value="" disabled selected>-Select a topic-</option>
                            <!-- This is populated in CategorySelectionChanged() -->
                        </select>
                        <br>
                        <label for="pst">Post title:</label>
                        <input required type="text" name="pst"/>
                        <br>
                        <label for="con">write your post:</label>
                        <textarea required name="con"></textarea>
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