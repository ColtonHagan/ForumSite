<?php 
session_start (); 
include('connect.php'); 
include("header.php");
?> 


<?php 
    $id = -1;
    $level = 1;
    
    //$search = '';
    //if (isset($_SESSION['search'])){
        //$search = $_SESSION['search'];
    //}

    if(isset($_SESSION['signed_in'])) 
    { 
        $level = $_SESSION['level'];
        $id = $_SESSION['id'];
        ?>
        <div id="forms">
            <form method = "post" action="search.php">
                <!-- looks through all of the content including title -->
                <input type="text" name="searchParam" placeholder = "search for..."></input>
                <select required name="filters">
                    <option selected value="0">all categories</option>
                    <?php
                        GetAllCategories();
                    ?>
                </select>
                <!-- do a request to get the value of the drop down selection -->
                <!-- the dropdown is a filter  -->
                <!-- dropdown for all categories or single categories -->
                
                <button type="submit">search</button>
            </form>
        <?php

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

                <button id="rmCat" onclick="displayForm('rmCatForm')">Delete Category</button>
                <div class="form-popup" id="rmCatForm">
                    <form method = "post" action="deletecategory.php" class="form-container">
                        <h1>Delete Category</h1>

                        <label for="rmCategory1">Choose a category:</label>
                        <select required name="rmCategory1" id="rmCategory1">
                            <option value="" disabled selected>-Select a category-</option>
                            <?php
                            GetAllCategories();
                            ?>
                        </select>
                        <br>
                        <button type="submit" class="btn">Delete</button>
                        <button type="button" class="btn cancel" onclick="hideForm('rmCatForm')">Cancel</button>
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
                
                <button id="rmTop" onclick="displayForm('rmTopicForm')">Delete Topic</button>
                <div class="form-popup" id="rmTopicForm">
                    <form method = "post" action="deletetopic.php" class="form-container">
                        <h1>Delete Topic</h1>
                    
                        <label for="rmCategory2">Choose a category:</label>
                        <select required class="rmCategory2" name="rmCategory2" id="rmCategory2">
                            <option value="" disabled selected>-Select a category-</option>
                            <?php
                            GetAllCategories();
                            ?>
                        </select>
                        <br>
                        <label for="rmTopics">Choose a topic:</label>
                        <select required class="rmTopics" name="rmTopics" id="rmTopics">
                            <option value="" disabled selected>-Select a topic-</option>
                            <!-- This is populated in CategorySelectionChanged() -->
                        </select>
                        <br>
                        <button type="submit" class="btn">Delete</button>
                        <button type="button" class="btn cancel" onclick="hideForm('rmTopicForm')">Cancel</button>
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

    include("viewpost.php");
    GetAllPosts($id, $level);

include 'footer.php'; 
?> 
