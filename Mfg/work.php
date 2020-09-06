<?php
session_start();
// error_reporting(0);

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

// ========= Global variables ==========
    $count = 1;
    $digits = 10;
// ========= Global variables end ==========

// ========== get last id from work table to use in generating reciept no =========
    $select_rec_id = "SELECT id FROM mfg_work_reciept";
    $select_rec_id_res = mysqli_query($conn, $select_rec_id);

    if(mysqli_num_rows($select_rec_id_res) == 0){
        
        $_SESSION['start_pt'] = '1';

    } else {

        $_SESSION['start_pt'] = mysqli_insert_id($conn) + 1;

    }

    // varible to be used by function generate_reciept_number 
    $start = $_SESSION['start_pt'];
// ========= get last id end =========

    // ======= function to generate automatic reciept number =======
    function generate_reciept_number($start, $count, $digits){
        /*
        $start: is number first invice
        (global) $count: how many reciept numbers want to generate(1 at a time)
        (global) $digits: how many digits the generated numbers should be
        */
        $reciept_number = array();
        for($n = $start; $n < $start + $count; $n++){

            $reciept_number = str_pad($n, $digits, "0", STR_PAD_LEFT);

        }
        return $reciept_number;

    } 
    // ======= function end =======

// ======= inserting reciept =======

    if(isset($_POST['insert'])){

        $reciept_num = $_POST['reciept_num'];
        $worker_name = $_POST['worker_name'];
        $status = $_POST['status'];
        $assign_date = $_POST['assign_date'];
        $deadline_date = $_POST['deadline_date'];
        $customer_order = $_POST['customer_order'];
        $prd_category = $_POST['prd_category'];
        $prd_metal = $_POST['prd_metal'];
        $prd_quality = $_POST['prd_quality'];
        $prd_weight = $_POST['prd_weight'];
        $material_given = $_POST['material_given'];
        $material_quality = $_POST['material_quality'];
        $material_weight = $_POST['material_weight'];

        $insert = "INSERT INTO mfg_work_reciept (reciept_no, worker, customer_order, prd_category, 
                    prd_metal, prd_quality, prd_weight, gvn_material_type, gvn_material_quality, 
                    gvn_material_weight, start_date, deadline_date, status) VALUES ('$reciept_num', 
                    '$worker_name', '$customer_order', '$prd_category', '$prd_metal', '$prd_quality', 
                    '$prd_weight', '$material_given', '$material_quality', '$material_weight', 
                    '$assign_date', '$deadline_date', '$status')";
        $insert_res = mysqli_query($conn, $insert);
        
        if($insert_res){
            echo "success";
        } else {
            echo "fail".mysqli_error($conn);
        }

    } 

