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
    <?php $active_page = "departments"; include "includes/sidebar.php"; ?>

    <?php include "includes/header.php" ?>

    <div class="content">
        <ul class="breadcrumb">
            <li><a href="#">Dashboard</a></li>
            <li>Departments</li>
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

        <!-- Department Table -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table"></i> Departments</div>
            <div class="card-body">
                <p>
                    <form name="AddDepartment" action="?p=departments" method="post" onsubmit="return validateDeptForm()">
                        <input type="text" style="min-width: 100px; width: 20%" name="deptName" placeholder="Enter Department Name">
                        <input type="text" style="min-width: 100px; width: 50%" name="deptDesc" placeholder="Enter Department Desc">

                        <button type='submit' class='btn btn-primary'>Add Department</button><br>
                        <div id="invalid-dept" class="invalid-feedback">
                            * Please enter department name.
                        </div>
                    </form>
                </p>


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <!--                                <th width='15px'>#</th>-->
                        <th>Dept. Name</th>
                        <th>Description</th>
                        <th>Head</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT department.id, department.name, department.description, teacher.username, teacher.name AS head FROM department LEFT JOIN teacher ON department.head = teacher.username";
                    if($result = mysqli_query($db_conn, $sql)){
                        while ($row = mysqli_fetch_assoc($result)){
                            $head = $row['head'] == ""?"<button type='button' class='btn btn-sm btn-primary' onclick='assignDept(". $row['id'] . ")'>Assign</button>":$row['head'];
    //                                        <td style='text-align: center; vertical-align: middle'><input onclick='toggleSelect(this)' type='checkbox'></td>
                            echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['description'] . "</td>
                                            <td>" . $head . "</td>
                                            
                                            <td> <a href='?p=edit_dept&id=". $row['id'] ."'><button type='button' class='btn btn-success btn-sm'>Edit</button></a>
                                            <button type='button' class='btn btn-danger btn-sm' onclick='deleteDept(" . $row['id'] . ", \"" . $row['name'] . "\")'>Delete</button>" . "</td>
                                        </tr>";
//                            <td> <button type='button' class='btn btn-success btn-sm' onclick='editDept(" . $row['id'] . ", \"" . $row['name'] . "\", \"" . $row['description'] . "\", \"" . $row['username'] . "\", \"" . $row['head'] . "\")'>Edit</button>
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
