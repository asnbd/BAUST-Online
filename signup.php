<!DOCTYPE html>
<html>
<head>
    <title>Signup | BAUST Online</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <script src="js/script.js"></script>
</head>

<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 02-Apr-19
 * Time: 12:53 AM
 */

    require_once('includes/db.php');

    session_start();

    if(isset($_SESSION['login_user'])){
        header("location: profile.php");
    }

$show_msg = "NONE";

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $registration_time = "";

    $password_enc = md5($password);

    $sql = "INSERT INTO users (username, name, email, address, phone, password, registration_time) VALUES('$username', '$name', '$email', '$address', '$phone', '$password_enc', '$registration_time')";

    $execute = mysqli_query($db_conn, $sql);

    if($execute){
        $show_msg = "SUCCESS";
    } else {
        $show_msg = "ERROR";
    }

//    if($execute){
//        echo "Registration Success";
//        header("Location: login.html");
//        ?>
<!--            <script type="text/javascript">document.getElementById('reg_msg').style.display = 'block';</script>-->
<!--        --><?php
//    } else {
//        ?>
<!--        <script type="text/javascript">document.getElementById('reg_msg_err').style.display = 'block';</script>-->
<!--        --><?php
//    }
}

mysqli_close($db_conn);
?>


<body>
    <?php $active_page = 'signup'; include('includes/header.php'); ?>

    <div class="container">
        <?php if($show_msg == "SUCCESS"){ ?>
        <div id="reg_msg" class="reg_message">
            <p>Registration success. Click <a href="login.php">here</a> to login </p>
        </div>
        <?php } else if($show_msg == "ERROR"){ ?>

        <div id="reg_msg_err" class="reg_message error">
            <p>Registration failed. Please try again.</p>
        </div>
        <?php } ?>

        <div class="login-box">
            <!--<center><img src="img/avatar.png" class="avatar"></center>-->
            <center><h1>Sign Up</h1></center>
            <form name="regForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return validateRegForm()">
                <p>Name</p>
                <input type="text" name="name" placeholder="Enter Your name" required>
				<p>User ID</p>
                <input type="text" name="username" placeholder="Enter Username" required>
				<p>Email</p>
                <input type="email" name="email" placeholder="Enter Email Address" required>
				<p>Address</p>
                <input type="text" name="address" placeholder="Enter Address">
				<p>Phone</p>
                <input type="text" name="phone" placeholder="Enter Your Phone Number" required>
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter Password" required>
                <div class="validate_text" id="password_vtext"><strong>* Please enter your password</strong></div><br><br>
				<p>Confirm Password</p>
                <input type="password" name="cpassword" placeholder="Enter Your Password Again" required>
                <div class="validate_text" id="confirm_password_vtext"><strong>* Password does not match</strong></div><br><br>
                <input type="submit" name="submit" value="Sign Up">
                <!--<a href="#">Forget Password</a>-->
            </form>

        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>

</html>
