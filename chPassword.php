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
                    <label for="fname">Enter new password:</label>
                    <input type="password" name="new" class="form-control" placeholder="Enter new password" id="new" required="">
                </div>

                <div class="form-group">
                    <label for="fname">Enter confirm password:</label>
                    <input type="password" name="confirm" class="form-control" onchange="matchPassword()" placeholder="Enter confirm password" id="confirm" required="">
                </div>

                <button type="submit" name="psw" value="Send OTP" class="btn btn-primary">Send OTP</button>
        </form> 

        <?php
        if (isset($_POST['psw'])) {
            if (!empty($_SESSION['otpConfirm'])) {

                $con = mysqli_connect("localhost", "root", "", "project");

                if (mysqli_connect_errno()) {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    exit();
                }
                $pass = md5($_POST['new']);
                $e = $_SESSION['email'];

                $res = mysqli_query($con, "update TblUserMaster set Password='$pass' where EmailId='$e'");

                if ($res > 0) {
                    echo "<script>alert('Update sucessful!!')</script>";
                    header("location:login.php");
                } else {
                    echo "<script>alert('Update failed!!')</script>";
                }
                echo "Affected rows: " . mysqli_affected_rows($con);

                mysqli_close($con);
            } else {
                header("location:forget.php");
            }
        }
        ?>

        <?php include 'footer.php'; ?>
    </body>
    <script>
        function matchPassword() {
            var pw1 = document.getElementById("new").value;
            var pw2 = document.getElementById("confirm").value;
            if (pw1 != pw2)
            {
                alert("Passwords did not match");
                document.getElementById("confirm").focus();
                document.getElementById("psw").disabled = true;
                //header("location:forget.php");
            } else {
                document.getElementById("psw").disabled = false;
            }
        }
    </script> 
</html>
<?php ob_flush(); ?>
