<?php
session_start();
error_reporting(0);

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

    $mch_id = $_GET['mchid'];

    $search = "SELECT * FROM mfg_stock WHERE id='$mch_id'";
    $search_res = mysqli_query($conn, $search);

    $row = mysqli_fetch_assoc($search_res);

    // updating stock
    if(isset($_POST['update'])){

        $quantity = $_POST['item_quantity'];

        $update = "UPDATE mfg_stock SET quantity='$quantity' WHERE id='$mch_id'";
        $update_res = mysqli_query($conn, $update);

        if($update_res){
            header('location:edit_item.php?status=1');
        } else {
            echo "<script type='text/javascript'>alert('Something went wrong, Please try again.');</script>";
        }

    }

     // success msg for updation.
     $status = $_GET['status'];

     $record_updated = false;

     $status = $_GET['status'];
     if($status == 1){
         $record_updated = true;
     }
     
     if($record_updated){
         echo "<script type='text/javascript'>alert('Item was updated successfully.')</script>";
     }

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

                <li class="nav-item dropdown ml-2 active">
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

    <div class="container mb-5">

    <h2 class="my-4"><strong>Edit "<?php echo $row['name']; ?>":</strong></h2>

        <form method="POST" id="addstockform" class="mx-auto bg-white mt-5 p-5 rounded w-75">

            <div class="form-group">
                <label for="item_category">Item Category:</label>
                <select class="form-control" readonly name="item_category" id="item_category">
                    <!-- <option vlaue="none" selected hidden>Select Category</option> -->
                    <option value=<?php echo $row['category']; ?> ><?php echo $row['category']; ?></option>
                </select>
                <span class="text-danger" id="item_categoryErr"></span>
            </div>

            <div class="form-group">
                <label for="item_name">Item name:</label>
                <select class="form-control" readonly name="item_name" id="item_name">
                    <option value=<?php echo $row['name']; ?> ><?php echo $row['name']; ?></option>
                </select>
                <span class="text-danger" id="item_nameErr"></span>
            </div>

            <div class="form-group">
                <label for="item_quantity">Item Quantity <em>(gm)</em>:</label>
                <input type="text" name="item_quantity" class="form-control" id="item_quantity" value=<?php echo $row['quantity']; ?>>
                <span class="text-danger" id="item_quantityErr"></span>
            </div>
            
            <div class="d-flex flex-row bd-highlight mt-4">
                <div class="bd-highlight mx-2">
                    <input type="submit" name="update" class="btn btn-primary" value="UPDATE">
                </div>
                <div class="bd-highlight mr-5">
                    <input type="reset" class="btn btn-danger" value="CANCEL"> 
                </div>
                <div class="bd-highlight ml-auto">
                    <a href="stock_detail.php" class="btn btn-info" type="button">BACK</a>
                </div>
            </div>
        </form>
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