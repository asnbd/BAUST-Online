<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 13-Apr-19
 * Time: 9:45 PM
 */

require_once "../includes/db.php";
include "../includes/session.php";

$teacher_count = NAN;
$student_count = NAN;
$dept_count = NAN;
$course_count = NAN;
$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    $sql = "SELECT
            (SELECT COUNT(*) FROM department) AS dept,
            (SELECT COUNT(*) FROM course) AS course,
            (SELECT COUNT(*) FROM student WHERE active = 1) AS student,
            (SELECT COUNT(*) FROM teacher WHERE active = 1) AS teacher,
            (SELECT COUNT(*) FROM message WHERE msg_to = '$login_user' AND unread = 1) AS message
            FROM DUAL";

    if($result = mysqli_query($db_conn, $sql)){
        $row = mysqli_fetch_assoc($result);
        $dept_count = $row['dept'];
        $course_count = $row['course'];
        $student_count = $row['student'];
        $teacher_count = $row['teacher'];
        $message_count = $row['message'];
    } else {
        echo mysqli_error($db_conn) . " SQL: " . $sql;
    }
} else if ($login_role == 2){   //Teacher

} else if ($login_role == 3){   // Student

} else if($login_role == 10){   //Unauthorized
    die("<title>Unauthorized | BAUST Online</title>
        <h1>Unauthorized</h1><hr>
        <h2>You don't have permission to view this page.</h2>");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BAUST Online - Dashboard</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>

<!--Header-->
<?php include "includes/header.php" ?>

<!-- Sidebar -->
<?php $active_page = "dashboard"; include "includes/sidebar.php"; ?>

<div class="content">
    <ul class="breadcrumb">
        <li><a href="#">Dashboard</a></li>
        <li>Overview</li>
    </ul>

    <div class="alert">
        <span class="closebtn">&times;</span>
        <strong>Welcome!</strong> to BAUST Online Dashboard
    </div>

    <div class="row">
        <?php if($login_role <= 3){ ?>
        <a href="?p=departments">
            <div class="column bg-blue">
                <i class="right_icon fas fa-list fa-fw"></i>
                <div class="big_text"><?php echo $dept_count ?></div>
                <p>Department<?php if($dept_count > 1) echo 's'?></p>
            </div>
        </a>
        <?php }?>

        <?php if($login_role <= 3){ ?>
        <a href="?p=teachers">
            <div class="column bg-orange">
                <i class="right_icon fas fa-chalkboard-teacher fa-fw"></i>
                <div class="big_text"><?php echo $teacher_count ?></div>
                <p>Teacher<?php if($teacher_count > 1) echo 's'?></p>
            </div>
        </a>
        <?php }?>

        <a href="?p=students">
            <div class="column bg-green">
                <i class="right_icon fas fa-users fa-fw"></i>
                <div class="big_text"><?php echo $student_count ?></div>
                <p>Student<?php if($student_count > 1) echo 's'?></p>
            </div>
        </a>

        <a href="?p=admins">
            <div class="column bg-red">
                <i class="right_icon fas fa-user-cog fa-fw"></i>
                <div class="big_text">0</div>
                <p>Admins</p>
            </div>
        </a>
    </div>

    <div class="row">


    </div>

    <!-- Sticky Footer -->
    <?php include "includes/footer.php" ?>
</div>

<script src="js/scripts.js" type="text/javascript"></script>

</body>

</html>
