<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 02-Apr-19
 * Time: 3:00 AM
 */

session_start();

if(isset($_SESSION['login_user'])) {
    $login_user = $_SESSION['login_user'];

    $sql = "SELECT role FROM users WHERE username='$login_user'";

    $login_role = 0;

    if($result = mysqli_query($db_conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $login_role = $row['role'];
        } else {
            die("Invalid user! Please <a href='../logout.php?r=dashboard'>login again</a>");
        }
    } else {
        die("Error: " . mysqli_error($db_conn) . " SQL: " . $sql);
    }

    mysqli_free_result($result);
} else {
    header('Location: ../login.php?r=dashboard');
}

//if(!isset($login_session)){
//    mysqli_close($db_conn);
//    header('Location: index.php');
//}

?>
