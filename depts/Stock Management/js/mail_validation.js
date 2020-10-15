$(document).ready(function(){

    $("#sender_nameErr").hide();
    $("#sender_emailErr").hide();
    $("#mail_subErr").hide();
    $("#mail_msgErr").hide();

    var sender_nameErr = false;
    var sender_emailErr = false;
    var mail_subErr = false;
    var mail_msgErr = false;

    $("#sender_name").blur(function(){

        check_name();

    });

    $("#sender_email").blur(function(){

        check_sender_email();

    });

    $("#mail_sub").blur(function(){

        check_mail_sub();

    });

    $("#mail_msg").blur(function(){

        check_mail_msg();

    });


    function check_name() {

        var name_length = $("#sender_name").val().length;
        // var name_regx = new RegExp(/^(?=.*[a-zA-Z ]).{2,}$/);
        
        if(name_length < 2){
            $("#sender_nameErr").html("Name must contains at least 2 characters.");
            $("#sender_nameErr").show();
            nameErr = true;
        }else{
            $("#sender_nameErr").hide();
        }

    }

    function check_sender_email(){

        var email_regx = new RegExp(/^[+A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/i);

        if(email_regx.test($("#sender_email").val())){
            $("#sender_emailErr").hide();
            
        }else{
            $("#sender_emailErr").html("Please enter a valid Email address.");
            $("#sender_emailErr").show();
            sender_emailErr = true;   
        }

    }

    function check_mail_sub() {

        var name_length = $("#mail_sub").val().length;
        // var name_regx = new RegExp(/^(?=.*[a-zA-Z ]).{2,}$/);
        
        if(name_length < 2){
            $("#mail_subErr").html("Subject must contains at least 2 characters.");
            $("#mail_subErr").show();
            mail_subErr = true;
        }else{
            $("#mail_subErr").hide();
        }

    }

    function check_mail_msg() {

        var name_length = $("#mail_msg").val().length;
        // var name_regx = new RegExp(/^(?=.*[a-zA-Z ]).{2,}$/);
        
        if(name_length < 2){
            $("#mail_msgErr").html("Message must contains at least 2 characters.");
            $("#mail_msgErr").show();
            mail_msgErr = true;
        }else{
            $("#mail_msgErr").hide();
        }

    }

    $("#sendmail").submit(function(){

        sender_nameErr = false;
        sender_emailErr = false;
        mail_subErr = false;
        mail_msgErr = false;

        check_name();
        check_sender_email();
        check_mail_sub();
        check_mail_msg();
        

        if(sender_nameErr == false && sender_emailErr == false && mail_subErr == false && mail_msgErr == false){
            return true;
        } else {
            return false;
        }

    });


});