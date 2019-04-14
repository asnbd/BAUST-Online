<?php
require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    if(isset($_POST['departmentName'])){
        echo "SDASDASDASD";
        $dept_name = $_POST['departmentName'];
        $dept_desc = $_POST['departmentDesc'];
        $dept_head = $_POST['departmentHead'];

        $sql = "INSERT INTO department (name, description, head) VALUES('$dept_name', '$dept_desc', '$dept_head')";

        if($result = mysqli_query($db_conn, $sql)){
            echo "Successful";
//            header("location: ../?p=departments");
        } else {
            echo "Error";
        }
    } else {
//        header("location: ../?p=departments");
        echo "Error";
    }
} else {   //Unauthorized
    header("Location: ../");
}
?>