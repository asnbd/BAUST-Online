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
$dept_row = NAN;

if ($login_role == 0 || $login_role == 1){  //Owner or Admin
    $sql = "SELECT COUNT(*) AS message FROM message WHERE msg_to = '$login_user' AND unread = 1";

    if($result = mysqli_query($db_conn, $sql)){
        $row = mysqli_fetch_assoc($result);
        $message_count = $row['message'];
    } else {
        echo mysqli_error($db_conn) . " SQL: " . $sql;
    }

    mysqli_free_result($result);

    if(isset($_GET['id'])){
        $dept_id = $_GET['id'];
        $sql = "SELECT department.id, department.name, department.description, teacher.username, teacher.name AS head FROM department LEFT JOIN teacher ON department.head = teacher.username WHERE id = '$dept_id'";
        //mysqli_real_escape_string($sql);

        if($result = mysqli_query($db_conn, $sql)){
            $dept_row = mysqli_fetch_assoc($result);
        }
    } else {
        $_SESSION['message'] = ["error", "Invalid Department ID!"];
        header("location: ?p=departments");
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
    <?php $active_page = "teachers"; include "includes/sidebar.php"; ?>

    <?php include "includes/header.php" ?>

    <div class="content">
        <ul class="breadcrumb">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="?p=teachers">Teachers</a></li>
            <li>Edit Teacher</li>
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
                <i class="fas fa-edit"></i> Edit Department</div>
            <div class="card-body">
                <p>
                <form class="form-group" name="EditDepartment" action="action/update_dept.php" method="post" onsubmit="return validateEditDeptForm()">
                    <div class="row">
                        <div class="col-25">
                            <label for="departmentName">Department Name</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="deptName" id="departmentName" placeholder="Enter Department Name" value="<?php echo $dept_row['name'];?>">
                            <div id="invalid-dept" class="invalid-feedback">
                                * Please enter department name.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="departmentDesc">Department Description</label>
                        </div>
                        <div class="col-75">
                            <textarea name="deptDesc" id="departmentDesc" placeholder="Enter Department Description" rows="3"><?php echo $dept_row['description'];?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="departmentHead">Department Head</label>
                        </div>
                        <div class="col-75">
                            <select name="deptHead" id="departmentHead">
                                <option value="">Choose...</option>
                                <?php
                                    if($dept_row['username'] == ""){
                                        echo '<option value="-1" selected>Not Assigned</option>';
                                    } else {
                                        echo '<option value="-1">Not Assigned</option>';
                                        echo '<option value="'. $dept_row['username'] . '" selected>'.$dept_row['head'] . '</option>';
                                    }
                                ?>

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
                        </div>
                    </div>
                    <input name="deptID" type="hidden" value="<?php echo $dept_row['id'] ?>">
                    <div class="row">
                        <button type='submit' class='btn btn-primary' style="float: right; margin-top: 15px">Save</button><br>
                    </div>
                </form>
                </p>

            </div>
        </div>



        <!-- Footer -->
        <?php include "includes/footer.php" ?>
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
