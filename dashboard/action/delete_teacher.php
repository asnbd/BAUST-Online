<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['teacher_id'])){
        $teacher_id = $_POST['teacher_id'];
        $teacher_name = $_POST['teacher_name'];

        if(!empty($teacher_id)){
            $sql = "UPDATE teacher SET active = 0 WHERE username = '$teacher_id'";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "<strong>" . $teacher_name . "</strong> Successfully Deleted!"];
            } else {
                $_SESSION['message'] = ["error", "Error Deleting Teacher!"];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Deleting Teacher! <strong>Invalid Teacher ID!</strong>"];
        }

        header("location: ../?p=teachers");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}