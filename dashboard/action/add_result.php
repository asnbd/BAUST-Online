<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role <= 3){  //Owner or Admin
    if(isset($_POST['resultType'])){
        $resultType = $_POST['resultType'];
        $resultCourse = $_POST['resultCourse'];

        if(!empty($resultType) && !empty($resultCourse)){
            $sql = "INSERT INTO result (type, course) VALUES (
                    '$resultType',
                    '$resultCourse')";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "Result Successfully Added!"];
            } else {
                $_SESSION['message'] = ["error", "Error Adding Result!" . mysqli_error($db_conn)];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Adding Result! <strong>Invalid Information!</strong>"];
        }

        header("location: ../?p=results");
    } else {
        $_SESSION['message'] = ["error", "Error Adding Result!"];
        header("location: ../?p=results");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}