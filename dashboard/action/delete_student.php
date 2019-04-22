<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['student_id'])){
        $student_id = $_POST['student_id'];
        $student_name = $_POST['student_name'];

        if(!empty($student_id)){
            $sql = "UPDATE student SET active = 0 WHERE student_id = '$student_id'";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "<strong>" . $student_name . "</strong> Successfully Deleted!"];
            } else {
                $_SESSION['message'] = ["error", "Error Deleting Student!"];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Deleting Student! <strong>Invalid Student ID!</strong>"];
        }

        header("location: ../?p=students");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}