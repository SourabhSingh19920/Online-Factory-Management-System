<?php session_start();
 ob_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--<link rel="stylesheet" type="text/css" href="css/login.css">-->
        <style>
            .con{
                margin: 30px;
            }
        </style>
    </head>
    <body>


        <?php include 'header.php'; ?>

        <h1>Forget Password</h1>

        <form action="#" method="post">
            <div class="container con">

                <div class="form-group">
                    <label for="fname">Enter OTP:</label>
                    <input type="text" name="checkOtp" class="form-control" placeholder="Enter OTP" id="fname" required="">
                </div>

                <button type="submit" name="otp" value="Send OTP" class="btn btn-primary">Send OTP</button>
        </form> 

        <?php
        if (isset($_POST['otp'])) {
            if ($_SESSION['otp'] == $_POST['checkOtp']) {
                $_SESSION['otpConfirm'] = "yes";
                header("location:chPassword.php");
            } else {
                echo "<script>alert('Enter Correct Otp!!')</script>";
                //header("location:forget.php");
            }
        }
        ?>


        <?php include 'footer.php'; ?>
    </body>
</html>
<?phpob_flush();?>