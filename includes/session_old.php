<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 02-Apr-19
 * Time: 3:00 AM
 */

require_once('db.php');

session_start();

if(isset($_SESSION['login_user'])) {
    $user_check = $_SESSION['login_user'];

    $sql = "SELECT username, name FROM users WHERE username='$user_check'";
    $ses_sql = mysqli_query($db_conn, $sql);

    $row = mysqli_fetch_assoc($ses_sql);

    $login_session = $row['username'];
    $login_name = $row['name'];

    //if(!isset($login_session)){
    //    mysqli_close($db_conn);
    //    header('Location: index.php');
    //}
}
?>
