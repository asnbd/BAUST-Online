<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['deptID'])){
        $dept_id = $_POST['deptID'];
        $dept_name = $_POST['deptName'];
        $dept_head = $_POST['deptHead'];
        $dept_desc = $_POST['deptDesc'];

        if(!empty($dept_id) || !empty($dept_name) || !empty($dept_head)){
            $sql = "UPDATE department SET name = '$dept_name', description = '$dept_desc', head = '$dept_head' WHERE id = '$dept_id'";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "Department Successfully Updated!"];
            } else {
                $_SESSION['message'] = ["error", "Error Updating Department!" . mysqli_error($db_conn)];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Updating Department! <strong>Invalid Information!</strong>"];
        }

        header("location: ../?p=departments");
    } else {
        $_SESSION['message'] = ["error", "Error Updating Department!" . mysqli_error($db_conn)];
        header("location: ../?p=departments");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}