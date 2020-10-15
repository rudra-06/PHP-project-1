<?php
session_start();

if($_SESSION['user'] == ''){

    $_SESSION['user'] = '';
    header('location:index.php');
 
} else {
include 'connection.php';
date_default_timezone_set("Asia/Calcutta");
$today = date('d-m-Y');

$user = $_SESSION['user'];
 


// ========= Global variables ==========
   $count = 1;
   $digits = 10;
// ========= Global variables end ==========

// ========== get last id from work table to use in generating reciept no =========
   $select_inv_id = "SELECT id FROM invoices";
   $select_inv_id_res = mysqli_query($conn, $select_inv_id);

   if(mysqli_num_rows($select_inv_id_res) == 0){
       
       $_SESSION['start_pt'] = '1';

   } else {

       $rows = mysqli_num_rows($select_inv_id_res);
       $_SESSION['start_pt'] = $rows + 1;

   }

   // varible to be used by function generate_reciept_number 
   $start = $_SESSION['start_pt'];
// ========= get last id end =========

   // ======= function to generate automatic reciept number =======
   function generate_invoice_number($start, $count, $digits){
       /*
       $start: is number first invice
       (global) $count: how many reciept numbers want to generate(1 at a time)
       (global) $digits: how many digits the generated numbers should be
       */
       $invoice_number = array();
       for($n = $start; $n < $start + $count; $n++){

           $invoice_number = str_pad($n, $digits, "0", STR_PAD_LEFT);

       }
       return $invoice_number;

   } 
   // ======= function end =======
   


    if(isset($_POST['submit'])){

        $invoice_num = $_POST['invoice_num'];
        $date = $_POST['date'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $payment_mode = $_POST['payment_mode'];
        $total = $_POST['total'];
        $discount = $_POST['discount'];
        $g_total = $_POST['g_total'];
        $codes = $_POST['itm_code'];

        $itm_codes = explode(",", $codes);
        
        $pcs = count($itm_codes);
        

        $insert = "INSERT INTO invoices (invoice_no, name, phone, email, address, payment_mode, 
                item_code, pcs, total_amount, discount, grand_total) VALUES ('$invoice_num', '$name', 
                '$phone', '$email', '$address', '$payment_mode', '$codes', '$pcs', '$total', '$discount', '$g_total')";
        
        $insert_res = mysqli_query($conn, $insert);

        if ($insert_res){

            foreach($itm_codes as $itm){
                $delete = "DELETE FROM products WHERE code='$itm'";
                $delete_res = mysqli_query($conn, $delete);
            }

            echo "<script type='text/javascript'>alert('Invoice Generated successfully.')</script>";
        } else {
            echo "<script type='text/javascript'>alert('Oops You missed something, please try again.'</script>)";
        }
        

    }    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>B.K.Jewellers</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

    <link rel="stylesheet" type="text/css" href="css/card.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="vendor/bootstrap-tagsinput/src/bootstrap-tagsinput.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-typeahead.css" />
    
    <style>
        .tagsinput {
            width: 70%;
        }
    </style>

</head>
<body style="background-color:#efe8eb;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand p-0" href="#">
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

                <li class="nav-item active">
                    <a class="nav-link" href="invoice.php">New Sale</a>
                </li>

                <li class="nav-item ml-2">
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
            <form class="d-flex justify-content-end form-inline mt-3 my-lg-0">
                <button type="button" class="btn btn-info mr-3" data-toggle="tooltip" data-placement="bottom" title="<?php echo $user; ?>">USER</button>
                <a href="logout.php" class="btn btn-danger">LOGOUT</a>                
            </form>
        </div>
    </nav>

    <div class="container">
    
        <form method="POST" id="invoice" name="invoice" class="mx-auto bg-white mt-5 mb-5 p-5 rounded w-75">

            <!-- header of invoice -->
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
                    <p class="h2 text-muted"><u>SALE INVOICE</u></p>
                    <div class="form-group mt-3">
                        <label for="invoice_num" class="sr-only">Invoice Number:</label>
                        <input type="text" readonly name="invoice_num" value="<?php echo $numbers = generate_invoice_number($start, $count, $digits); ?>" class="form-control" id="invoice_num" placeholder="Invoice Number" >
                        <span class="text-danger" id="invoice_numErr"></span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="date" class="sr-only">Date:</label>
                        <input type="text" readonly name="date" value="<?php echo $today; ?>" class="form-control" id="date">
                        <span class="text-danger" id="dateErr"></span>
                    </div>
                </div>                
                
            </div>

            <hr>

            <!-- item codes -->
            <div class="form-inline mt-4 mx-auto">
                <label for="itm_code" class="mx-3 h5">Item Code:</label>
                <input type="text" name="itm_code" id="itm_code" class="form-control" data-role="tagsinput" placeholder="Enter item code" required>
                <span class="text-danger"></span>
                <button type="button" name="search" class="btn btn-primary mx-2" id="search">Search</button>

            </div>

            <div class="mt-4">
                <table class="table table-responsive table-secondary">
                
                    <thead class="bg-dark text-white" id="thead">
                        <tr class="text-center">
                            <th scope="col">Code</th>
                            <th scope="col">Metal</th>
                            <th scope="col">Category</th>
                            <th scope="col">Weight <em>(gm)<em></th>
                            <th scope="col">Labour</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <!-- tbody will generated via js see at script below -->
                    <tbody>
                    </tbody>
                
                </table>
            </div>

            <!-- client and payment info -->
            <fieldset class="bg-light mt-4 p-4 border border-info">
                <legend class="text-sm-left text-info">Client Info</legend>
                <div class="form-row mb-4">
                
                    <div class="col-6">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Client's Name" required>
                        <span class="text-danger" id="nameErr"></span>
                    </div>

                    <div class="col-6">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Client's Email" pattern='^((?!\.)[\w-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$' title="Please enter a valid Email address." required>
                        <span class="text-danger" id="emailErr"></span>
                    </div>
                
                </div>

                <div class="form-row mb-4">
                
                    <div class="col-4">
                        <label for="phone">Phone:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                +91
                            </div>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Client's Phone" pattern='^([[+91]{2,3})?([7-9][0-9]{9})$' title="Please enter a valid phone number" required>
                            <span class="text-danger" id="phoneErr"></span>
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Client's Address" required>
                        <span class="text-danger" id="addressErr"></span>
                    </div>

                    <div class="col-4">
                        <label for="payment_mode">Payment Mode:</label>
                        <select name="payment_mode" class="form-control h-50" id="payment_mode" required>
                            <option value="none" hidden>Select Mode</option>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="cheque">Cheque</option>
                        </select>
                        <span class="text-danger" id="payment_modeErr"></span>
                    </div>
                
                </div>
            </fieldset>

            <div class="d-flex justify-content-end bd-highlight mt-4">
                <div class="form-inline bd-highlight">
                    <label for="total" class="h6">Total:</label>
                    <div class="input-group ml-2">
                        <input type="text" name="total" class="form-control" id="total">
                        <div class="input-group-addon">
                            Rs
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between bd-highlight mt-2">

                <div class="form-inline bd-highlight ml-5">
                    <h6><u>Signed By</u></h6>
                </div>
                
                <div class="form-inline bd-highlight">
                    <label for="discount" class="h6">Discount:</label>
                    <div class="input-group ml-2">
                        <select name="discount" class="form-control h-50 w-100" id="discount" required>
                            <option value="none" hidden>Select Discount</option>
                            <option value="0">0</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="40">40</option>
                        </select>
                        <div class="input-group-addon px-4">
                            %
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end bd-highlight mt-2">
                

                <div class="form-inline bd-highlight">
                    <label for="g_total" class="h6">Grand Total:</label>
                    <div class="input-group ml-2">
                        <input type="text" name="g_total" class="form-control" id="g_total">
                        <div class="input-group-addon">
                            Rs
                        </div>
                    </div>
                </div>
            </div>

            <hr class="mx-3">

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
    <!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" ></script> -->
    <script src="vendor/bootstrap-tagsinput/src/bootstrap-tagsinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" crossorigin="anonymous"></script>
<!-- ====================================================================== -->

    <script>
    $(document).ready(function(){
    
        //load_data();

        function load_data(query)
        {
            
            $.ajax({
                
                url:"get_item.php",
                method:"POST",
                data:{query:query},
                dataType:"json",
            
                success:function(data)
                {
            
                    var html = '';
                    var price = 0;
                    
                    if(data.length > 0)
                    {
                    for(var count = 0; count < data.length; count++)
                    {
                        html += '<tr>';
                        html += '<td>'+data[count].code+'</td>';
                        html += '<td>'+data[count].metal+'</td>';
                        html += '<td>'+data[count].category_name+'</td>';
                        html += '<td>'+data[count].weight+'</td>';
                        html += '<td>'+data[count].labour+'</td>';
                        html += '<td class="price">'+data[count].price+'</td></tr>';
                        price = price + parseFloat(data[count].price);
                        
                    }
                    }
                    else
                    {
                    html = '<tr><td colspan="6">No Data Found</td></tr>';
                    }
                    $('tbody').html(html);

                    $('#total').val(price);

                },
                error:function(data, er){

                    if(data.status == 0){
                        alert('You are offline!!\n Please Check Your Network.');
                    } else if(data.status == 404){
                        alert("oops, It's time to contact Admin.");
                    } else if(data.status == 500){
                        alert('Internel Server Error.');
                    } else if(er == "parsererror"){
                        alert('Please try again after some time.');
                    } else if(er == "timeout"){
                        alert('"TIMEOUT", Please try again.');
                    } else {
                         alert("Inform admin about this.\n"+data.responseText);
                    }

                }
            })
        }

        $("#search").click(function(){
            var query = $('#itm_code').val();
            load_data(query);
        });

        $('#discount').change(function(){

            grand_total = calc_discount(parseFloat($('#total').val()), parseFloat($('#discount').val()));
            $('#g_total').val(grand_total);

        });

        $('#total').change(function(){

            grand_total = calc_discount(parseFloat($('#total').val()), parseFloat($('#discount').val()));
            $('#g_total').val(grand_total);

        });

        function calc_discount(price, discount){

            if(discount == '10'){

                discount_val = 0.10;
                dis_amount = price * discount_val;
                grand_total = price - dis_amount;
                return grand_total.toFixed(2);

            } else if(discount == '20'){

                discount_val = 0.20;
                dis_amount = price * discount_val;
                grand_total = price - dis_amount;
                return grand_total.toFixed(2);

            } else if(discount == '40'){

                discount_val = 0.40;
                dis_amount = price * discount_val;
                grand_total = price - dis_amount;
                return grand_total.toFixed(2);

            } else {
                return price;
            }
            
        }

    });
</script>

<?php } ?>