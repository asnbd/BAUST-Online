<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['teacherUsername'])){
        $teacher_username = $_POST['teacherUsername'];
        $teacher_name = $_POST['teacherName'];
        $teacher_email = $_POST['teacherEmail'];
        $teacher_address = $_POST['teacherAddress'];
        $teacher_district = $_POST['teacherDistrict'];
        $teacher_phone = $_POST['teacherPhone'];
        $teacher_gender = $_POST['teacherGender'];
        $teacher_birthdate = $_POST['teacherBirthdate'];
        $teacher_photo = $_POST['teacherPhoto'];
        $teacher_designation = $_POST['teacherDesignation'];
        $teacher_department = $_POST['teacherDepartment'];

        if(!empty($teacher_username) || !empty($teacher_name) || !empty($teacher_email) || !empty($teacher_address)
            || !empty($teacher_district) || !empty($teacher_phone) || !empty($teacher_gender)
            || !empty($teacher_birthdate) || !empty($teacher_department) || !empty($teacher_designation)){
            $sql = "INSERT INTO teacher (username, name, email, address, district, phone, gender, birthdate, photo, designation, department, active) VALUES (
                    '$teacher_username',
                    '$teacher_name',
                    '$teacher_email',
                    '$teacher_address',
                    '$teacher_district',
                    '$teacher_phone',
                    '$teacher_gender',
                    '$teacher_birthdate',
                    '$teacher_photo',
                    '$teacher_designation',
                    '$teacher_department',
                    1)";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "Teacher Successfully Added!"];
            } else {
                $_SESSION['message'] = ["error", "Error Adding Teacher!" . mysqli_error($db_conn)];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Adding Teacher! <strong>Invalid Information!</strong>"];
        }

        header("location: ../?p=teachers");
    } else {
        $_SESSION['message'] = ["error", "Error Adding Teacher!"];
        header("location: ../?p=teachers");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}