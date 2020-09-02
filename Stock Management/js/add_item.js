$(document).ready(function(){

    $("#codeErr").hide();
    $("#weightErr").hide();
    $("#labourErr").hide();
    $("#priceErr").hide();

    var codeErr = false;
    var weightErr = false;
    var labourErr = false;
    var priceErr = false;

    $("#code").blur(function(){

        check_code();

    });

    $("#weight").blur(function(){

        check_weight();

    });

    $("#labour").blur(function(){

        check_labour();

    });

    $("#price").blur(function(){

        check_price();

    });

    function check_code() {

        var code_regx = new RegExp(/^(.*[A-Za-z])(.*[0-9])$/);

        if($("#code").val() == ""){
            $("#codeErr").html("Required");
            $("#codeErr").show();
            codeErr = true;
        } 
        else if(!code_regx.test($("#code").val())){
            $("#codeErr").html("Invalid Code. 'Example for a Gold Ring: GR001'");
            $("#codeErr").show();
            codeErr = true;
        } else {
            $("#codeErr").hide();
        }

    }

    function check_weight(){

        var weight_regx = new RegExp(/^-?\d*(\.(?=\d))?\d*$/);

        if($("#weight").val() == ""){
            $("#weightErr").html("Required.");
            $("#weightErr").show();
            weightErr = true;
        }
        else if(!weight_regx.test($("#weight").val())){
            $("#weightErr").html("Only numbers and decimals are allowed.");
            $("#weightErr").show();
            weightErr = true;
        } else {
            $("#weightErr").hide();
        }

    }

    function check_labour(){

        var labour_regx = new RegExp(/^-?\d*(\.(?=\d))?\d*$/);

        if($("#labour").val() == ""){
            $("#labourErr").html("Required.");
            $("#labourErr").show();
            labourErr = true;
        }
        else if(!labour_regx.test($("#labour").val())){
            $("#labourErr").html("Only numbers and decimals are allowed.");
            $("#labourErr").show();
            labourErr = true;
        } else {
            $("#labourErr").hide();
        }

    }

    function check_price(){

        var price_regx = new RegExp(/^-?\d*(\.(?=\d))?\d*$/);

        if($("#price").val() == ""){
            $("#priceErr").html("Required.");
            $("#priceErr").show();
            priceErr = true;
        }
        else if(!price_regx.test($("#price").val())){
            $("#priceErr").html("Only numbers and decimals are allowed.");
            $("#priceErr").show();
            priceErr = true;
        } else {
            $("#priceErr").hide();
        }

    }

    $("#additemform").submit(function(){

        codeErr = false;
        weightErr = false;
        labourErr = false;
        priceErr = false;

        check_code();
        check_weight();
        check_labour();
        check_price();
        

        if(codeErr == false && weightErr == false && labourErr == false && priceErr == false){
            return true;
        } else {
            return false;
        }

    });

});

