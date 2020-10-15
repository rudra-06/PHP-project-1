<?php
session_start();

if($_SESSION['user'] == ''){

    $_SESSION['user'] = '';
    header('location:index.php');
 
} else {
include 'connection.php';

date_default_timezone_set("Asia/Calcutta");
$today = date('Y-m-d');

$user = $_SESSION['user'];
 
//echo "<h4>Session started for : <h1>".$user."</h1></h4>";
// check if session exist.
// if(empty($_SESSION['user'])){
//     echo "not set";
// } else {
//     $user = $_SESSION['user'];
//     echo $user;
// }

// ========= Global variables ==========
    $count = 1;
    $digits = 5;
// ========= Global variables end ==========

// ========== get last id from work table to use in generating reciept no =========
    $select_ord_id = "SELECT id FROM orders";
    $select_ord_id_res = mysqli_query($conn, $select_ord_id);

    if(mysqli_num_rows($select_ord_id_res) == 0){
        
        $_SESSION['start_pt'] = '1';

    } else {

        $rows = mysqli_num_rows($select_ord_id_res);
        $_SESSION['start_pt'] = $rows + 1;

    }

// varible to be used by function generate_reciept_number 
    $start = $_SESSION['start_pt'];
// ========= get last id end =========

// ======= function to generate automatic reciept number =======
    function generate_order_number($start, $count, $digits){
        /*
        $start: is number first invice
        (global) $count: how many reciept numbers want to generate(1 at a time)
        (global) $digits: how many digits the generated numbers should be
        */
        $order_number = "ORD";
        for($n = $start; $n < $start + $count; $n++){

            $order_number .= str_pad($n, $digits, "0", STR_PAD_LEFT);

        }
        return $order_number;

    } 
// ======= function end =======


if (isset($_POST['submit'])){

    $order_num = $_POST['order_num'];
    $name = $_POST['name'];
    $due_date = $_POST['due_date'];
    $metal = $_POST['metal'];
    $category = $_POST['category'];
    $prd_weight = $_POST['prd_weight'];

    $insert = "INSERT INTO orders (order_no, client_name, metal, category, astmt_weight, assign_date, due_date)
                VALUES ('$order_num', '$name', '$metal', '$category', '$prd_weight', '$today', '$due_date')";
    $insert_res = mysqli_query($conn, $insert);

    if($insert_res){
        echo "<script type='text/javascript'>alert('Order jenerated successfully.');</script>";
    }

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

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


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

                <li class="nav-item ">
                    <a class="nav-link" href="home.php">Home</a>
                </li> 

                <li class="nav-item">
                    <a class="nav-link" href="invoice.php">New Sale</a>
                </li>

                <li class="nav-item ml-2 active">
                    <a class="nav-link" href="order.php">Order</a>
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

    <div class="container my-5">

        <form method="POST" class="mx-auto bg-white mt-5 mb-5 p-5 rounded w-75">
        
            <!-- header of order form -->
            <div class="d-flex justify-content-between mb-4">
                <div class="bd-highlight">
                    <img src="images/text_logo.png" class="img-fluid rounded" width="200" height="150">

                    <div class="bd-highlight mt-3">
                        <h6><strong>B.K.Jewellers PVT.LTD</strong></h6>
                        <address><em>
                            Shop no: 11-14,</br> 
                            Swastik tower, nr. Sharvada Diamonds,</br>
                            Soni bazar,
                            Surat.</br> 
                            PIN: 384265
                        </em></address>
                    </div>
                </div>

                <div class="bd-highlight">
                    <p class="h2 text-muted"><u>Order Reciept</u></p>
                    <div class="form-group mt-3">
                        <label for="order_num" class="sr-only">Invoice Number:</label>
                        <input type="text" readonly name="order_num" value="<?php echo $numbers = generate_order_number($start, $count, $digits); ?>" class="form-control" id="order_num">
                        <span class="text-danger" id="invoice_numErr"></span>
                    </div>
                    
                </div>                
                
            </div>

            <hr>

            <div class="form-group mt-4">

                <label for="name">Client Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter client name here" id="name" required>
                <span class="text-danger" id="nameErr"></span>

            </div>

            <div class="d-flex justify-content-between form-row">
            
                <div class="col-4">
                    <label for="assign_date">Assign Date:</label>
                    <input type="text" readonly name="date" value="<?php echo $today; ?>" class="form-control" id="assign_date">
                    <span class="text-danger" id="dateErr"></span>
                </div>

                <div class="col-4">
                    <label for="due_date">Due Date:</label>
                    <input type="date" name="due_date" class="form-control" id="due_date" title="Can't be equalto or less than 'Assign date'." required>
                    <span class="text-danger" id="dateErr"></span>
                </div>
            
            </div>

            <!-- item information -->
            <fieldset class="bg-light mt-4 p-4 border border-info">
                <legend class="text-sm-left text-info">Item Info</legend>
                <div class="form-row mb-4">
                
                    <div class="col-4">
                        <label for="metal">Product Metal:</label>
                        <select class="form-control" name="metal" id="metal" required>
                            <option value="none" selected disabled hidden>Select Metal</option>
                            <option value="gold">Gold</option>
                            <option value="silver">Silver</option>
                        </select>
                        <span class="text-danger" id="metalErr"></span>
                    </div>

                    <div class="col-4">
                        <label for="category">Product Catregory:</label>
                        <select class="form-control" name="category" id="prd_category" required>
                            <option value="none" selected disabled hidden>Select Category</option>
                            <?php 
                                $category = "SELECT  id,category_name  FROM category";
                                $category_res = mysqli_query($conn, $category);

                                if(mysqli_num_rows($category_res) > 0){

                                    while($fetch = mysqli_fetch_assoc($category_res)){
                                    ?>
                                        <option value="<?php echo $fetch['id']; ?>"> <?php echo $fetch['category_name']; ?> </option>
                                        
                                    <?php } 
                                } 
                                ?>
                        </select>
                        <span class="text-danger" id="categoryErr"></span>
                    </div>

                    <div class="col-4">
                        <label for="prd_weight">Product Weight <em>(gm)</em>:</label>
                        <input type="text" name="prd_weight" class="form-control" id="prd_weight" required>
                        <span class="text-danger" id="prd_weightErr"></span>
                    </div>
                
                </div>

            </fieldset>

            <!-- buttons -->
            <div class="d-flex flex-row bd-highlight mt-4">
                
                <div class="bd-highlight mx-2">
                    <input type="submit" name="submit" class="btn btn-primary" value="SUBMIT">        
                </div>
                <div class="bd-highlight mr-5">
                    <input class="btn btn-danger" type="reset" value="RESET">
                </div>
                  
                <div class="bd-highlight ml-auto">
                    <input class="btn btn-info" type="button" value="PRINT" onClick=window.print()>
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
    <script type="text/javascript">
        $(document).ready(function(){
            
            $("#due_date").change(function(){

                var d = new Date();

                var month = d.getMonth()+1;
                var day = d.getDate();

                var today = d.getFullYear() + "/" + 
                    ((""+month).length<2 ? "0" : "") + month + "/" +
                    ((""+day).length<2 ? "0" : "") + day;
    
                var due_date = $("#due_date").val());
                if (due_date == today){

                    alert("Please enter correct Due-date.");

                }

            });

        });
    </script>

</body>
</html>

<?php } ?>