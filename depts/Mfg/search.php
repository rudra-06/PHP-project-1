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

    // reciept number from manage_work.php
    $ID = $_GET['recid'];

    $search = "SELECT mfg_work_reciept.id AS rec_id, mfg_work_reciept.reciept_no, mfg_work_reciept.worker, mfg_work_reciept.customer_order, 
                mfg_work_reciept.prd_category, mfg_work_reciept.prd_metal, mfg_work_reciept.prd_quality, 
                mfg_work_reciept.prd_weight, mfg_work_reciept.gvn_material_type, mfg_work_reciept.gvn_material_quality, 
                mfg_work_reciept.gvn_material_weight, mfg_work_reciept.start_date, mfg_work_reciept.deadline_date,
                mfg_work_reciept.status, mfg_workers.id AS worker_id, mfg_workers.worker_name, category.id AS cat_id, category.category_name 
                FROM mfg_work_reciept JOIN mfg_workers ON mfg_work_reciept.worker = mfg_workers.id 
                JOIN category ON mfg_work_reciept.prd_category = category.id WHERE mfg_work_reciept.id = '$ID'";
    $search_res = mysqli_query($conn, $search);

    $res_row = mysqli_fetch_assoc($search_res);

    

    
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

                <li class="nav-item dropdown ml-2 active">
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
                    <a class="nav-link" href="help.php">Weight Calculation</a>
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
                <input type="text" readonly name="reciept_num" class="form-control" id="reciept_num" value=<?php echo $res_row['reciept_no']; ?> >
                <span class="text-danger" id="reciept_numErr"></span>
            </div>

            <!-- worker name and status -->
            <div class="form-row align-items-center">

                <div class="form-group col-sm-9">
                    <label for="worker_name">Assigned To:</label>
                    <select class="form-control" readonly name="worker_name" id="worker_name">
                        <option value=<?php echo $res_row['worker_id']; ?>><?php echo $res_row['worker_name']; ?></option>
                    </select>
                    <span class="text-danger" id="worker_nameErr"></span>
                </div>

                <div class="form-group col-sm-3">
                    <label for="status">Status</label>
                    <select name="status" readonly id="status" class="form-control">
                        <!-- <option value="none" selected disabled hidden>Select status</option> -->
                        <option value="in work"><?php if($res_row['status'] == 'in work'){echo "In Work";} ?></option>
                        <option value="pending"><?php if($res_row['status'] == 'pending'){echo "Pending";} ?></option>
                        <option value="completed"><?php if($res_row['status'] == 'completed'){echo "Completed";} ?></option>
                    </select>
                </div>

            </div>

            <!-- Dates information -->
            <div class="form-row align-items-center my-3">

                <div class="form-group col-sm-6">
                    <label for="assign_date">Assign Date:</label>
                    <input type="date" readonly name="assign_date" value=<?php echo $res_row['start_date']; ?> class="form-control" id="assign_date" > 
                </div>

                <div class="form-group col-sm-6">
                    <label for="deadline_date">Deadline date:</label>
                    <input type="date" readonly name="deadline_date" value=<?php echo $res_row['deadline_date']; ?> class="form-control" id="deadline_date" > 
                </div>

            </div>

            <!-- for customer order -->
            <fieldset class="bg-light p-3 m-3 border border-info">
            
                <legend class="text-info">Customer Order?</legend>
                <div class="form-row">

                    <div class="col-sm-6 align-items-center">
                        <div class="form-check form-check-inline mx-4 mr-4">
                            <input class="form-check-input m-0" readonly type="radio" <?php if($res_row['customer_order'] == 'yes'){echo "checked";} ?> name="customer_order" id="customer_order_yes" value="yes">   
                            <label class="form-check-label p-0 pt-4" for="customer_order">Yes</label>
                        </div>

                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input m-0" readonly type="radio" <?php if($res_row['customer_order'] == 'no'){echo "checked";} ?> name="customer_order" id="customer_order_no" value="no">   
                            <label class="form-check-label p-0 pt-4" for="customer_order">No</label>
                        </div>
                    </div>

                    <div class="col-sm-6" id="order_num">
                        <div class="form-group">
                            <label for="order_num">Order Number:</label>
                            <input type="text" name="order_num" readonly class="form-control" id="order_num">
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
                        <select class="form-control" readonly name="prd_category" id="prd_category" >
                            <!-- <option value="none" selected disabled hidden>Select Category</option> -->
                            <option value=<?php echo $res_row['cat_id']; ?>><?php echo $res_row['category_name']; ?></option>
                            
                        </select>
                        <span class="text-danger" id="prd_categoryErr"></span>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <label for="prd_metal">Product Metal:</label>
                            <select class="form-control" readonly name="prd_metal" id="prd_metal" >
                                <!-- <option value="none" selected disabled hidden>Select Metal</option> -->
                                <option value=<?php echo $res_row['prd_metal'];?>>
                                    <?php 
                                        if($res_row['prd_metal'] == 'gold'){
                                            echo "Gold";
                                        } else {
                                            echo "Silver";
                                        } 
                                    ?>
                                </option>
                            </select>
                        <span class="text-danger" id="prd_metalErr"></span>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <label for="prd_quality">Product Quality:</label>
                        <select class="form-control" readonly name="prd_quality" id="prd_quality" >
                            <!-- dynamically generated by jQuery see at bottom -->
                            <option value=<?php echo $res_row['prd_quality']; ?>><?php echo $res_row['prd_quality']; ?></option>
                        </select>
                        <span class="text-danger" id="prd_qualityErr"></span>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <label for="prd_weight">Product Weight <em>(gm)</em>:</label>
                        <input type="text" readonly value=<?php echo $res_row['prd_weight']; ?> name="prd_weight" class="form-control" id="prd_weight" >
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
                        <select name="material_given" readonly class="form-control" id="material_given">
                            <!-- <option value="none" selected disabled hidden>Select Material</option> -->
                            <option value=<?php echo $res_row['gvn_material_type']; ?>>
                                <?php 
                                    if($res_row['gvn_material_type'] == 'gold'){
                                        echo "Gold";
                                    } else {
                                        echo "Silver";
                                    } 
                                ?>
                            </option>
                        </select>
                        <span class="text-danger" id="material_givenErr"></span>
                    </div>

                    <div class="col-sm-4">
                        <label for="material_quality">Material Quality:</label>
                        <select class="form-control" readonly name="material_quality" id="material_quality" >
                            <!-- <option value="none" selected disabled hidden>Select Quality</option> -->
                            <option value=>
                                <?php 
                                    if($res_row['gvn_material_quality'] == '24k'){
                                        echo "24k";
                                    } else if($res_row['gvn_material_quality'] == '999') {
                                        echo "999";
                                    } else {
                                        echo "92.5";
                                    }
                                ?>
                            </option>
                        </select>
                        <span class="text-danger" id="material_qualityErr"></span>
                    </div>

                    <div class="col-sm-4">
                        <label for="material_weight">Material Weight <em>(gm)</em>:</label>
                        <input type="text" readonly value=<?php echo $res_row['gvn_material_weight']; ?> name="material_weight" class="form-control" id="material_weight" >
                        <span class="text-danger" id="material_weightErr"></span>
                    </div>

                </div>

            </fieldset>
            
            <!-- buttons -->
            <div class="d-flex flex-row bd-highlight mt-4">
                  
                <div class="bd-highlight ml-auto">
                    <a href="manage_work.php" class="btn btn-info"><span class="lnr lnr-arrow-left-circle pr-2"></span>BACK</a>
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

            // same date validation
            $("#deadline_date").blur(function(){
                if($("#assign_date").val() == $("#deadline_date").val()){

                    alert("Deadline date can't be same as Assign date.");

                }
            });

            // qualities of product based on metal
            $("#prd_metal").change(function(){

                if($("#prd_metal").val() == 'silver'){

                    $("#prd_quality").html('<select class="form-control" name="prd_quality" id="prd_quality" ><option value="92.5">92.5</option><option value="85">85</option><option value="80">80</option></select>');

                }
                if($("#prd_metal").val() == 'gold'){

                    $("#prd_quality").html('<select class="form-control" name="prd_quality" id="prd_quality" ><option value="22k">22k</option><option value="20k">20k</option><option value="18k">18k</option></select>')

                }

            });         
            
        });
    </script>

</body>
</html>

<?php } ?>