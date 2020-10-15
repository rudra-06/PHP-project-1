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

        $msg_from_admin = 
        '
        
        <!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
        <meta name="x-apple-disable-message-reformatting">
        <title></title> 
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">

        <style>
            html,body {
                margin: 0 auto !important;
                padding: 0 !important;
                height: 100% !important;
                width: 100% !important;
                background: #f1f1f1;
            }

            * {
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
            }

            div[style*="margin: 16px 0"] {
                margin: 0 !important;
            }

            table,
            td {
                mso-table-lspace: 0pt !important;
                mso-table-rspace: 0pt !important;
            }

            table {
                border-spacing: 0 !important;
                border-collapse: collapse !important;
                table-layout: fixed !important;
                margin: 0 auto !important;
            }

            img {
                -ms-interpolation-mode:bicubic;
            }

            a {
                text-decoration: none;
            }

            *[x-apple-data-detectors],
            .unstyle-auto-detected-links *,
            .aBn {
                border-bottom: 0 !important;
                cursor: default !important;
                color: inherit !important;
                text-decoration: none !important;
                font-size: inherit !important;
                font-family: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
            }

            .a6S {
                display: none !important;
                opacity: 0.01 !important;
            }

            .im {
                color: inherit !important;
            }

            img.g-img + div {
                display: none !important;
            }

            @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
                u ~ div .email-container {
                    min-width: 320px !important;
                }
            }

            @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                u ~ div .email-container {
                    min-width: 375px !important;
                }
            }

            @media only screen and (min-device-width: 414px) {
                u ~ div .email-container {
                    min-width: 414px !important;
                }
            }

        </style>

        <style>

            .primary{
                background: #17bebb;
            }
            .bg_white{
                background: #ffffff;
            }
            .bg_light{
                background: #f7fafa;
            }
            .bg_black{
                background: #000000;
            }
            .bg_dark{
                background: rgba(0,0,0,.8);
            }
            .email-section{
                padding:2.5em;
            }

            .btn{
                padding: 10px 15px;
                display: inline-block;
            }
            .btn.btn-primary{
                border-radius: 5px;
                background: #17bebb;
                color: #ffffff;
            }
            .btn.btn-white{
                border-radius: 5px;
                background: #ffffff;
                color: #000000;
            }
            .btn.btn-white-outline{
                border-radius: 5px;
                background: transparent;
                border: 1px solid #fff;
                color: #fff;
            }
            .btn.btn-black-outline{
                border-radius: 0px;
                background: transparent;
                border: 2px solid #000;
                color: #000;
                font-weight: 700;
            }
            .btn-custom{
                color: rgba(0,0,0,.3);
                text-decoration: underline;
            }

            h1,h2,h3,h4,h5,h6{
                font-family: "Poppins", sans-serif;
                color: #000000;
                margin-top: 0;
                font-weight: 400;
            }
            
            body{
                font-family: "Poppins", sans-serif;
                font-weight: 400;
                font-size: 15px;
                line-height: 1.8;
                color: rgba(0,0,0,.4);
            }
            
            a{
                color: #17bebb;
            }

            .logo h1 a{
                color: #17bebb;
                font-size: 24px;
                font-weight: 700;
                font-family: "Poppins", sans-serif;
            }
            
            /*HERO*/
            .hero{
                position: relative;
                z-index: 0;
            }
            
            .hero .text{
                color: rgba(0,0,0,.3);
            }
            .hero .text h2{
                color: #000;
                font-size: 34px;
                margin-bottom: 0;
                font-weight: 200;
                line-height: 1.4;
            }
            .hero .text h3{
                font-size: 24px;
                font-weight: 300;
            }
            .hero .text h2 span{
                font-weight: 600;
                color: #000;
            }
            
            .text-author{
                bordeR: 1px solid rgba(0,0,0,.05);
                max-width: 50%;
                margin: 0 auto;
                padding: 2em;
            }
            .text-author img{
                border-radius: 50%;
                padding-bottom: 20px;
            }
            .text-author h3{
                margin-bottom: 0;
            }
            ul.social li{
                display: inline-block;
                margin-right: 10px;
            }
            
            /*FOOTER*/
            
            .footer{
                border-top: 1px solid rgba(0,0,0,.05);
                color: rgba(0,0,0,.5);
            }
            .footer .heading{
                color: #000;
                font-size: 20px;
            }
            .footer ul{
                margin: 0;
                padding: 0;
            }
            .footer ul li{
                list-style: none;
                margin-bottom: 10px;
            }
            .footer ul li a{
                color: rgba(0,0,0,1);
            }
        
        </style>
        </head>
        
        <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
            <center style="width: 100%; background-color: #f1f1f1;">
            <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
                &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
            </div>
            <div style="max-width: 600px; margin: 0 auto;" class="email-container">

            <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                <tr>
                <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo" style="text-align: center;">
                                <h1><a href="#">B.K.Jewellers</a></h1>
                            </td>
                        </tr>
                    </table>
                </td>
                </tr>
                <tr>
                <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
            		<td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
            			<div class="text">
            				<h2>Thank You, "'.$sender_name.'" we will get in touch with you soon.</h2>
            			</div>
            		</td>
                </tr>
                <tr>
			          <td style="text-align: center;">
			          	<div class="text-author">
				          	<img src="images/test.jpg" alt="" style="width: 100px; max-width: 600px; height: auto; margin: auto; display: block;">
				          	<h3 class="name">Rudra Soni</h3>
				          	<span class="position">CEO, Co-founder of B.K.jewellers</span>
			           	</div>
			          </td>
			        </tr>
                    </table>
                </td>
                </tr>
                </table>
                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                    <tr>
                    <td valign="middle" class="bg_light footer email-section">
                        <table>
                            <tr>
                            <td valign="top" width="33.333%" style="padding-top: 20px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                <td style="text-align: left; padding-right: 10px;">
                                    <h3 class="heading">About</h3>
                                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                                </td>
                                </tr>
                            </table>
                            </td>
                            <td valign="top" width="33.333%" style="padding-top: 20px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                <tr>
                                <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
                                    <h3 class="heading">Contact Info</h3>
                                <ul>
                                <li><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                                <li><span class="text">+2 392 3929 210</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
            </table>

            </div>
        </center>
        </body>
        </html>

        ';

        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        mail($to, $subject, $msg_to_admin);
        mail($sender_email, $subject, $msg_from_admin, implode("\r\n", $headers));

        if(mail($to, $subject, $msg_to_admin)){
            echo "<script type='text/javascript'>alert('Your mail was sent Successfully.')</script>";
        }


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

                <li class="nav-item">
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
                <input type="text" name="sender_name" class="form-control" id="sender_name" required>
                <span class="text-danger" id="sender_nameErr"></span>
            </div>

            <div class="form-group">
                <label for="sender_email">Your Email:</label>
                <input type="email" name="sender_email" class="form-control" id="sender_email" required>
                <span class="text-danger" id="sender_emailErr"></span>
            </div>

            <div class="form-group">
                <label for="mail_sub">Subject:</label>
                <input type="text" name="mail_sub" class="form-control" id="mail_sub" required>
                <span class="text-danger" id="mail_subErr"></span>
            </div>

            <div class="form-group">
                <label for="mail_msg">Message:</label>
                <input type="text" name="mail_msg" class="form-control" id="mail_msg" required>
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