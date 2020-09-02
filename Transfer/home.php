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

    // Global variables.
    $g_codes = '';
    $g_number_of_codes = '';
    // assuming that this items are already in branch from which they have been tranfered to another branch.
    $branch = ''; // 1 for head branch.
    

    // Search item to transfer by its code.
    if(isset($_POST['searchitem'])){

        $codes = $_POST['code'];

         

        $_SESSION['item_codes'] = $codes;

        // foreach($codes as $code){echo $code;}

        $number_of_codes = count($_POST['code']);
        if($number_of_codes > 0){

            // to get branch id dynamically and use at transfer.
            for($br_id=0; $br_id < $number_of_codes; $br_id++){

                $select_branch = "SELECT branch_id FROM products WHERE code='$codes[$br_id]'";
                $select_branch_res = mysqli_query($conn, $select_branch);
                $fetch_branch_id = mysqli_fetch_assoc($select_branch_res);
                $branch_id = $fetch_branch_id['branch_id'];

                $_SESSION['dy_branch_id'] = $branch_id;

            }

            $GLOBALS['g_number_of_codes'] = $number_of_codes;

            // firing multiple queries as per different conditions. 
            for ($i=0; $i < $number_of_codes; $i++) { 


                if(trim($_POST["code"][$i] != ''))
                {

                    $select = "SELECT products.id, products.code, products.metal, products.category_id, 
                            products.branch_id, products.weight, products.labour, products.price, 
                            category.id as cat_id, category.category_name, branches.id as branch_id, 
                            branches.name as branch_name FROM products JOIN category ON products.category_id = category.id 
                            JOIN branches ON products.branch_id = branches.id 
                            WHERE products.code = '$codes[$i]' AND products.branch_id = '$branch_id'";
                    $select_res = mysqli_query($conn, $select);                    

                }

            }
            $select_fetch = mysqli_fetch_assoc($select_res);

        }

    }

    // Tranfer the product by updating its  branch.
    if(isset($_POST['transfer'])){

        //$code = $GLOBALS['g_codes'];
        $code = $_SESSION['item_codes']; 

        $dynamic_br_id = $_SESSION['dy_branch_id'];
        echo $dynamic_br_id;
        //foreach($_SESSION['dy_branch_id'] as $op){echo $op;}

        // foreach($code as $prd){echo $prd;} exit();

        if($code == ""){
            echo "<script type='text/javascript'>alert('Please select at least one item.');</script>";
        }

        // data from form 2
        $transfer_to_branch = $_POST['transfer_to_branch'];
        $current_branch = $_POST['current_branch'];

        // if tranfer to same branch.
        if($transfer_to_branch == $current_branch){

            echo "<script type='text/javascript'>alert('Item is already in current branch.');</script>";
            
        } else {
        
            // to get the id of product which satisfy the following condition
            for ($i=0; $i < sizeof($code); $i++) { 
                
                // to get product id to use in mysqli_stmt.
                $seletc_prd = "SELECT products.id as p_id, products.code, products.metal, products.category_id, 
                        products.branch_id, products.weight, products.labour, products.price, 
                        category.id as cat_id, category.category_name, branches.id as branch_id, 
                        branches.name as branch_name FROM products JOIN category ON products.category_id = category.id 
                        JOIN branches ON products.branch_id = branches.id 
                        WHERE products.code = '$code[$i]' AND products.branch_id = '$dynamic_br_id'";
                $seletc_prd_res = mysqli_query($conn, $seletc_prd);

                $fetch = mysqli_fetch_assoc($seletc_prd_res);
                $prdct_id = $fetch['p_id'];


                // to query multiple times at a same time.
                $select_stmt = mysqli_prepare($conn, "SELECT products.id as p_id, products.code, products.metal, products.category_id, 
                        products.branch_id, products.weight, products.labour, products.price, 
                        category.id as cat_id, category.category_name, branches.id as branch_id, 
                        branches.name as branch_name FROM products JOIN category ON products.category_id = category.id 
                        JOIN branches ON products.branch_id = branches.id 
                        WHERE products.code = ? AND products.branch_id = ?"); 

                mysqli_stmt_bind_param($select_stmt, "si", $code[$i], $dynamic_br_id);

                $update_stmt = mysqli_prepare($conn, "UPDATE products SET branch_id = ? WHERE id=?");

                mysqli_stmt_bind_param($update_stmt, "si", $transfer_to_branch, $prdct_id);

                mysqli_stmt_execute($update_stmt);
            
                 
            } // for end
            
        } // else end

        if($update_stmt){
            echo "<script type='text/javascript'>alert('Transfer successful.');</script>";
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

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <button type="button" class="btn btn-info mr-3" data-toggle="tooltip" data-placement="bottom" title="<?php echo $user; ?>">USER</button>
                <a href="logout.php" class="btn btn-danger">LOGOUT</a>                
            </form>
        </div>
    </nav>

    <div class="container">

        <div class="mt-5 mx-auto  w-75">
            <h3><strong>Select Item</strong></h3>
        </div>


        <!-- form for search the item, wnat to transfer -->

        <div class="form-group mx-auto bg-white w-75 p-4">  
            <form name="add_name" id="add_name" method="POST">  
                <div class="table-responsive">  
                    <table class="table" id="dynamic_field">  
                        <tr>  
                            <td><input type="text" name="code[]" placeholder="Enter Item code" class="form-control name_list" /></td>  
                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                        </tr>  
                    </table>  
                    <input type="submit" name="searchitem" id="submit" class="btn btn-info" value="Search" />  
                </div>  
            </form>  
        </div>


        <div class="mt-5 mx-auto  w-75">
            <h3><strong>Item Details</strong></h3>
        </div>

        <!-- form for transfer and show item details -->
        <form method="POST" action="" id="" class="mx-auto bg-white mt-3 mb-5 p-5 rounded w-75">

            <!-- current branch -->
            <div class="form-group">
                <label for="current_branch">Current Branch:</label>
                <select class="form-control" readonly name="current_branch" id="current_branch">
                    <option value=<?php echo $select_fetch['branch_id']; ?>> <?php echo $db_branch_name = $select_fetch['branch_name']; ?> </option>

                    <?php
                        $select_branch = "SELECT id,name FROM branches";
                        $select_branch_res = mysqli_query($conn, $select_branch);

                        if(mysqli_num_rows($select_branch_res) > 0){

                            while($branches = mysqli_fetch_assoc($select_branch_res)){

                                if($db_branch_name == $branches['name']){
                                    continue;
                                } else {
                                    ?>
                                        <option value=<?php echo $branches['id']; ?>> <?php echo $branches['name']; ?> </option>
                                    <?php
                                }

                            }

                        }

                    ?>

                </select>
                <span class="text-danger" id="branchErr"></span>
            </div>

            <!-- transfer to branch -->
            <div class="form-group">
                <label for="transfer_to_branch">Transfer To Branch:</label>
                <select class="form-control" name="transfer_to_branch" id="transfer_to_branch">

                    <?php
                        $select_branch = "SELECT id,name FROM branches";
                        $select_branch_res = mysqli_query($conn, $select_branch);

                        if(mysqli_num_rows($select_branch_res) > 0){

                            while($branches = mysqli_fetch_assoc($select_branch_res)){
                                ?>
                                    <option value=<?php echo $branches['id']; ?>> <?php echo $branches['name']; ?> </option>
                                <?php
                            }

                        }
                    ?>

                </select>
                <span class="text-danger" id="branchErr"></span>
            </div>
            
            <!-- <div class="form-group">
                <label for="code">Item Code:</label>
                <input type="text" readonly name="code" value="<?php //echo $fetch['code']; ?>" class="form-control" id="code">
                <span class="text-danger" id="codeErr"></span>
            </div>

            <div class="form-group">
                <label for="metal">Metal:</label>
                <select class="form-control" readonly name="metal" id="metal">
                    <option value=<?php //echo $fetch['metal']; ?>> <?php //echo $metal_name = $fetch['metal']; ?> </option>

                    <?php 
                        // $select_metal = "SELECT DISTINCT metal FROM products";
                        // $select_metal_res = mysqli_query($conn, $select_metal);

                        // if(mysqli_num_rows($select_metal_res) > 0){

                        //     while($metals = mysqli_fetch_assoc($select_metal_res)){

                        //         if($metal_name == $metals['metal']){
                        //             continue; //to get rid off repeating values.
                        //         } else {
                        //             ?>
                        //                 <option value=<?php// echo $metals['metal']; ?>> <?php// echo $metals['metal']; ?> </option>
                        //             <?php
                        //         }
                        //     }
                        // }

                    ?>
                </select>
                <span class="text-danger" id="metalErr"></span>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" readonly name="category" id="category">
                    <option value=<?php //echo $fetch['cat_id']; ?>> <?php// echo $category_name = $fetch['category_name']; ?> </option> 

                    <?php
                        // $select_category = "SELECT  id,category_name FROM category";
                        // $select_category_res = mysqli_query($conn, $select_category);

                        //     if(mysqli_num_rows($select_category_res) > 0){

                        //         while($categories = mysqli_fetch_assoc($select_category_res)){

                        //             if($category_name == $categories['category_name']){
                        //                 continue;
                        //             } else {

                        //                 ?>
                        //                     <option value=<?php //echo $categories['id']; ?>> <?php// echo $categories['category_name']; ?> </option>
                        //                 <?php

                        //             }
    
                        //         }
                        //     }
                        ?>
                
                </select>
                <span class="text-danger" id="categoryErr"></span>
            </div>

            <div class="form-group">
                <label for="weight">Weight <em>(gm)</em>:</label>
                <input type="text" readonly name="weight" value="<?php// echo $fetch['weight']; ?>" class="form-control" id="weight">
                <span class="text-danger" id="weightErr"></span>
            </div>

            <div class="form-group">
                <label for="labour">Labour <em>(Rs)</em>:</label>
                <input type="text" readonly name="labour" value="<?php// echo $fetch['labour']; ?>" class="form-control" id="labour">
                <span class="text-danger" id="labourErr"></span>
            </div>

            <div class="form-group">
                <label for="price">Price <em>(Rs)</em>:</label>
                <input type="text" readonly name="price" value="<?php// echo $fetch['price']; ?>" class="form-control" id="price">
                <span class="text-danger" id="priceErr"></span>
            </div> -->

            <button type="submit" name="transfer" class="btn btn-primary">TRANSFER</button>
            <button type="cancel" class="btn btn-danger">CANCEL</button>
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

    <script>  
        $(document).ready(function(){  
            var i=1;  
            $('#add').click(function(){  
                i++;  
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="code[]" placeholder="Enter Item code" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
            });  
            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();  
            });  
        });  
    </script>

<?php } ?>