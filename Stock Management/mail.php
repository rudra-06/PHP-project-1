<?php
session_start();

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


    if(isset($_POST['send'])){

        $to = $_POST['admin_uname']; //"rudrasoni2000@gmail.com";
        $sender_email = $_POST['sender_email']; 
        $sender_name = $_POST['sender_name']; 
        $subject = $_POST['mail_sub']; 
        $msg = $_POST['mail_msg']; 
        //$headers = "From: ".$_POST['mail_from']; //sonirdr06@gmail.com";

        $msg_to_admin = $sender_name." is contacting you from ".$sender_email.". Regarding to ".$subject.". 
        Description: ".$msg;

        $msg_from_admin = "Thank you for contacting, we will be get in touch with you soon at ".$sender_email;

        mail($to, $subject, $msg_to_admin);
        mail($sender_email, $subject, $msg_from_admin);

        if(mail($to, $subject, $msg_to_admin)){
            echo "<script type='text/javascript'>alert('Your mail was sent Successfully.')</script>";
        }

        // if(mail($to, $subject, $msg)){
        //     echo "success";
        // } else {
        //     $errorMessage = error_get_last();
        //     echo $errorMessage;
        
        // }

        // saving email information to table.
        $insert = "INSERT INTO mails (name, email_from, subject, message) VALUES ('$sender_name', '$sender_email', '$subject', '$msg')";
        $insert_res = mysqli_query($conn, $insert);
        


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

                <li class="nav-item ">
                    <a class="nav-link" href="home.php">Home</a>
                </li>

                <li class="nav-item dropdown ml-2">
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
                    <a class="nav-link" href="stock.php">Stock</a>
                </li>
                
                <li class="nav-item ml-2">
                    <a class="nav-link" href="#">Transfer</a>
                </li>

                <li class="nav-item ml-2">
                    <a class="nav-link" href="#">Help</a>
                </li>

                <li class="nav-item ml-2 active">
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

        <form method="POST" action="" id="sendmail" class="mx-auto bg-white mt-5 mb-5 p-5 rounded w-75">
        
            <div class="form-group">
                <label for="admin_uname">Admin Username:</label>
                <input type="email" readonly name="admin_uname" value="rudrasoni2000@gmail.com" class="form-control" id="admin_uname">
                <span class="text-danger" id="admin_unameErr"></span>
            </div>

            <div class="form-group">
                <label for="sender_name">Your Name:</label>
                <input type="text" name="sender_name" class="form-control" id="sender_name">
                <span class="text-danger" id="sender_nameErr"></span>
            </div>

            <div class="form-group">
                <label for="sender_email">Your Email:</label>
                <input type="email" name="sender_email" class="form-control" id="sender_email">
                <span class="text-danger" id="sender_emailErr"></span>
            </div>

            <div class="form-group">
                <label for="mail_sub">Subject:</label>
                <input type="text" name="mail_sub" class="form-control" id="mail_sub">
                <span class="text-danger" id="mail_subErr"></span>
            </div>

            <div class="form-group">
                <label for="mail_msg">Message:</label>
                <input type="text" name="mail_msg" class="form-control" id="mail_msg">
                <span class="text-danger" id="mail_msgErr"></span>
            </div>
            
            <button type="submit" name="send" class="btn btn-primary">SEND<span class="lnr lnr-envelope pl-2"></span></button>
        </form>

    </div>


<!-- ====================================================================== -->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!-- ====================================================================== -->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- ====================================================================== -->
    <script src="js/mail_validation.js"></script>
</body>
</html>

<?php } ?>