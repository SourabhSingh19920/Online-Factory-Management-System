<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
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
                    <label for="fname">Enter email:</label>
                    <input type="text" name="uname" class="form-control" placeholder="Enter email" id="fname" required="">
                </div>

                <button type="submit" name="send" value="Send OTP" class="btn btn-primary">Send OTP</button>
        </form> 

        <?php
        if (isset($_POST["send"])) {
        $email = $_POST["uname"];
        $_SESSION['email']=$email;
//include 'connection.php';
        $con = mysqli_connect("localhost", "root", "", "project");

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            exit();
        }

        //session_start();
        echo $email;
        
            $query = "select * from TblUserMaster where EmailId='$email'";
            $result = mysqli_query($con, $query);
            if ($row = mysqli_fetch_array($result)) {

                if ($row["UserId"] != 0) {
                    $_SESSION["otp"] = rand(1000, 100000);
                    //$_SESSION["remail"]=$email;
                    include('smtp/PHPMailerAutoload.php');

                    function smtp_mailer($to, $subject, $msg) {
                        $mail = new PHPMailer();
                        $mail->SMTPDebug = 3;
                        $mail->IsSMTP();
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'tls';
                        $mail->Host = "smtp.gmail.com";
                        $mail->Port = 587;
                        $mail->IsHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Username = "dummyweb1310@gmail.com";
                        $mail->Password = "dummy@1310";
                        $mail->SetFrom("dummyweb1310@gmail.com");
                        $mail->Subject = "OFPLM Notification";
                        $mail->Body = "Your OTP is :".$_SESSION["otp"];
                        $mail->AddAddress($to);
                        $mail->SMTPOptions = array('ssl' => array(
                                'verify_peer' => false,
                                'verify_peer_name' => false,
                                'allow_self_signed' => false
                        ));
                        if (!$mail->Send()) {
                            //echo $mail->ErrorInfo;
                        } else {
                            //echo 'sent';
                        }
                    }

                    smtp_mailer($email, 'Forget Password', $_SESSION["otp"]);
                    header("location:checkOtp.php");
                    
                } else {
                    //$_SESSION["invaliduser"]="yes"; 
                    echo "<script>alert('Username not available in system!!')</script>";
                    //header("location:forget.php");
                }
            } else {
                //$_SESSION["invaliduser"]="yes";
                echo "<script>alert('Username not available in system!!')</script>";
                //header("location:forget.php");
            }
        }
        ?>

        <?php include 'footer.php'; ?>
    </body>
</html>
<?php ob_flush(); ?>
