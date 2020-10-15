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

    // total items in jewellers.
    $select_total = "SELECT id FROM products";
    $select_total_res = mysqli_query($conn, $select_total);

    $total_items_row_count = mysqli_num_rows($select_total_res);

    // total items in head branch.
    $select_head_branch_item = "SELECT id FROM products WHERE branch_id = 1";
    $head_branch_item_res = mysqli_query($conn, $select_head_branch_item);

    $head_branch_items = mysqli_num_rows($head_branch_item_res);

    // total items in bhagal branch.
    $select_bhagal_branch_item = "SELECT id FROM products WHERE branch_id = 3";
    $bhagal_branch_item_res = mysqli_query($conn, $select_bhagal_branch_item);

    $bhagal_branch_items = mysqli_num_rows($bhagal_branch_item_res);

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
        <a class="navbar-brand" href="#">
            <img src="images/text_logo.png" class="rounded" width="150" height="auto" alt="text_logo" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home</a>
                </li>

                <li class="nav-item dropdown ml-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Item
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="add_item.php">Add Item</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="item_detail.php">Item Detail</a>
                    </div>
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

    <div class="container mt-5">
    
        <div class="row mx-auto mt-5">

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card text-center p-3" id="card1" style="width: 18rem;">
                    <div class="card-title border-bottom-dark">
                        <h1><?php echo $total_items_row_count; ?></h1>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Total Products</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card text-center p-3" id="card1" style="width: 18rem;">
                    <div class="card-title border-bottom-dark">
                        <h1><?php echo $head_branch_items; ?></h1>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Head Branch</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card text-center p-3" id="card1" style="width: 18rem;">
                    <div class="card-title border-bottom-dark">
                        <h1><?php echo $bhagal_branch_items; ?></h1>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Bhagal Branch</h3>
                    </div>
                </div>
            </div>


        </div>

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