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


    $id = $_GET['id'];
    
    $select = "SELECT products.id, products.code, products.metal, category.id as cat_id, category.category_name, 
                    branches.id as branch_id, branches.name as branch_name, products.weight, products.labour, products.price 
                    FROM products JOIN category ON products.category_id = category.id 
                    JOIN branches ON products.branch_id = branches.id WHERE products.id = '$id'";
    $res = mysqli_query($conn, $select);

    $fetch = mysqli_fetch_assoc($res);
    

    // if (!$res){
        
    // }
    // else{
    //     // 1 record added
    //     //if number of rows affected > 0
    //     //header('Location:add_item.php?status=1'); //redirects back to form with status=1
    // }
    
    // SELECT products.id, products.code, products.metal, products.weight, category.id, category.category_name, branches.name, products.labour, products.price FROM products JOIN category ON category.id = products.category JOIN branches ON branches.id = products.branch WHERE products.id='10'

    if(isset($_POST['update'])){

        $code = $_POST['code'];        
        $metal = $_POST['metal'];        
        $category = $_POST['category'];        
        $branch = $_POST['branch'];        
        $weight = $_POST['weight'];        
        $labour = $_POST['labour'];        
        $price = $_POST['price'];    

        $update = "UPDATE products SET code = '$code', metal = '$metal', category_id = '$category', 
                    branch_id = '$branch', weight = '$weight', labour = '$labour', price = '$price'
                    WHERE id = '$id'";
        $update_res = mysqli_query($conn, $update);
        
        if(!$update_res){
            //die('Error: ' . mysql_error());
        } else {
            header('location:item_detail.php?status=1');
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

    <style>
        /* #popup {
        visibility: hidden; 
        background-color: red; 
        position: absolute;
        top: 10px;
        z-index: 100; 
        height: 100px;
        width: 300px
    }    */
    </style>

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
                
                <li class="nav-item ml-2 ">
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
        
        <div>
            <h2 class="my-4"><strong>Edit Item</strong></h2>
            <div class="center p-3 rounded bg-white w-50 mx-auto" id="popup">
                <h5 class="center">
                
                <?php 
                    if(mysqli_num_rows($res) <= 0){
                        echo "<span class='lnr lnr-cross-circle'></span>No records Found.";
                    }
                ?></h5>
            </div>
        </div>


        <form method="POST" action="" id="additemform" class="mx-auto bg-white mt-5 p-5 rounded w-75">

            <div class="form-group">
                <label for="code">Item Code:</label>
                <input type="text" name="code" readonly value="<?php echo $fetch['code']; ?>" class="form-control" id="code">
                <span class="text-danger" id="codeErr"></span>
            </div>

            <div class="form-group">
                <label for="metal">Metal:</label>
                <select class="form-control" readonly name="metal" id="metal" required>
                    <option value=<?php echo $fetch['metal']; ?>> <?php echo $metal_name = $fetch['metal']; ?> </option>

                    <?php 
                        $select_metal = "SELECT DISTINCT metal FROM products";
                        $select_metal_res = mysqli_query($conn, $select_metal);

                        if(mysqli_num_rows($select_metal_res) > 0){

                            while($metals = mysqli_fetch_assoc($select_metal_res)){

                                if($metal_name == $metals['metal']){
                                    continue;
                                } else {
                                    ?>
                                        <option value=<?php echo $metals['metal']; ?>> <?php echo $metals['metal']; ?> </option>
                                    <?php
                                }
                            }
                        }

                    ?>
                    
                </select>
                <span class="text-danger" id="metalErr"></span>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" readonly name="category" id="category" required>
                    <option value=<?php echo $fetch['cat_id']; ?>> <?php echo $category_name = $fetch['category_name']; ?> </option> <!-- $category_name = -->

                        <?php
                            $select_category = "SELECT  id,category_name FROM category";
                            $select_category_res = mysqli_query($conn, $select_category);

                            if(mysqli_num_rows($select_category_res) > 0){

                                while($categories = mysqli_fetch_assoc($select_category_res)){

                                    if($category_name == $categories['category_name']){
                                        continue;
                                    } else {

                                        ?>
                                            <option value=<?php echo $categories['id']; ?>> <?php echo $categories['category_name']; ?> </option>
                                        <?php

                                    }
    
                                }
                            }
                        ?>
                    
                </select>
                <span class="text-danger" id="categoryErr"></span>
            </div>

            <div class="form-group">
                <label for="branch">Branch:</label>
                <select class="form-control" readonly name="branch" id="branch" required>
                    <option value="<?php echo $fetch['branch_id']; ?>"> <?php echo $db_branch_name = $fetch['branch_name']; ?> </option>
                    <?php 
                        $branches = "SELECT  id,name  FROM branches";
                        $branches_res = mysqli_query($conn, $branches);

                        if(mysqli_num_rows($branches_res) > 0){

                            while($_branch = mysqli_fetch_assoc($branches_res)){

                                if($db_branch_name == $_branch['name']){
                                    continue;
                                } else {
                                    ?>
                                    <option value="<?php echo $_branch['id']; ?>"> <?php echo $_branch['name']; ?> </option>
                                    <?php
                                }
                            } 
                        } 
                        ?>
                </select>
                <span class="text-danger" id="branchErr"></span>
            </div>

            <div class="form-group">
                <label for="weight">Weight <em>(gm)</em>:</label>
                <input type="text" name="weight" value="<?php echo $fetch['weight']; ?>" class="form-control" id="weight" required>
                <span class="text-danger" id="weightErr"></span>
            </div>

            <div class="form-group">
                <label for="labour">Labour <em>(Rs)</em>:</label>
                <input type="text" name="labour" value="<?php echo $fetch['labour']; ?>" class="form-control" id="labour" required>
                <span class="text-danger" id="labourErr"></span>
            </div>

            <div class="form-group">
                <label for="price">Price <em>(Rs)</em>:</label>
                <input type="text" name="price" value="<?php echo $fetch['price']; ?>" class="form-control" id="price" required>
                <span class="text-danger" id="priceErr"></span>
            </div>
            
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="item_detail.php" type="cancel" class="btn btn-danger">Cancel</a>
        </form>
    </div>


<!-- ====================================================================== -->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!-- ====================================================================== -->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- ====================================================================== -->
    <script src="js/add_item.js"></script>
    <script src="js/jQuery_3.1.1_.js"></script>
</body>
</html>

<?php } ?>
