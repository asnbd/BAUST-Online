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

        if(!empty($teacher_name) || !empty($teacher_email) || !empty($teacher_address)
            || !empty($teacher_district) || !empty($teacher_phone) || !empty($teacher_gender)
            || !empty($teacher_birthdate) || !empty($teacher_department) || !empty($teacher_designation)){
            $sql = "UPDATE teacher SET
                    name = '$teacher_name',
                    email = '$teacher_email',
                    address = '$teacher_address',
                    district = '$teacher_district',
                    phone = '$teacher_phone',
                    gender = '$teacher_gender',
                    birthdate = '$teacher_birthdate',
                    photo = '$teacher_photo',
                    designation = '$teacher_designation',
                    department = '$teacher_department',
                    WHERE username = '$teacher_username'";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "Teacher Successfully Updated!"];
            } else {
                $_SESSION['message'] = ["error", "Error Updating Teacher!" . mysqli_error($db_conn)];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Updating Teacher! <strong>Invalid Information!</strong>"];
        }

        header("location: ../?p=teachers");
    } else {
        $_SESSION['message'] = ["error", "Error Updating Teacher!"];
        header("location: ../?p=teachers");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}