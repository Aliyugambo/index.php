<?php
include "config/connect.php";
include "config/functions.php";

$error = false;
$username = "";
$password = "";

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db_username = validate($_POST['username']);
    $db_password = md5(validate($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM user WHERE username='$db_username' AND password='$db_password'");
    $num = mysqli_num_rows($select);

    if ($num == 1) {
        $fetch = mysqli_fetch_array($select);

        $_SESSION['sstc_username'] = $fetch['username'];
        $_SESSION['sstc_user_cat'] = $fetch['user_cat'];

        if($fetch['user_cat'] == 'admin') {
            echo "<script>window.location = 'admin/';</script>";
        }elseif($fetch['user_cat'] == 'passenger') {
            echo "<script>window.location = 'passenger/';</script>";
        }
         elseif($fetch['user_cat'] == 'manager') {
            echo "<script>window.location = 'manager/';</script>";
        }
        elseif($fetch['user_cat'] == 'cashier') {
            echo "<script>window.location = 'cashier/';</script>";
        }                      
    } else {
        $error = true;
    }   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AKTS::Online TRIAN Ticketing and Seat Reservation System</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.3.custom.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
		
    <script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
     
    
</head>

<body style="background:lightblue;">
<div id="main-container">
<?php include("config/header.php");?>

<nav class="navbar navbar-default" role="navigation">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><b><span class="glyphicon glyphicon-home"></span> HOME</b></a> </li>      
            </ul>       
        </nav>
<div> 
    
 <div class="body">
<div class="content">
<img src="image/aliy20.jpg" width="500px" height="300px" alt="" style="border: 4px #555 solid; border-radius: 7px;">
</div>

            <div class="login">
            <span class="themecolor"> <h2 class="text-center danger"><i class="fa fa-sign-in"></i> LOGIN</span></h2>

                <center>
                <?php if($error)error('Invalid Username or password') ?>
                <form  method="POST">
                    <label>Username</label>
                    <div class="form-group" <?php echo !empty($unameError)?'error':'';?>>
                        <div class="input-group">
                            <span class=="form-control"><i class=="form-control"></i></span>
                            <input name="username" value="<?=$username?>" required type="text" class="form-control"/>
                        </div>
                    </div>

                    <label>Password</label>
                    <div class="form-group">
                        <div class="input-group">
                            <span class=="form-control"><i class=="form-control"></i></span>
                            <input name="password" value="<?=$password?>" required type="password" class="form-control"/>
                        </div>     

                    </div>

                    <div>
                        <p></p>
                        <button type="submit" name="submit" class="btn btn-submit col-sm-12"><i class="fa fa-sign-in"></i> Login</button><br><br>
                        <p class="center link"><a href="register.php">Not a member? Register</a></p>
                    </div>
                </form>
                </div>         
</div> 
<?php include("config/footer.php");?> 
</div> 
</body>
</html>
