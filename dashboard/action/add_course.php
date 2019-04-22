<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['courseCode'])){
        $courseCode = $_POST['courseCode'];
        $courseTitle = $_POST['courseTitle'];
        $courseCredit = $_POST['courseCredit'];
        $courseDepartment = $_POST['courseDepartment'];
        $courseSemester = $_POST['courseSemester'];
        $courseTeacher = $_POST['courseTeacher'];

        if(!empty($courseCode) && !empty($courseTitle) && !empty($courseCredit) && !empty($courseDepartment)
            && !empty($courseSemester) && !empty($courseTeacher)){
            $sql = "INSERT INTO course (code, title, credit, department, semester, teacher) VALUES (
                    '$courseCode',
                    '$courseTitle',
                    '$courseCredit',
                    '$courseDepartment',
                    '$courseSemester',
                    '$courseTeacher')";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "Course Successfully Added!"];
            } else {
                $_SESSION['message'] = ["error", "Error Adding Course!" . mysqli_error($db_conn)];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Adding Course! <strong>Invalid Information!</strong>"];
        }

        header("location: ../?p=courses");
    } else {
        $_SESSION['message'] = ["error", "Error Adding Course!"];
        header("location: ../?p=courses");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}