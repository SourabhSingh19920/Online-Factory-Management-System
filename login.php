<?php ob_start(); session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>login</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <?php
        
            if(isset($_SESSION['loggedUser']))
            {
                empty($_SESSION['loggedUser']);
                session_destroy();  
            }
        ?>
        <!-- Button to open the modal login form -->
        <?php include './header.php'; ?>
        <!-- Modal Content -->
        <form class="modal-content " method="post" action="<?php echo $_SERVER["PHP_SELF"] ?>">

            <div class="imgcontainer">
                <center><img src="img/user.png" width="200px" height="200px" alt="Avatar" class="avatar"></center>
            </div>

            <div class="container">

                <div class="form-group">
                    <label for="state">Username</label>
                    <input type="email" pattern="^[A-Za-z0-9._%+-]+@(?:[A-Za-z0-9-]+\.)+[A-Za-z]{2,}$" name="uname" class="form-control inp" placeholder="Enter username" id="uname" required="">
                </div>

                <div class="form-group">
                    <label for="state">Password</label>
                    <input type="password" name="pass" class="form-control inp" placeholder="Enter password" id="uname" required="">
                </div>

                <button type="submit" name="login" value="submit" class="btn btn-outline-success">Login</button>
                <input type="reset" class="btn btn-outline-danger"  />

            </div>

            <div class="container " style="background-color:#f1f1f1; padding-top: 20px; padding-bottom: 20px; margin-top: 20px; margin-bottom: 30px;">
                <span class="psw">Forgot <a href="forget.php">password?</a></span>
            </div>
        </form>
        <?php include './footer.php'; ?>

        <?php
        if (isset($_POST['login'])) {
            $con = mysqli_connect("localhost", "root", "", "project");

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }

            $uname = $_POST['uname'];
            $pass = md5($_POST['pass']);

            $sql = "select EmailId,Position,UserId from TblUserMaster where EmailId='$uname' and Password='$pass' and DateOfResignation IS NULL";

            if ($result = mysqli_query($con, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $_SESSION['loggedUser'] = $row['EmailId'];
                        $_SESSION['loggedPosition'] = $row['Position'];
                        $_SESSION['loggedUserid'] = $row['UserId'];

                        echo "<script>alert('Loggin Successfull!!')</script>";
                        if($row['Position']=="admin")
                        {
                            header("location:./Admin/adminDashboard.php");
                        }
                        elseif ($row['Position']=="manager") {
                            header("location:./Manager/managerDashboard.php");
                        }
                        elseif ($row['Position']=="agent") {
                            header("location:./Agent/agentDashboard.php");
                        }
                        elseif ($row['Position']=="operator") {
                            header("location:./Operator/operatorDashboard.php");
                        }
                        
                    
                    }
                } else {
                    echo "<script>alert('Loggin Failed!!')</script>";
                }
            }
        }
        ?>

    </body>
</html>

<?php ob_flush(); ?>