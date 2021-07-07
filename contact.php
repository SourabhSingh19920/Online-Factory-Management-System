<?php
include './header.php';
?>


<div class="container">
    <b> <h1>Contact Us</h1></b>
    <h5>We love to hear from you, please drop us a line if you've any query.</h5><br>
    <form method="post" action="#">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><b>First Name</b></label>
                    <input type="text" name="fname" class="form-control" placeholder="Enter Your First Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Last Name</b></label>
                    <input type="text" name="lname" class="form-control" placeholder="Enter Your Last Name">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label><b>Email Address</b></label>
            <input type="email" name="emailaddress" class="form-control" placeholder="Enter Your Email Address">
        </div>
        <div class="form-group">
            <label><b>Message</b></label>
            <textarea class="form-control" rows="8"name="message" placeholder="Enter Your Message Here...."></textarea>
        </div>
        <div style="margin-bottom: 1em">
        <input type="submit" name="submit" value="Submit" class="btn btn-success">
        <input type="reset" name="reset" value="Reset" class="btn btn-primary">
        </div>

    </form>
</div>
<?php
include './footer.php';
?>