<?php
$login_role = 10;
$login_user = NAN;

require_once "../../includes/db.php";
include "../../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    $sql = "INSERT INTO result_marks(result_id, student_id, mark) VALUES";
    if(isset($_POST['ids'])){
        $id = $_POST['rid'];
        if(isset($_POST["ids"]) && is_array($_POST["ids"])){
            foreach ($_POST["ids"] as $key => $text){
                $sql .= "(" . $id . ", '" . $text . "', '" . $_POST["marks"][$key] . "')";
                if (next($_POST["ids"])==true) $sql .= ", ";
            }

            echo $sql;

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "Result Successfully Added!"];
            } else {
                $_SESSION['message'] = ["error", "Error Adding Result!" . mysqli_error($db_conn)];
            }

            header("location: ../?p=results");
        } else {
            $_SESSION['message'] = ["error", "Error Adding Result!"];
            header("location: ../?p=results");
        }
    }

} else {   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}