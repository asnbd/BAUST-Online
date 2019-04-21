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
            (SELECT COUNT(*) FROM student) AS student,
            (SELECT COUNT(*) FROM teacher) AS teacher,
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
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>BAUST Online - Dashboard</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top">

<?php include "includes/header.php" ?>

<div id="wrapper">

    <!-- Sidebar -->
    <?php $active_page = "dashboard"; include "includes/sidebar.php"; ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Overview</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">
                <?php if($login_role <= 3){ ?>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5"><?php echo $message_count == 0 ? "No ":$message_count; ?> New Message<?php if($message_count > 1) echo 's'?>!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <?php }?>

                <?php if($login_role <= 3){ ?>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5"><?php echo $dept_count ?> Department<?php if($dept_count > 1) echo 's'?></div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="?p=departments">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>
                <?php }?>

                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-user-tie"></i>
                            </div>
                            <div class="mr-5"><?php echo $teacher_count ?> Teacher<?php if($teacher_count > 1) echo 's'?></div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-users"></i>
                            </div>
                            <div class="mr-5"><?php echo $student_count ?> Student<?php if($student_count > 1) echo 's'?></div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="?p=students">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php include "includes/footer.php" ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal">
                    <span>×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="../logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
<div>

</div>
<!-- JQuery & Bootstrap JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Main JavaScript-->
<script src="js/script.min.js"></script>


</body>

</html>
