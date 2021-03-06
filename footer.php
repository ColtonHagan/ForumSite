<?php
    include("processcategory.php");
?>

</div><!-- content --> 
</div><!-- wrapper --> 
<div id="footer">&copy; 2021 CSCI397B</div> 

<script>
    // document.getElementById("postPopup").style.display = "none";

    <?php
    if(isset($_SESSION['signed_in'])){
    ?>
    hidePopups();

    $(document).ready(function(){
        $(".category2").change(function(){
            var selectedCategory = $(".category2").val();
            $.ajax({
                type: "POST",
                url: "processcategory.php",
                data: {category:selectedCategory}
            }).done(function(data){
                $("#topics").html(data);
            });
        });
        $(".rmCategory2").change(function(){
            var selectedCategory = $(".rmCategory2").val();
            $.ajax({
                type: "POST",
                url: "processcategory.php",
                data: {category:selectedCategory}
            }).done(function(data){
                $("#rmTopics").html(data);
            });
        });
    });

    postUpdater();

    function postUpdater(){
        var newId = document.getElementById("postPopup").innerHTML;

        $.ajax({
            type: "POST",
            url: "postpopup.php",
            data: {id:newId},
            success: function(response){
                $("#postPopup").html(response);
            },
            complete:function(){
                setTimeout(postUpdater, 500);
            }
        });
    }
    

    function hidePopups(){
        let forms = document.getElementsByClassName("form-popup");
        for (form = 0; form < forms.length; form++){
            forms[form].style.display = "none";
        }
    }
    
    function displayForm(formId){
        let form = document.getElementById(formId);
        if (form.style.display == "none") form.style.display = "block";
        else form.style.display = "none";
    }

    function hideForm(formId){
        document.getElementById(formId).style.display = "none";
    }

    <?php
    }   //hide all functions not relevant to those not logged in
    ?>
    
    let id = (id) => document.getElementById(id);
    let isEmpty = (str) => !str || str.length === 0;

    function specialChars(inputString, minLength, maxLength) {
        const test = /^[a-zA-Z0-9\@\*\!]+$/;
        var result = (inputString.length < maxLength && inputString.length > minLength); 
        result = result && !(inputString.match(test) == null);
        return result;
    }

    
    function validateSignIn() {
        var user = id("user").value;
        var pass = id("pass").value;
        console.log(user);
        var userBool = !isEmpty(user) && specialChars(user, 2, 29);
        var passBool = !isEmpty(pass) && specialChars(pass, 7, 254);
        if (userBool && passBool) {
            id("signInForm").submit();
            console.log("valid");
        }
        else{
            console.log("invalid");
        }
    }


    function validateSignUp(){
        var user = id("user").value;
        var pass = id("pass").value;
        var pass2 = id("pass2").value;
        console.log("user " + user);
        var userBool = !isEmpty(user) && specialChars(user, 2, 29);
        var passBool = !isEmpty(pass) && specialChars(pass, 7, 254) && (pass === pass2);
        if (userBool && passBool) {
            console.log("Valid");
            id("signUpForm").submit();
        }
        else{
            console.log("Invalid");
        }
    }

</script>
</body> 
</html> 