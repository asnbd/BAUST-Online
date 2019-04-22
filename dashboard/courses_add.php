<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 13-Apr-19
 * Time: 10:36 PM
 */

$login_role = 10;
$login_user = NAN;

require_once "../includes/db.php";
include "../includes/session.php";

$message_count = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    $sql = "SELECT COUNT(*) AS message FROM message WHERE msg_to = '$login_user' AND unread = 1";

    if($result = mysqli_query($db_conn, $sql)){
        $row = mysqli_fetch_assoc($result);
        $message_count = $row['message'];
    } else {
        echo mysqli_error($db_conn) . " SQL: " . $sql;
    }

    mysqli_free_result($result);
} else {   //Unauthorized
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
    <?php $active_page = "students"; include "includes/sidebar.php"; ?>

    <?php include "includes/header.php" ?>

    <div class="content">
        <ul class="breadcrumb">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="?p=courses">Courses</a></li>
            <li>Add Course</li>
        </ul>

        <?php
        if(isset($_SESSION['message'])){
            if($_SESSION['message'][0] == 'success'){
                echo '<div class="alert success">
                        <span class="closebtn">&times;</span>
                        ' . $_SESSION['message'][1] . '
                      </div>';
            }

            if($_SESSION['message'][0] == 'info'){
                echo '<div class="alert info">
                        <span class="closebtn">&times;</span>
                        ' . $_SESSION['message'][1] . '
                      </div>';
            }

            if($_SESSION['message'][0] == 'warning'){
                echo '<div class="alert warning">
                        <span class="closebtn">&times;</span>
                        ' . $_SESSION['message'][1] . '
                      </div>';
            }

            if($_SESSION['message'][0] == 'error'){
                echo '<div class="alert danger">
                        <span class="closebtn">&times;</span>
                        ' . $_SESSION['message'][1] . '
                      </div>';
            }

            unset($_SESSION['message']);
        }
        ?>

        <!-- Department Edit -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit"></i> Add Course</div>
            <div class="card-body">
                <p>
                <form class="form-group" name="AddCourse" action="action/add_course.php" method="post" onsubmit="return validateCourseForm()">
                    <div class="row">
                        <div class="col-25">
                            <label for="courseCode">Course Code</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="courseCode" id="courseCode" placeholder="Enter Course Code">
                            <div class="invalid-feedback">
                                * Please enter course code.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="courseTitle">Course Title</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="courseTitle" id="courseTitle" placeholder="Enter Course Title">
                            <div class="invalid-feedback">
                                * Please enter course title.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="courseCredit">Credit</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="courseCredit" id="courseCredit" placeholder="Enter Course Credit">
                            <div class="invalid-feedback">
                                * Please enter course credit.
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-25">
                            <label for="courseDepartment">Department</label>

                        </div>
                        <div class="col-75">
                            <select name="courseDepartment" id="courseDepartment">
                                <option value="" selected>Choose...</option>

                                <?php
                                $sql = "SELECT id, name FROM department";
                                //                            $sql = "SELECT username, name FROM teacher";

                                if($result = mysqli_query($db_conn, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                        }
                                    } else {

                                    }
                                } else {
                                    die("Error: " . mysqli_connect_error($db_conn). " SQL: " . $sql);
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                * Please select a department.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="courseSemester">Semester</label>

                        </div>
                        <div class="col-75">
                            <select name="courseSemester" id="courseSemester">
                                <option value="" selected>Choose...</option>
                                <option value="1">Level 1, Term I</option>
                                <option value="2">Level 1, Term II</option>
                                <option value="3">Level 2, Term I</option>
                                <option value="4">Level 2, Term II</option>
                                <option value="5">Level 3, Term I</option>
                                <option value="6">Level 3, Term II</option>
                                <option value="7">Level 4, Term I</option>
                                <option value="8">Level 4, Term II</option>
                            </select>
                            <div class="invalid-feedback">
                                * Please select a semester.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="courseTeacher">Teacher</label>

                        </div>
                        <div class="col-75">
                            <select name="courseTeacher" id="courseTeacher">
                                <option value="" selected>Choose...</option>
                                <option value="1">Mr 1</option>
                                <option value="2">Mr 2</option>
                                <option value="3">Ms 1</option>
                                <option value="4">Ms 2</option>
                            </select>
                            <div class="invalid-feedback">
                                * Please select teacher.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button type='submit' class='btn btn-primary' style="float: right; margin-top: 15px">Add</button><br>
                    </div>
                </form>
                </p>

            </div>
        </div>



        <!-- Footer -->
        <?php include "includes/footer.php" ?>
    </div>





    <script src="js/scripts.js" type="text/javascript"></script>
    <script src="js/validation.js" type="text/javascript"></script>

</body>

</html>
