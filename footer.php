</div><!-- content --> 
</div><!-- wrapper --> 
<div id="footer">&copy; 2021 CSCI397B</div> 

<script>
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
        console.log(user);
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