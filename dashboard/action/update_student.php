<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['studentID'])){
        $student_id = $_POST['studentID'];
        $student_name = $_POST['studentName'];
        $student_email = $_POST['studentEmail'];
        $student_address = $_POST['studentAddress'];
        $student_district = $_POST['studentDistrict'];
        $student_phone = $_POST['studentPhone'];
        $student_gender = $_POST['studentGender'];
        $student_birthdate = $_POST['studentBirthdate'];
        $student_photo = $_POST['studentPhoto'];
        $student_semester = $_POST['studentSemester'];
        $student_department = $_POST['studentDepartment'];

        if(!empty($student_name) || !empty($student_email) || !empty($student_address)
            || !empty($student_district) || !empty($student_phone) || !empty($student_gender)
            || !empty($student_birthdate) || !empty($student_department) || !empty($student_semester)){
            $sql = "UPDATE student SET
                    name = '$student_name',
                    email = '$student_email',
                    address = '$student_address',
                    district = '$student_district',
                    phone = '$student_phone',
                    gender = '$student_gender',
                    birthdate = '$student_birthdate',
                    photo = '$student_photo',
                    semester = '$student_semester',
                    department = '$student_department'
                    WHERE student_id = '$student_id'";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "Student Successfully Updated!"];
            } else {
                $_SESSION['message'] = ["error", "Error Updating Student! DB Error: " . mysqli_error($db_conn)];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Updating Student! <strong>Invalid Information!</strong>"];
        }

        header("location: ../?p=students");
    } else {
        $_SESSION['message'] = ["error", "Error Updating Student!"];
        header("location: ../?p=students");
    }
} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}