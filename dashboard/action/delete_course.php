<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['course_code'])){
        $course_code = $_POST['course_code'];
        $course_title = $_POST['course_title'];

        if(!empty($course_code)){
            $sql = "DELETE FROM course WHERE code = '$course_code'";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "<strong>" . $course_code . "</strong> Course Successfully Deleted!"];
            } else {
                $_SESSION['message'] = ["error", "Error Deleting Course!"];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Deleting Course! <strong>Invalid Course ID!</strong>"];
        }

        header("location: ../?p=courses");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}