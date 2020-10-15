<?php
session_start();
error_reporting(0);

if($_SESSION['user'] == ''){

    $_SESSION['user'] = '';
    header('location:index.php');
 
} else {
include 'connection.php';

$user = $_SESSION['user'];
 
    $gvn_material_weight = $_SESSION['gvn_material_weight'];
    $prd_metal = $_SESSION['prd_metal'];
    

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

        <div class="mt-5 mb-2">
            <h2><strong>Metal Stock:</strong></h2>
        </div>

        <div class="row mx-2">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card text-center p-3" id="card1">
                    <div class="card-body">
                        <h3 class="card-title">Gold</h3>
                    </div>
                    <div class="card-title border-bottom-dark">
                        <h1>
                        <?php
                            if($prd_metal == 'gold'){

                                // total amount of gold
                                $gold_amount = "SELECT SUM(quantity) AS g_val FROM mfg_stock WHERE name='gold'";
                                $gold_amount_res = mysqli_query($conn, $gold_amount);
                        
                                $total_g_amount = mysqli_fetch_assoc($gold_amount_res);
                                
                                $quantity = $total_g_amount['g_val'];
                                echo $updated_g_amount = $quantity - $gvn_material_weight;
                        
                            } else {

                                $gold_amount = "SELECT SUM(quantity) AS g_val FROM mfg_stock WHERE name='gold'";
                                $gold_amount_res = mysqli_query($conn, $gold_amount);
                        
                                $total_g_amount = mysqli_fetch_assoc($gold_amount_res);

                                echo $total_g_amount['g_val'];

                            }
                        ?> 
                        <span class="h4"><em>gms</em></span> </h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card text-center p-3" id="card2">
                    <div class="card-body">
                        <h3 class="card-title">Silver</h3>
                    </div>
                    <div class="card-title border-bottom-dark">
                        <h1>
                        <?php
                            if($prd_metal == 'silver') {

                                // total amount of silver
                                $silver_amount = "SELECT SUM(quantity) AS s_val FROM mfg_stock WHERE name='silver'";
                                $silver_amount_res = mysqli_query($conn, $silver_amount);
                        
                                $total_s_amount = mysqli_fetch_assoc($silver_amount_res);
                        
                                $s_quantity = $total_s_amount['s_val'];
                                echo $updated_s_amount = $s_quantity - $gvn_material_weight;
                        
                            } else {

                                $silver_amount = "SELECT SUM(quantity) AS s_val FROM mfg_stock WHERE name='silver'";
                                $silver_amount_res = mysqli_query($conn, $silver_amount);
                        
                                $total_s_amount = mysqli_fetch_assoc($silver_amount_res);

                                echo $total_s_amount['s_val'];

                            }
                        ?> 
                        <span class="h4"><em>gms</em></span> </h1>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="mt-5 mb-2">
            <h2><strong>Machinery Stock:</strong></h2>
        </div>

        <div class="bg-white">

            <table class="table table-hover" >
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">Sr no</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $select = "SELECT * FROM mfg_stock WHERE category='machineries'";
                        $res = mysqli_query($conn, $select);

                        if(mysqli_num_rows($res) > 0){

                            $cnt = 1;

                            while($row = mysqli_fetch_assoc($res)){

                                ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><a class="btn btn-primary" href="edit_item.php?mchid=<?php echo $row['id']; ?>" name="edit">Edit</a></td>
                                    </tr>
                                <?php
                                $cnt++;
                            }

                        } else {

                            echo "<h5 class='text-white text-center bg-secondary p-2'><----No records found.----></h5>";

                        }
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
</body>
</html>

<?php } ?>

