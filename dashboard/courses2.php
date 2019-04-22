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

    if(isset($_POST['deptName'])){
        $dept_name = $_POST['deptName'];
        $dept_desc = $_POST['deptDesc'];

        if(!empty($dept_name)){
            $sql = "INSERT INTO department (name, description) VALUES('$dept_name', '$dept_desc')";

            if($result = mysqli_query($db_conn, $sql)){
                $_SESSION['message'] = ["success", "Department Add Success!"];
            } else {
                $_SESSION['message'] = ["error", "Error Adding Department!"];
            }
        } else {
            $_SESSION['message'] = ["error", "Error Adding Department! <strong>Invalid Department Name!</strong>"];
        }
    }
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
    <?php $active_page = "courses"; include "includes/sidebar.php"; ?>

    <?php include "includes/header.php" ?>

    <div class="content">
        <ul class="breadcrumb">
            <li><a href="index.php">Dashboard</a></li>
            <li>Courses</li>
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

        <!-- Course Table -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table"></i> Courses</div>
            <div class="card-body">
                <p>
                <div class="row">
                    <div class="col-25">
                        <a href="?p=add_course"><button type='button' class='btn btn-primary'>Add Course</button><br></a>
                    </div>
                    <div class="col-75">
                        <div class="f-right">
                            <form name="SearchStudent" action="" method="get">
                                <input type="hidden" name="p" value="students">
                                <select name="dept" id="dept">
                                    <option value="" <?php if(isset($_GET['dept']) && $_GET['dept'] == "") echo 'selected' ?>>All Department</option>
                                    <?php
                                    $sql = "SELECT id, name FROM department";

                                    if($result = mysqli_query($db_conn, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                if(isset($_GET['dept']) && $_GET['dept'] == $row['id']){
                                                    echo "<option value='" . $row['id'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                                }

                                            }
                                        } else {

                                        }
                                    } else {
                                        die("Error: " . mysqli_connect_error($db_conn). " SQL: " . $sql);
                                    }
                                    ?>
                                </select>

                                <select name="semester" id="semester">
                                    <option <?php if(isset($_GET['semester']) && $_GET['semester'] == "") echo "selected" ?>  value="">All Semester</option>
                                    <option <?php if(isset($_GET['semester']) && $_GET['semester'] == "1") echo "selected" ?> value="1">Level 1, Term I</option>
                                    <option <?php if(isset($_GET['semester']) && $_GET['semester'] == "2") echo "selected" ?> value="2">Level 1, Term II</option>
                                    <option <?php if(isset($_GET['semester']) && $_GET['semester'] == "3") echo "selected" ?> value="3">Level 2, Term I</option>
                                    <option <?php if(isset($_GET['semester']) && $_GET['semester'] == "4") echo "selected" ?> value="4">Level 2, Term II</option>
                                    <option <?php if(isset($_GET['semester']) && $_GET['semester'] == "5") echo "selected" ?> value="5">Level 3, Term I</option>
                                    <option <?php if(isset($_GET['semester']) && $_GET['semester'] == "6") echo "selected" ?> value="6">Level 3, Term II</option>
                                    <option <?php if(isset($_GET['semester']) && $_GET['semester'] == "7") echo "selected" ?> value="7">Level 4, Term I</option>
                                    <option <?php if(isset($_GET['semester']) && $_GET['semester'] == "8") echo "selected" ?> value="8">Level 4, Term II</option>
                                </select>

                                <input type="text" style="min-width: 120px; width: 20%" name="search" placeholder="Search For..." value="<?php if(isset($_GET['search'])) echo $_GET['search'] ?>">

                                <button type='submit' class='btn btn-primary'>Search</button><br>
                                <div id="invalid-dept" class="invalid-feedback">
                                    * Please enter Search Text.
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                </p>


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <!--                                <th width='15px'>#</th>-->
                        <th>Code</th>
                        <th>Title</th>
                        <th>Credit</th>
                        <th>Department</th>
                        <th>Semester</th>
                        <th>Teacher</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT course.code, course.title, course.credit, course.department, course.semester, course.teacher, teacher.name AS teacher_name, department.name AS dept_name
                            FROM course
                            LEFT JOIN teacher ON course.teacher = teacher.username
                            LEFT JOIN department ON department.id = teacher.department";
                    if($result = mysqli_query($db_conn, $sql)){
                        while ($row = mysqli_fetch_assoc($result)){
//                            $head = $row['head'] == ""?"<button type='button' class='btn btn-sm btn-primary' onclick='assignDept(". $row['id'] . ")'>Assign</button>":$row['head'];
    //                                        <td style='text-align: center; vertical-align: middle'><input onclick='toggleSelect(this)' type='checkbox'></td>
                            echo "<tr>
                                            <td>" . $row['code'] . "</td>
                                            <td>" . $row['title'] . "</td>
                                            <td>" . $row['credit'] . "</td>
                                            <td>" . $row['dept_name'] . "</td>
                                            <td>" . $row['semester'] . "</td>
                                            <td>" . $row['teacher_name'] . "</td>
                                            
                                            <td> <a href='?p=edit_dept&id=". $row['id'] ."'><button type='button' class='btn btn-success btn-sm'>Edit</button></a>
                                            <button type='button' class='btn btn-danger btn-sm' onclick='deleteDept(" . $row['id'] . ", \"" . $row['name'] . "\")'>Delete</button>" . "</td>
                                        </tr>";
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
            <!--                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
        </div>



        <!-- Footer -->
        <?php include "includes/footer.php" ?>
    </div>

    <!-- Delete Department Modal -->
    <div id="deleteDeptModel" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="deleteDeptModalDisplay('none')">&times;</span>
                <h2>Delete Department</h2>
            </div>
            <div class="modal-body">
                <p>Select "Delete" below if you want to delete <strong id="dept_name_text">the selected</strong> department.</p>
            </div>
            <div class="modal-footer">
                <form name="DeleteDept" action="action/delete_dept.php" method="post">
                    <input name="dept_id" type="hidden">
                    <input name="dept_name" type="hidden">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                <button class="btn btn-secondary" type="button" onclick="deleteDeptModalDisplay('none')">Cancel</button>
            </div>
        </div>
    </div>

    <!-- Assign Department Head Modal -->
    <div id="assignDeptHeadModel" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="modalDisplay('assignDeptHeadModel', 'none')">&times;</span>
                <h2>Assign Department Head</h2>
            </div>
            <div class="modal-body">
                <p>
                    <form name="AssignDepartmentHead" action="action/assign_dept_head.php" method="post" onsubmit="return validateDeptHeadForm()">
                        <label for="departmentHead">Department Head</label>
                        <br><br>
                        <select name="deptHead" id="departmentHead">
                            <option value="" selected>Choose...</option>
                            <?php
                            $sql = "SELECT username, name FROM teacher WHERE username NOT IN (SELECT head FROM department)";
                            //                            $sql = "SELECT username, name FROM teacher";

                            if($result = mysqli_query($db_conn, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "<option value='" . $row['username'] . "'>" . $row['name'] . "</option>";
                                    }
                                } else {

                                }
                            } else {
                                die("Error: " . mysqli_connect_error($db_conn). " SQL: " . $sql);
                            }
                            ?>
                        </select>
                        <div id="invalid-dept-head" class="invalid-feedback">
                            * Please select a department head.
                        </div>
                        <br><br>
                        <input name="deptID" type="hidden">
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </form>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" onclick="modalDisplay('assignDeptHeadModel', 'none')">Cancel</button>
            </div>
        </div>
    </div>

    <script src="js/scripts.js" type="text/javascript"></script>
    <script src="js/validation.js" type="text/javascript"></script>

</body>

</html>
