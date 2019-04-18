<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['deptHead'])){
        $dept_head = $_POST['deptHead'];

        if(!empty($dept_head)){
            $sql = "UPDATE department SET head = '$dept_head'";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "Department Head Successfully Updated!"];
            } else {
                $_SESSION['message'] = ["error", "Error Updating Department Head!"];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Updating Department Head! <strong>Invalid Department Head Name!</strong>"];
        }

        header("location: ../?p=departments");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}