<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['dept_id'])){
        $dept_id = $_POST['dept_id'];
        $dept_name = $_POST['dept_name'];

        if(!empty($dept_id)){
            $sql = "DELETE FROM department WHERE id = '$dept_id'";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "<strong>" . $dept_name . "</strong> Department Successfully Deleted!"];
            } else {
                $_SESSION['message'] = ["error", "Error Deleting Department!"];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Deleting Department! <strong>Invalid Department ID!</strong>"];
        }

        header("location: ../?p=departments");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}