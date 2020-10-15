<?php
session_start();
// error_reporting(0);

if($_SESSION['user'] == ''){

    $_SESSION['user'] = '';
    header('location:index.php');
 
} else {
include 'connection.php';

$user = $_SESSION['user'];


    // search reciepts functionality.
    if(isset($_POST['search_reciepts'])){

        $rec_number = $_POST['rec_number'];
        
        $search = "SELECT mfg_work_reciept.id AS rec_id, mfg_work_reciept.reciept_no, mfg_work_reciept.worker, mfg_work_reciept.customer_order, 
                mfg_work_reciept.prd_category, mfg_work_reciept.prd_metal, mfg_work_reciept.prd_quality, 
                mfg_work_reciept.prd_weight, mfg_work_reciept.gvn_material_type, mfg_work_reciept.gvn_material_quality, 
                mfg_work_reciept.gvn_material_weight, mfg_work_reciept.start_date, mfg_work_reciept.deadline_date,
                mfg_work_reciept.status, mfg_workers.id, mfg_workers.worker_name, category.id, category.category_name 
                FROM mfg_work_reciept JOIN mfg_workers ON mfg_work_reciept.worker = mfg_workers.id 
                JOIN category ON mfg_work_reciept.prd_category = category.id WHERE mfg_work_reciept.reciept_no = '$rec_number'";
        $search_res = mysqli_query($conn, $search);

        if(mysqli_num_rows($search_res) <= 0){
        
            echo "<script type='text/javascript'>alert('No Reciept found,  please enter a valid Reciept Number');</script>";

        } else {

            $search_row = mysqli_fetch_assoc($search_res);
            $recpt_id = $search_row['rec_id'];

            header("location:search.php?recid=$recpt_id");

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

    <link rel="stylesheet" type="text/css" href="css/pointer.css">
  
    <script src="https://use.fontawesome.com/346f9a83b1.js"></script>

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

        <div class="row my-5">

            <div class="col-sm-3 col-md-3">
                <form method="POST" id="inwork_form">
                <button class="btn btn-lg btn-block btn-outline-primary" name="inwork" id="inwork">In Work</button>
                </form>
            </div>
            <div class="col-sm-3 col-md-3">
                <form method="POST" id="pending_form">
                <button class="btn btn-lg btn-block btn-outline-warning" name="pending" id="pending">Pending</button>
                </form>
            </div>
            <div class="col-sm-3 col-md-3">
                <form method="POST" id="completed_form">
                <button class="btn btn-lg btn-block btn-outline-secondary" name="completed" id="completed">Completed</button>
                </form>
            </div>

            <div class="col-sm-3 col-md-3">
            
                <form method="POST" class="">
                    <div class="input-group">
                        <input type="text" name="rec_number" class="form-control" placeholder="Reciept number" aria-label="Search Reciets">
                        <input type="submit" name="search_reciepts" class="btn btn-sm btn-outline-success" value="SEARCH">
                    </div>
                </form>

            </div>
        </div>

        <div class="bg-white table-responsive">
        
            <table class="table table-hover text-center">
                <thead class="bg-dark text-white ">
                    <tr class="table-secondary text-dark table-sm">
                        <td scope="col" colspan="5" class="border border-dark">Other</td>
                        <td scope="col" colspan="3" class="border border-dark">Product</td>
                        <td scope="col" colspan="2" class="border border-dark">Dates</td>
                    </tr>
                    <tr class="text-center">
                        <th scope="col">Sr No</th>
                        <th scope="col">Reciept No.</th>
                        <th scope="col">Worker</th>
                        <th scope="col">Customer Order</th>
                        <th scope="col">Status</th>
                        <th scope="col">Metal</th>
                        <th scope="col">Category</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Assign</th>
                        <th scope="col">Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // for getting reciepts who have status = "in work"
                        if(isset($_POST['inwork'])){
                            
                            $inwork_reciepts = "SELECT mfg_work_reciept.reciept_no, mfg_workers.id, mfg_work_reciept.worker,
                                                mfg_workers.worker_name, mfg_work_reciept.customer_order, mfg_work_reciept.prd_metal, 
                                                mfg_work_reciept.prd_category, mfg_work_reciept.prd_weight, mfg_work_reciept.start_date,
                                                mfg_work_reciept.deadline_date, mfg_work_reciept.status, category.id, category.category_name FROM mfg_work_reciept 
                                                JOIN mfg_workers ON mfg_work_reciept.worker = mfg_workers.id JOIN category ON mfg_work_reciept.prd_category = category.id
                                                WHERE status='in work' ORDER BY reciept_no ";
                            $inwork_reciepts_res = mysqli_query($conn, $inwork_reciepts);

                            if(mysqli_num_rows($inwork_reciepts_res) > 0){

                                $cnt = 1;

                                while($row = mysqli_fetch_assoc($inwork_reciepts_res)){

                                    ?>
                                        <tr>
                                            <td><?php echo $cnt ?></td>
                                            <td><?php echo $row['reciept_no']; ?></td>
                                            <td><?php echo $row['worker_name']; ?></td>
                                            <td><?php echo $row['customer_order']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><?php echo $row['prd_metal']; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <td><?php echo $row['prd_weight']; ?> <em>gm</em></td>
                                            <td><?php echo $row['start_date']; ?></td>
                                            <td><?php echo $row['deadline_date']; ?></td>
                                        </tr>
                                    <?php $cnt++;

                                }// while end

                            }// if num_rows end

                        }// if isset end

                        // for getting reciepts who have status = "pending"
                        if(isset($_POST['pending'])){
                            
                            $pending_reciepts = "SELECT mfg_work_reciept.reciept_no, mfg_workers.id, mfg_work_reciept.worker,
                                                mfg_workers.worker_name, mfg_work_reciept.customer_order, mfg_work_reciept.prd_metal, 
                                                mfg_work_reciept.prd_category, mfg_work_reciept.prd_weight, mfg_work_reciept.start_date,
                                                mfg_work_reciept.deadline_date, mfg_work_reciept.status, category.id, category.category_name FROM mfg_work_reciept 
                                                JOIN mfg_workers ON mfg_work_reciept.worker = mfg_workers.id JOIN category ON mfg_work_reciept.prd_category = category.id
                                                WHERE status='pending' ORDER BY reciept_no";
                            $pending_reciepts_res = mysqli_query($conn, $pending_reciepts);

                            if(mysqli_num_rows($pending_reciepts_res) > 0){

                                $cnt = 1;

                                while($row = mysqli_fetch_assoc($pending_reciepts_res)){

                                    ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row['reciept_no']; ?></td>
                                            <td><?php echo $row['worker_name']; ?></td>
                                            <td><?php echo $row['customer_order']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><?php echo $row['prd_metal']; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <td><?php echo $row['prd_weight']; ?> <em>gm</em></td>
                                            <td><?php echo $row['start_date']; ?></td>
                                            <td><?php echo $row['deadline_date']; ?></td>
                                        </tr>
                                    <?php $cnt++;

                                }// while end

                            }// if num_rows end

                        }// if isset end

                        // for getting reciepts who have status = "completed"
                        if(isset($_POST['completed'])){
                            
                            $completed_reciepts = "SELECT mfg_work_reciept.reciept_no, mfg_workers.id, mfg_work_reciept.worker,
                                                mfg_workers.worker_name, mfg_work_reciept.customer_order, mfg_work_reciept.prd_metal, 
                                                mfg_work_reciept.prd_category, mfg_work_reciept.prd_weight, mfg_work_reciept.start_date,
                                                mfg_work_reciept.deadline_date, mfg_work_reciept.status, category.id, category.category_name FROM mfg_work_reciept 
                                                JOIN mfg_workers ON mfg_work_reciept.worker = mfg_workers.id JOIN category ON mfg_work_reciept.prd_category = category.id
                                                WHERE status='completed' ORDER BY reciept_no";
                            $completed_reciepts_res = mysqli_query($conn, $completed_reciepts);

                            if(mysqli_num_rows($completed_reciepts_res) > 0){

                                $cnt = 1;

                                while($row = mysqli_fetch_assoc($completed_reciepts_res)){

                                    ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row['reciept_no']; ?></td>
                                            <td><?php echo $row['worker_name']; ?></td>
                                            <td><?php echo $row['customer_order']; ?></td>
                                            <td><?php echo $row['status']; ?></td>
                                            <td><?php echo $row['prd_metal']; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <td><?php echo $row['prd_weight']; ?> <em>gm</em></td>
                                            <td><?php echo $row['start_date']; ?></td>
                                            <td><?php echo $row['deadline_date']; ?></td>
                                        </tr>
                                    <?php $cnt++;

                                }// while end

                            }// if num_rows end

                        }// if isset end

                    ?>
                </tbody>
            </table>

        </div>

    </div>


<!-- ====================================================================== -->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!-- ====================================================================== -->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- ====================================================================== -->

    <script type="text/javascript">
    
        $(document).ready(function(){

            $("#inwork_form").submit(function(){

                $("#inwork").attr("class", "btn btn-lg btn-block btn-primary");

            });

        });

    </script>

</body>
</html>

<?php } ?>