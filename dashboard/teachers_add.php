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
            <li>Add Teacher</li>
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
                <i class="fas fa-edit"></i> Add Teacher</div>
            <div class="card-body">
                <p>
                <form class="form-group" name="AddTeacher" action="action/add_teacher.php" method="post" onsubmit="return validateTeacherForm()">
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherUsername">Teacher Username</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherUsername" id="teacherUsername" placeholder="Enter Teacher Username">
                            <div class="invalid-feedback">
                                * Please enter teacher username.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherName">Teacher Name</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherName" id="teacherName" placeholder="Enter Teacher Name">
                            <div class="invalid-feedback">
                                * Please enter teacher name.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherDesignation">Designation</label>

                        </div>
                        <div class="col-75">
                            <select name="teacherDesignation" id="teacherDesignation">
                                <option value="" selected>Choose...</option>
                                <option value="Professor">Professor</option>
                                <option value="Associate Professor">Associate Professor</option>
                                <option value="Assistant Professor">Assistant Professor</option>
                                <option value="Lecturer">Lecturer</option>
                            </select>
                            <div class="invalid-feedback">
                                * Please enter teacher Designation.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherDepartment">Department</label>

                        </div>
                        <div class="col-75">
                            <select name="teacherDepartment" id="teacherDepartment">
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
                            <div class="invalid-feedback">
                                * Please enter Department.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherGender">Gender</label>

                        </div>
                        <div class="col-75">
                            <select name="teacherGender" id="teacherGender">
                                <option value="" selected>Choose...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">
                                * Please enter Gender.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherBirthdate">Birthdate</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherBirthdate" id="teacherBirthdate" placeholder="DD-MM-YYYY">
                            <div class="invalid-feedback">
                                * Please enter Birthdate.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherEmail">Email</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherEmail" id="teacherEmail" placeholder="Enter Email Address">
                            <div class="invalid-feedback">
                                * Please enter email address.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherPhone">Phone</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherPhone" id="teacherPhone" placeholder="Enter Phone Number">
                            <div class="invalid-feedback">
                                * Please enter phone number.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherAddress">Address</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherAddress" id="teacherAddress" placeholder="Enter Address">
                            <div class="invalid-feedback">
                                * Please enter address.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherDistrict">District</label>

                        </div>
                        <div class="col-75">
                            <select name="teacherDistrict" id="teacherDistrict">
                                <option value="" selected>Choose...</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barguna">Barguna</option>

                            </select>
                            <div class="invalid-feedback">
                                * Please enter District.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherName">Teacher Name</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherName" id="teacherName" placeholder="Enter Teacher Name">
                            <div class="invalid-feedback">
                                * Please enter teacher name.
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
