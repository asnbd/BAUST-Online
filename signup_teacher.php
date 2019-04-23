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

function password_generate($chars)
{
    $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($data), 0, $chars);
}

if(isset($_POST['submit'])) {
    $userName = $_POST['userName'];

    $sql = "SELECT username FROM users WHERE email = '$userName'";

    if ($result = mysqli_query($db_conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            $show_msg = "EXISTS";
        } else {
            $sql = "SELECT username, name, email FROM teacher WHERE email = '$userName'";

            if ($result = mysqli_query($db_conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);

                    $username = $row['username'];
                    $email = $row['email'];
                    $password = password_generate(8);

                    echo "<script>alert('This is your temporary user: " . $username . " & password: " . $password . "')</script>";

                    $sql = "INSERT INTO users (username, email, password, role) VALUES('$username', '$email', '$password', 2)";

                    $execute = mysqli_query($db_conn, $sql);

                    if ($execute) {
                        $show_msg = "SUCCESS";
                    } else {
                        $show_msg = "ERROR";
                    }
                } else {
                    $show_msg = "NOTFOUND";
                }
            }
        }
    }
}

mysqli_close($db_conn);
?>


<body>
    <?php $active_page = 'signup'; include('includes/header.php'); ?>

    <div class="container">
        <?php if($show_msg == "EXISTS"){ ?>
        <div id="reg_msg_err" class="reg_message error">
            <p>User already exists. Click <a href="login.php">here</a> to login </p>
        </div>

        <?php }?>

        <?php if($show_msg == "NOTFOUND"){ ?>
            <div id="reg_msg_err" class="reg_message error">
                <p>Teacher doesn't exists in database.</p>
            </div>

        <?php }?>

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
				<p>Username</p>
                <input type="text" name="userName" placeholder="Enter Username" required>
                <input type="submit" name="submit" value="Sign Up">
            </form>

        </div>
    </div>

    <?php include('includes/footer.php'); ?>

</body>

</html>
