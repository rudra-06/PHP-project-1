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

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


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

                <li class="nav-item dropdown ml-2 ">
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
                
                <li class="nav-item ml-2">
                    <a class="nav-link" href="carat_calc.php">Weight Calculation</a>
                </li>

                <li class="nav-item ml-2">
                    <a class="nav-link" href="transfer_home.php">Transfer</a>
                </li>

                <li class="nav-item ml-2 active">
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

    <div class="container my-4">
    
        <!-- <iframe src="files/help.pdf" width="100%" height="470px"></iframe> -->
        <h1 class=" text-center mt-5 text-info" style="font-size:8rem;"><u>~ 'HELP' Page ~</u></h1>
        <p class="animate__animated animate__fadeIn animate__delay-2s mt-5 pt-5 text-center h4">A pdf file which contains Guidelines and step-by-step instruction to use this system will be shown here.</p>

    </div>

    

<!-- ====================================================================== -->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!-- ====================================================================== -->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- ====================================================================== -->
</body>
</html>

<?php } ?>