<!DOCTYPE html>
<html>

<head>
    <title>Login | BAUST Online</title>

    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>

<?php
    session_start();

    if(isset($_SESSION['login_user'])){
        header("location: dashboard");
    }

    require_once('includes/db.php');

    $show_msg = "NONE";

    if(isset($_POST['submit'])){
        $username = $_POST['userid'];
        $password = $_POST['password'];
//
//        $username = mysqli_real_escape_string($username);
//        $password = mysqli_real_escape_string($password);

        $password_enc = md5($password);

        $sql = "SELECT username, password FROM users WHERE username = '$username' AND password = '$password'";

        $result = mysqli_query($db_conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $show_msg = "SUCCESS";
            $_SESSION['login_user'] = $username;
            header("location: dashboard");
        } else {
            $show_msg = "ERROR";
        }
    }

?>

<body>

    <?php $active_page = 'login'; include('includes/header.php'); ?>

    <div class="container">
        <?php if($show_msg == "SUCCESS"){ ?>
            <div id="reg_msg" class="reg_message">
                <p>Login success!</p>
            </div>
        <?php } else if($show_msg == "ERROR"){ ?>

            <div id="reg_msg_err" class="reg_message error">
                <p>Invalid User ID or Password. Please try again.</p>
            </div>
        <?php } ?>

        <div class="login-box">
            <center><img src="img/avatar.png" class="avatar"></center>
            <h1>Login Here</h1>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <p>User ID</p>
                <input type="text" name="userid" placeholder="Enter User ID" required>
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter Password" required>
                <input type="submit" name="submit" value="Login">
                <a href="#">Forget Password</a>
            </form>

        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>

</html>
