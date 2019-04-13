<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 02-Apr-19
 * Time: 2:59 AM
 */

require_once('includes/db.php');
include('includes/session.php');


$sql = "SELECT username, name, email, address, phone FROM users WHERE username='$login_session'";
$result = mysqli_query($db_conn, $sql);

$user_data = mysqli_fetch_assoc($result);

mysqli_close($db_conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>BAUST Online</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>

<body>

<?php $active_page = 'profile'; include('includes/header.php'); ?>

<br>
<br>
<br>
<br>
<br>




<div class="content">
    <h1>Profile</h1>
    <div id="profile">
        <b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b><br><br>
        Name : <i><?php echo $user_data['name']; ?></i><br>
        Email : <i><?php echo $user_data['email']; ?></i><br>
        Address : <i><?php echo $user_data['address']; ?></i><br>
        Phone : <i><?php echo $user_data['phone']; ?></i><br><br>
        <b id="logout"><a href="logout.php">Log Out</a></b>
    </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php include('includes/footer.php'); ?>

</body>

</html>


</html>
