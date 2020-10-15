$(document).ready(function(){

    $("#nameErr").hide();
    $("#usernameErr").hide();
    $("#emailErr").hide();
    $("#passwordErr").hide();
    $("#password2Err").hide();

    var nameErr = false;
    var usernameErr = false;
    var emailErr = false;
    var passwordErr = false;
    var password2Err = false;

    $("#name").blur(function(){

        check_name();

    });

    $("#username").blur(function(){

        check_username();

    });

    $("#email").blur(function(){

        check_email();

    });

    $("#password").blur(function(){

        check_password();

    });

    $("#password2").blur(function(){

        check_password2();

    });

    function check_name() {

        var name_length = $("#name").val().length;
        // var name_regx = new RegExp(/^(?=.*[a-zA-Z ]).{2,}$/);
        
        if(name_length < 2){
            $("#nameErr").html("Name must contains at least 2 characters.");
            $("#nameErr").show();
            nameErr = true;
        }else{
            $("#nameErr").hide();
        }

    }

    function check_username(){

        var username_regx = new RegExp(/^(.*[A-Za-z])(.*[0-9])$/);

        if(!username_regx.test($("#username").val())){
            $("#usernameErr").html("Username must Start with Name and End with Numbers.");
            $("#usernameErr").show();
            usernameErr = true;
        }else{
            $("#usernameErr").hide();
        }

    }

    function check_email(){

        var email_regx = new RegExp(/^[+A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/i);

        if(email_regx.test($("#email").val())){
            $("#emailErr").hide();
            
        }else{
            $("#emailErr").html("Please enter a valid Email address.");
            $("#emailErr").show();
            emailErr = true;   
        }

    }

    function check_password(){

        var password_regx = new RegExp(/^(?=.*[A-Z])(?=.*[-$#@*])(?=.*[0-9])(?=.*[a-z]).{8,14}$/i);
        var password_length = $("#password").val().length;

        if(password_length < 8 || password_length > 14){
            $("#passwordErr").html("Password must contains 8-14 characters.");
            $("#passwordErr").show();
            passwordErr = true;
        }else if(!password_regx.test($("#password").val())){
            $("#passwordErr").html('Password must contains One Number and One special character from "-$#@*".');
            $("#passwordErr").show();
            passwordErr = true;
        }else{
            $("#passwordErr").hide();
        }
        
    }

    function check_password2(){

        if($("#password2").val() != $("#password").val()){
            $("#password2Err").html("Password doesn't match.");
            $("#password2Err").show();
            password2Err = true;
        }else{
            $("#password2Err").hide();
        }

    }

    $("#register-form").submit(function(){

        nameErr = false;
        usernameErr = false;
        emailErr = false;
        passwordErr = false;
        password2Err = false;

        check_name();
        check_username();
        check_email();
        check_password();
        check_password2();

        if(nameErr == false && emailErr == false && usernameErr == false && passwordErr == false && password2Err == false){
            return true;
        } else {
            return false;
        }

    });

});



