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

$semester = [
        1 => "Level 1, Term I",
        2 => "Level 1, Term II",
        3 => "Level 2, Term I",
        4 => "Level 2, Term II",
        5 => "Level 3, Term I",
        6 => "Level 3, Term II",
        7 => "Level 4, Term I",
        8 => "Level 4, Term II"
];

$message_count = NAN;

if($login_role <= 3) {
}
else {   //Unauthorized
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

    <link href="../css/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>

    <!--Header-->
    <?php include "includes/header.php" ?>

    <!-- Sidebar -->
    <?php $active_page = "results"; include "includes/sidebar.php"; ?>

    <?php include "includes/header.php" ?>

    <div class="content">
        <ul class="breadcrumb">
            <li><a href="index.php">Dashboard</a></li>
            <li>Results</li>
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

        <!-- Results Table -->
        <div class="card">
            <div class="card-header"><i class="fas fa-table"></i> Results</div>
            <div class="card-body">
                <div class="data-table-head">

                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <!--                                <th width='15px'>#</th>-->
                        <th>Course</th>
                        <th>Course Title</th>
                        <th>Semester</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($_GET['search'])){
                        $search = $_GET['search'];
                        $dept = isset($_GET['dept'])?$_GET['dept']:"";
                        $semester_p = isset($_GET['semester'])?$_GET['semester']:"";

                        $semester_search = $semester_p == ""?"":"AND (course.semester = '" .$semester_p. "')";
                        $dept_search = $dept == ""?"":"AND (course.department = " .$dept. ")";

                        $sql = "SELECT DISTINCT result.course, course.code, course.title, course.semester FROM result LEFT JOIN course ON result.course = course.id
                            WHERE (course.code LIKE '%$search%'
                            OR course.title LIKE '%$search%'
                            OR result.type LIKE '%$search%')
                            " . $dept_search . $semester_search;

                        if($result = mysqli_query($db_conn, $sql)){
                            if(mysqli_num_rows($result)){
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>
                                            <td>" . $row['code'] . "</td>
                                            <td>" . $row['title'] . "</td>
                                            <td>" . $semester[$row['semester']] . "</td>
                                            
                                            <td> <a href='?p=marks_show&id=". $row['course'] ."'><button type='button' class='btn btn-success btn-sm'>View</button></a>
                                        </tr>";
                                }
                            } else{
                                echo "<tr><td colspan='7'><center>No Courses Found<center></td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'><center>Database Error! ". mysqli_error($db_conn) ."<center></td></tr>";
                        }
                    } else {
                        $sql = "SELECT DISTINCT result.course, course.code, course.title, course.semester FROM result LEFT JOIN course ON result.course = course.id";
                        if($result = mysqli_query($db_conn, $sql)){
                            if(mysqli_num_rows($result)){
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>
                                            <td>" . $row['code'] . "</td>
                                            <td>" . $row['title'] . "</td>
                                            <td>" . $semester[$row['semester']] . "</td>
                                            
                                            <td> <a href='?p=marks_show&id=". $row['course'] ."'><button type='button' class='btn btn-success btn-sm'>View</button></a>
                                        </tr>";
                                }
                            }else {
                                echo "<tr><td colspan='7'><center>No Courses<center></td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'><center>Database Error! ". mysqli_error($db_conn) . "<center></td></tr>";
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>



        <!-- Footer -->
        <?php include "includes/footer.php" ?>
    </div>

    <!-- Delete Course Modal -->
    <div id="deleteCourseModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="modalDisplay('deleteCourseModal', 'none')">&times;</span>
                <h2>Delete Course</h2>
            </div>
            <div class="modal-body">
                <p>Select "Delete" below if you want to delete <strong id="name_text">the selected</strong> course.</p>
            </div>
            <div class="modal-footer">
                <form name="DeleteCourse" action="action/delete_course.php" method="post">
                    <input name="course_code" type="hidden">
                    <input name="course_title" type="hidden">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                <button class="btn btn-secondary" type="button" onclick="modalDisplay('deleteCourseModal', 'none')">Cancel</button>
            </div>
        </div>
    </div>

    <script src="js/scripts.js" type="text/javascript"></script>
    <script src="js/validation.js" type="text/javascript"></script>

</body>

</html>
