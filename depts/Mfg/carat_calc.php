<?php
session_start();

if($_SESSION['user'] == ''){

    $_SESSION['user'] = '';
    header('location:index.php');
 
} else {
include 'connection.php';

$user = $_SESSION['user'];
 
//echo "<h4>Session started for : <h1>".$user."</h1></h4>";
// check if session exist.
// if(empty($_SESSION['user'])){
//     echo "not set";
// } else {
//     $user = $_SESSION['user'];
//     echo $user;
// }

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>B.K.Jewellers</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="css/card.css">

</head>
<body style="background-color:#efe8eb;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">
            <img src="images/text_logo.png" class="rounded" width="150" height="auto" alt="text_logo" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>

                <li class="nav-item dropdown ml-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Work
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="work.php">Work Reciept</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="manage_work.php">Manage Reciepts</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="orders.php">Orders</a>
                    </div>
                </li>

                <li class="nav-item dropdown ml-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Stock
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="add__stock.php">Add Stock</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="stock_detail.php">Stock Detail</a>
                    </div>
                </li>   
                
                <li class="nav-item ml-2 active">
                    <a class="nav-link" href="carat_calc.php">Weight Calculation</a>
                </li>

                <li class="nav-item ml-2">
                    <a class="nav-link" href="transfer_home.php">Transfer</a>
                </li>

                <li class="nav-item ml-2">
                    <a class="nav-link" href="help.php">Help</a>
                </li>

                <li class="nav-item ml-2">
                    <a class="nav-link" href="mail.php">Contact Admin</a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button type="button" class="btn btn-info mr-3" data-toggle="tooltip" data-placement="bottom" title="<?php echo $user; ?>">USER</button>
                <a href="logout.php" class="btn btn-danger">LOGOUT</a>                
            </form>
        </div>
    </nav>

    <div class="container">
    
        <form method="POST" class="mx-auto bg-white mt-5 mb-5 p-4 rounded w-75">
        
            <fieldset class="bg-light p-3 m-3 border border-info">
            
                <legend class="text-info">Information</legend>
                <div class="form-row align-items-center">
                    
                    <div class="col-sm-4 col-md-4">
                        <label for="prd_metal">Product Metal:</label>
                            <select class="form-control" name="prd_metal" id="prd_metal" required>
                                <option value="none" selected disabled hidden>Select Metal</option>
                                <option value="gold">Gold</option>
                                <option value="silver">Silver</option>
                            </select>
                        <span class="text-danger" id="prd_metalErr"></span>
                    </div>

                    <div class="col-sm-4 col-md-4">
                        <label for="prd_weight">Weight <em>(gm)</em>:</label>
                        <input type="text" name="prd_weight" class="form-control" id="prd_weight" required>
                        <span class="text-danger" id="prd_weightErr"></span>
                    </div>

                    <div class="col-sm-4 col-md-4">
                        <label for="prd_quality">Product Quality:</label>
                        <select class="form-control" name="prd_quality" id="prd_quality" required>
                                <!-- dynamically generated by jQuery see at bottom -->
                        </select>
                        <span class="text-danger" id="prd_qualityErr"></span>
                    </div>

                </div>

                <div class="d-flex flex-row bd-highlight">
                    <div class="mt-3 bd-highlight ml-auto">
                        <input type="reset" class="btn btn-danger" value="CLEAR">
                    </div>
                </div>

            </fieldset>

        </form>

        <form class="mx-auto bg-white mt-5 mb-5 p-4 rounded w-75">

            <fieldset class="bg-light p-3 m-3 border border-info">

                <legend class="text-info">Result</legend>
                <div class="form-row align-items-center">
                
                    <div class="col-sm-6 col-md-6">
                        <label for="pure_weight">Pure Metal Weight <em>(gm)</em>:</label>
                        <input type="text" readonly name="pure_weight" class="form-control" id="pure_weight">
                        <span class="text-danger" id="pure_weightErr"></span>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <label for="kdm_weight">KDM Weight <em>(gm)</em>:</label>
                        <input type="text" readonly name="kdm_weight" class="form-control" id="kdm_weight">
                        <span class="text-danger" id="kdm_weightErr"></span>
                    </div>
                
                </div>        

            </fieldset>
        
        </form>

    </div>

<!-- ====================================================================== -->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!-- ====================================================================== -->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- ====================================================================== -->

    <script type="text/javascript">
    
        // qualities of product based on metal
        $("#prd_metal").change(function(){

            if($("#prd_metal").val() == 'silver'){

                $("#prd_quality").html('<select class="form-control" name="prd_quality" id="prd_quality" required><option value="none" selected disabled hidden>Select Quality</option><option value="92.5">92.5</option><option value="85">85</option><option value="80">80</option></select>');

            }
            if($("#prd_metal").val() == 'gold'){

                $("#prd_quality").html('<select class="form-control" name="prd_quality" id="prd_quality" required><option value="none" selected disabled hidden>Select Quality</option><option value="22k">22k</option><option value="20k">20k</option><option value="18k">18k</option></select>')

            }

        });

        // given material weight calculation.
        $("#prd_quality").change(function(){

            var prd_weight = $("#prd_weight").val();

            if($("#prd_quality").val() == '22k'){

                var for_22k = 0.916;

                var required_metal = prd_weight * for_22k;

                var required_kdm = prd_weight - required_metal;

                $("#pure_weight").attr('value', required_metal.toFixed(3)); 
                $("#kdm_weight").attr('value', required_kdm.toFixed(3)); 

            }
            if($("#prd_quality").val() == '20k'){

                var for_20k = 0.830;

                var required_metal = prd_weight * for_20k;
                
                var required_kdm = prd_weight - required_metal;

                $("#pure_weight").attr('value', required_metal.toFixed(3)); 
                $("#kdm_weight").attr('value', required_kdm.toFixed(3));

            }
            if($("#prd_quality").val() == '18k'){

                var for_18k = 0.750;

                var required_metal = prd_weight * for_18k;

                var required_kdm = prd_weight - required_metal;

                $("#pure_weight").attr('value', required_metal.toFixed(3)); 
                $("#kdm_weight").attr('value', required_kdm.toFixed(2));

            }
            if($("#prd_quality").val() == '92.5'){

                var for_925 = 0.925;

                var required_metal = prd_weight * for_925;
                
                var required_kdm = prd_weight - required_metal;

                $("#pure_weight").attr('value', required_metal.toFixed(3)); 
                $("#kdm_weight").attr('value', required_kdm.toFixed(2));

            }
            if($("#prd_quality").val() == '85'){

                var for_85 = 0.850;

                var required_metal = prd_weight * for_85;
                
                var required_kdm = prd_weight - required_metal;

                $("#pure_weight").attr('value', required_metal.toFixed(3)); 
                $("#kdm_weight").attr('value', required_kdm.toFixed(2));

            }
            if($("#prd_quality").val() == '80'){

                var for_80 = 0.800;

                var required_metal = prd_weight * for_80;

                var required_kdm = prd_weight - required_metal;

                $("#pure_weight").attr('value', required_metal.toFixed(3)); 
                $("#kdm_weight").attr('value', required_kdm.toFixed(2));
                

            }

        }); 

    </script>

</body>
</html>

<?php } ?>