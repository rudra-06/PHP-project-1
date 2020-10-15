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

    

if(isset($_POST['additem'])){

    $code = $_POST['code'];
    $metal = $_POST['metal'];
    $category = $_POST['category'];
    $branch = $_POST['branch'];
    $weight = $_POST['weight'];
    $labour = $_POST['labour'];
    $price = $_POST['price'];

    $insert = "INSERT INTO products (code, metal, category_id, branch_id, weight, labour, price)
                VALUES ('$code', '$metal','$category', '$branch', '$weight', '$labour', '$price')";
    $res = mysqli_query($conn, $insert);

    if (!$res){
        //die('Error: ' . mysql_error());
    }
    else{
        // 1 record added
        //if number of rows affected > 0
        header('Location:add_item.php?status=1'); //redirects back to form with status=1
        // echo "success";
    }

    // caegory from db.
    

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
            <form class="form-inline">
                <button type="button" class="btn btn-info mr-3" data-toggle="tooltip" data-placement="bottom" title="<?php echo $user; ?>">USER</button>
                <a href="logout.php" class="btn btn-danger">LOGOUT</a>                
            </form>
        </div>
    </nav>

    <div class="container">
        
        <div>
            <h2 class="my-4"><strong>Add Item</strong></h2>
            <div class="center d-flex bd-highlight p-3 rounded text-success bg-white w-50 mx-auto justify-content-between" id="popup">
                <h5 class="center">
                <?php 
                    $recordAdded = false;

                    $status = $_GET['status'];
                    if($status == 1){
                       $recordAdded = true;
                    }
                    
                    if($recordAdded){
                        echo "<span class='lnr lnr-checkmark-circle mr-2 bd-highlight'></span>Item Added Successfully.";
                        echo "<a href='item_detail.php' class='align-item-end btn btn-sm btn-outline-success bd-highlight'>View</a>";
                    }

                ?></h5>
            </div>
        </div>

        <form method="POST" id="additemform" class="mx-auto bg-white mt-5 p-5 rounded w-75">

            <div class="form-group">
                <label for="metal">Metal:</label>
                <select class="form-control" name="metal" id="metal" required>
                    <option value="none" hidden>Select Metal</option>
                    <option value="gold">Gold</option>
                    <option value="silver">Silver</option>
                </select>
                <span class="text-danger" id="metalErr"></span>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select class="form-control" name="category" id="category" required>
                    <option value="none" hidden>Select category</option>
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

            <div class="form-group">
                <label for="code">Item Code:</label>
                <input type="text" name="code" class="form-control" id="code" readonly required>
                <span class="text-danger" id="codeErr"></span>
            </div>

            <div class="form-group">
                <label for="branch">Branch:</label>
                <select class="form-control" name="branch" id="branch" required>
                    <option value="none" hidden>Select branch</option>
                <?php 
                    $branches = "SELECT  id,name  FROM branches";
                    $branches_res = mysqli_query($conn, $branches);

                    if(mysqli_num_rows($branches_res) > 0){

                        while($_branch = mysqli_fetch_assoc($branches_res)){
                        ?>
                            <option value="<?php echo $_branch['id']; ?>"> <?php echo $_branch['name']; ?> </option>
                            
                        <?php } 
                    } 
                    ?>
                </select>
                <span class="text-danger" id="branchErr"></span>
            </div>

            <div class="form-group">
                <label for="weight">Weight <em>(gm)</em>:</label>
                <input type="text" name="weight" class="form-control" id="weight" required>
                <span class="text-danger" id="weightErr"></span>
            </div>

            <div class="form-group">
                <label for="labour">Labour <em>(Rs)</em>:</label>
                <input type="text" name="labour" class="form-control" id="labour" required>
                <span class="text-danger" id="labourErr"></span>
            </div>

            <div class="form-group">
                <label for="price">Price <em>(Rs)</em>:</label>
                <input type="text" name="price" class="form-control" id="price" required>
                <span class="text-danger" id="priceErr"></span>
            </div>
            
            <button type="submit" name="additem" class="btn btn-primary">Submit</button>
            <button type="cancel" class="btn btn-danger">Cancel</button>
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

    <script type="text/javascript">
        $(document).ready(function(){

            function generate_itm_code(metal, category){

                $.ajax({

                    url:"itm_code.php",
                    method:"POST",
                    data: {metal:metal, category:category},
                    // dataType:"Json",

                    success:function(data){
                        $("#code").val(data);
                    },

                    error:function(data, er){

                        if(data.status == 0){
                            alert('You are offline!!\n Please Check Your Network.');
                        } else if(data.status == 404){
                            alert("oops, time to contact Admin about\n Some of the page is stopped working.");
                        } else if(data.status == 500){
                            alert('Internel Server Error.');
                        } else if(er == "parsererror"){
                            alert('Please try again after some time. parsererror');
                        } else if(er == "timeout"){
                            alert('"TIMEOUT", Please try again.');
                        } else {
                            alert("Inform admin about this.\n"+data.responseText);
                        }

                    }

                })

            }
            
            $('#category').change(function(){

                var metal = $('#metal').val();
                var category = $('#category').val();
                generate_itm_code(metal, category);

            })


        });
    </script>
</body>
</html>

<?php } ?>