// ======= inserting reciept end =======
    
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

    <link rel="stylesheet" type="text/css" href="css/pointer.css">

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

                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Work Reciept</a>
                </li>

                <li class="nav-item dropdown ml-2">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Stock
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="add_item.php">Add Stock</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="item_detail.php">Stock Detail</a>
                    </div>
                </li>   
                
                <li class="nav-item ml-2">
                    <a class="nav-link" href="help.php">Carat Calculation</a>
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
    
        <form method="POST" id="new_reciept" class="mx-auto bg-white mt-5 mb-5 p-5 rounded w-75">

            <!-- reciept number -->
            <div class="form-group">
                <label for="reciept_num">Reciept Number:</label>
                <input type="text" readonly name="reciept_num" class="form-control" id="reciept_num" value=<?php echo $numbers = generate_reciept_number($start, $count, $digits); ?> >
                <span class="text-danger" id="reciept_numErr"></span>
            </div>

            <!-- worker name and status -->
            <div class="form-row align-items-center">

                <div class="form-group col-sm-9">
                    <label for="worker_name">Assigned To:</label>
                    <select class="form-control" name="worker_name" id="worker_name" required>

                    <?php
                        $select_workers = "SELECT * FROM mfg_workers";
                        $select_workers_res = mysqli_query($conn, $select_workers);

                        if(mysqli_num_rows($select_workers_res) > 0){

                            while($fetch_worker = mysqli_fetch_assoc($select_workers_res)){
                            ?>
                                <option value=<?php echo $fetch_worker['id'] ?>> <?php echo $fetch_worker['worker_name'] ?> </option>
                            <?php
                            }
                        }
                    ?>

                    </select>
                    <span class="text-danger" id="worker_nameErr"></span>
                </div>

                <div class="form-group col-sm-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="in work">In Work</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>

            </div>

            <!-- Dates information -->
            <div class="form-row align-items-center my-3">

                <div class="form-group col-sm-6">
                    <label for="assign_date">Assign Date:</label>
                    <input type="date" name="assign_date" class="form-control" id="assign_date" required> 
                </div>

                <div class="form-group col-sm-6">
                    <label for="deadline_date">Deadline date:</label>
                    <input type="date" name="deadline_date" class="form-control" id="deadline_date" required> 
                </div>

            </div>

            <!-- for customer order -->
            <fieldset class="bg-light p-3 m-3 border border-info">
            
                <legend class="text-info">Customer Order?</legend>
                <div class="form-row">

                    <div class="col-sm-6 align-items-center">
                        <div class="form-check form-check-inline mx-4 mr-4">
                            <input class="form-check-input m-0" type="radio" name="customer_order" id="customer_order_yes" value="yes">   
                            <label class="form-check-label p-0 pt-4" for="customer_order">Yes</label>
                        </div>

                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input m-0" type="radio" name="customer_order" id="customer_order_no" value="no">   
                            <label class="form-check-label p-0 pt-4" for="customer_order">No</label>
                        </div>
                    </div>

                    <div class="col-sm-6" id="order_num">
                        <div class="form-group">
                            <label for="order_num">Order Number:</label>
                            <input type="text" name="order_num" class="form-control" id="order_num">
                            <span class="text-danger" id="order_numErr"></span>
                        </div> 
                    </div>

                </div>

            </fieldset>

            <!-- outcome product information -->
            <fieldset class="bg-light p-3 m-3 border border-info">

                <legend class="text-info">Product Info.</legend>
                <div class="form-row align-items-center">

                    <div class="col-sm-3 col-md-3">
                        <label for="prd_category">Product Catregory:</label>
                        <select class="form-control" name="prd_category" id="prd_category" required>
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
                        <span class="text-danger" id="prd_categoryErr"></span>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <label for="prd_metal">Product Metal:</label>
                            <select class="form-control" name="prd_metal" id="prd_metal" required>
                                <option value="gold">Gold</option>
                                <option value="silver">Silver</option>
                            </select>
                        <span class="text-danger" id="prd_metalErr"></span>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <label for="prd_quality">Product Quality:</label>
                        <select class="form-control" name="prd_quality" id="prd_quality" required>
                                <option value="22k">22k</option>
                                <option value="20k">20k</option>
                                <option value="18k">18k</option>
                                <option value="92.5">92.5</option>
                                <option value="85">85</option>
                                <option value="80">80</option>
                                <option value="75">75</option>
                        </select>
                        <span class="text-danger" id="prd_qualityErr"></span>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <label for="prd_weight">Product Weight <em>(gm)</em>:</label>
                        <input type="text" name="prd_weight" class="form-control" id="prd_weight" required>
                        <span class="text-danger" id="prd_weightErr"></span>
                    </div>

                </div>

            </fieldset>

            <!-- material information -->
            <fieldset class="bg-light p-3 m-3 border border-info">
            
                <legend class="text-info">Given Material Info.</legend>
                <div class="form-row align-items-center">
                
                    <div class="col-sm-4">
                        <label for="material_given">Material Type:</label>
                        <select name="material_given" class="form-control" id="material_given">
                            <option value="gold">Gold</option>
                            <option value="silver">Silver</option>
                        </select>
                        <span class="text-danger" id="material_givenErr"></span>
                    </div>

                    <div class="col-sm-4">
                        <label for="material_quality">Material Quality:</label>
                        <select class="form-control" name="material_quality" id="material_quality" required>
                                <option value="24k">24k</option>
                                <option value="999">999</option>
                                <option value="92.5">92.5</option>
                        </select>
                        <span class="text-danger" id="material_qualityErr"></span>
                    </div>

                    <div class="col-sm-4">
                        <label for="material_weight">Material Weight <em>(gm)</em>:</label>
                        <input type="text" name="material_weight" class="form-control" id="material_weight" required>
                        <span class="text-danger" id="material_weightErr"></span>
                    </div>

                </div>

            </fieldset>
            
            <!-- buttons -->
            <div class="d-flex flex-row bd-highlight mt-4">
                
                <div class="bd-highlight mx-2">
                    <input type="submit" name="insert" class="btn btn-primary" value="SUBMIT">        
                </div>
                <div class="bd-highlight mr-5">
                    <input class="btn btn-danger" type="reset" value="RESET">
                </div>
                  
                <div class="bd-highlight ml-auto">
                    <input class="btn btn-info" type="button" value="PRINT">
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

    <script>
        $(document).ready(function(){

            // if its customer order then show field for order number
            $("#order_num").hide();

            $("#customer_order_yes").click(function(){
                $("#order_num").show();
            });
            $("#customer_order_no").click(function(){
                $("#order_num").hide();
            });

            $("#deadline_date").blur(function(){
                if($("#assign_date").val() == $("#deadline_date").val()){

                    alert("Deadline date can't be same as Assign date.");

                }
            });
            

        });
    </script>

</body>
</html>

<?php } ?>