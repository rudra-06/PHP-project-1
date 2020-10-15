<?php
session_start();
error_reporting(0);

if($_SESSION['user'] == ''){

    $_SESSION['user'] = '';
    header('location:index.php');
 
} else {
include 'connection.php';

$user = $_SESSION['user'];
 




    // gold items
    $gold_item = "SELECT * FROM products WHERE metal = 'gold'";
    $result = mysqli_query($conn, $gold_item);

    $gold_row_count = mysqli_num_rows($result);

    // silver items
    $silver_item = "SELECT * FROM products WHERE metal = 'silver'";
    $exe = mysqli_query($conn, $silver_item);

    $silver_row_count = mysqli_num_rows($exe);


    // total category
    $total_category = "SELECT category_name FROM category";
    $run = mysqli_query($conn, $total_category);

    $category_row_count = mysqli_num_rows($run);

    // delete items
    if(isset($_GET['delid'])){

        $delid = $_GET['delid'];
        $delete = "DELETE FROM products WHERE id='$delid'";
        $delete_res = mysqli_query($conn, $delete);

        header('location:item_detail.php');

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

                <li class="nav-item dropdown ml-2 active">
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

    <div class="container">

        <div class="row mx-auto mt-5">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card text-center p-3" id="card1" style="width: 18rem;">
                    <div class="card-title border-bottom-dark">
                        <h1><?php echo $gold_row_count; ?></h1>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Gold Items</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card text-center p-3" id="card2" style="width: 18rem;">
                    <div class="card-title border-bottom-dark">
                        <h1><?php echo $silver_row_count; ?></h1>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Silver Items</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card text-center p-3" id="card3" style="width: 18rem;">
                    <div class="card-title border-bottom-dark">
                        <h1><?php echo $category_row_count; ?></h1>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Total Category</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 bg-white">
            <table class="table table-hover" >
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">Sr no</th>
                        <th scope="col">Code</th>
                        <th scope="col">Metal</th>
                        <th scope="col">Category</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Labour</th>
                        <th scope="col">Price</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                         $select = "SELECT products.id, products.code, products.metal, products.weight,
                                    category.category_name, branches.name as branch_name, products.labour, 
                                    products.price FROM products JOIN category ON category.id = products.category_id 
                                    JOIN branches ON branches.id = products.branch_id ORDER BY id DESC";
                        $res = mysqli_query($conn, $select);

                        if(mysqli_num_rows($res) > 0){

                            $cnt = 1;

                            while($row = mysqli_fetch_assoc($res)){

                                ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['code']; ?></td>
                                        <td><?php echo $row['metal']; ?></td>
                                        <td><?php echo $row['category_name']; ?></td>
                                        <td><?php echo $row['branch_name']; ?></td>
                                        <td><?php echo $row['weight']; ?></td>
                                        <td><?php echo $row['labour']; ?></td>
                                        <td><?php echo $row['price']; ?></td>
                                        <td><a class="btn btn-outline-primary" href="edit_item.php?id=<?php echo $row['id']; ?>" name="edit">Edit</a></td>
                                        <td><a class="btn btn-danger" href="item_detail.php?delid=<?php echo $row['id']; ?>" name="delete">Delete</a></td>
                                    </tr>
                                <?php
                                $cnt++;
                            }

                        } else {

                            echo "No records found.";

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

