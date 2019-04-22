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
                <form class="form-group" name="AddStudent" action="action/add_student.php" method="post" onsubmit="return validateStudentForm()">
                    <div class="row">
                        <div class="col-25">
                            <label for="studentID">Student ID</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="studentID" id="studentID" placeholder="Enter Student ID">
                            <div class="invalid-feedback">
                                * Please enter student id.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentName">Student Name</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="studentName" id="studentName" placeholder="Enter Student Name">
                            <div class="invalid-feedback">
                                * Please enter student name.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentEmail">Email</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="studentEmail" id="studentEmail" placeholder="Enter Email Address">
                            <div class="invalid-feedback">
                                * Please enter email address.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentPhone">Phone</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="studentPhone" id="studentPhone" placeholder="Enter Phone Number">
                            <div class="invalid-feedback">
                                * Please enter phone number.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentGender">Gender</label>

                        </div>
                        <div class="col-75">
                            <select name="studentGender" id="studentGender">
                                <option value="" selected>Choose...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                            <div class="invalid-feedback">
                                * Please select Gender.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentBirthdate">Birthdate</label>

                        </div>
                        <div class="col-75">
                            <input type="date" name="studentBirthdate" id="studentBirthdate" placeholder="">
                            <div class="invalid-feedback">
                                * Please enter Birthdate.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentAddress">Address</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="studentAddress" id="studentAddress" placeholder="Enter Address">
                            <div class="invalid-feedback">
                                * Please enter address.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentDistrict">District</label>

                        </div>
                        <div class="col-75">
                            <select name="studentDistrict" id="studentDistrict">
                                <option value="" selected>Choose...</option>
                                <option value="Bagerhat">Bagerhat</option>
                                <option value="Bandarban">Bandarban</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barisal">Barisal</option>
                                <option value="Bhola">Bhola</option>
                                <option value="Bogra">Bogra</option>
                                <option value="Brahmanbaria">Brahmanbaria</option>
                                <option value="Chandpur">Chandpur</option>
                                <option value="Chittagong">Chittagong</option>
                                <option value="Chuadanga">Chuadanga</option>
                                <option value="Comilla">Comilla</option>
                                <option value="Cox's Bazar">Cox's Bazar</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Dinajpur">Dinajpur</option>
                                <option value="Faridpur">Faridpur</option>
                                <option value="Feni">Feni</option>
                                <option value="Gaibandha">Gaibandha</option>
                                <option value="Gazipur">Gazipur</option>
                                <option value="Gopalganj">Gopalganj</option>
                                <option value="Habiganj">Habiganj</option>
                                <option value="Jaipurhat">Jaipurhat</option>
                                <option value="Jamalpur">Jamalpur</option>
                                <option value="Jessore">Jessore</option>
                                <option value="Jhalakati">Jhalakati</option>
                                <option value="Jhenaidah">Jhenaidah</option>
                                <option value="Khagrachari">Khagrachari</option>
                                <option value="Khulna">Khulna</option>
                                <option value="Kishoreganj">Kishoreganj</option>
                                <option value="Kurigram">Kurigram</option>
                                <option value="Kushtia">Kushtia</option>
                                <option value="Lakshmipur">Lakshmipur</option>
                                <option value="Lalmonirhat">Lalmonirhat</option>
                                <option value="Madaripur">Madaripur</option>
                                <option value="Magura">Magura</option>
                                <option value="Manikganj">Manikganj</option>
                                <option value="Meherpur">Meherpur</option>
                                <option value="Moulvibazar">Moulvibazar</option>
                                <option value="Munshiganj">Munshiganj</option>
                                <option value="Mymensingh">Mymensingh</option>
                                <option value="Narail">Narail</option>
                                <option value="Naogaon">Naogaon</option>
                                <option value="Narayanganj">Narayanganj</option>
                                <option value="Narsingdi">Narsingdi</option>
                                <option value="Natore">Natore</option>
                                <option value="Nawabganj">Nawabganj</option>
                                <option value="Netrakona">Netrakona</option>
                                <option value="Nilphamari">Nilphamari</option>
                                <option value="Noakhali">Noakhali</option>
                                <option value="Pabna">Pabna</option>
                                <option value="Panchagarh">Panchagarh</option>
                                <option value="Parbattya Chattagram">Parbattya Chattagram</option>
                                <option value="Patuakhali">Patuakhali</option>
                                <option value="Pirojpur">Pirojpur</option>
                                <option value="Rangpur">Rangpur</option>
                                <option value="Rajshahi">Rajshahi</option>
                                <option value="Rajbari">Rajbari</option>
                                <option value="Satkhira">Satkhira</option>
                                <option value="Shariatpur">Shariatpur</option>
                                <option value="Sherpur">Sherpur</option>
                                <option value="Sirajganj">Sirajganj</option>
                                <option value="Sunamganj">Sunamganj</option>
                                <option value="Sylhet">Sylhet</option>
                                <option value="Tangail">Tangail</option>
                                <option value="Thakurgaon">Thakurgaon</option>

                            </select>
                            <div class="invalid-feedback">
                                * Please select District.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentDepartment">Department</label>

                        </div>
                        <div class="col-75">
                            <select name="studentDepartment" id="studentDepartment">
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
                                * Please select Department.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentSemester">Semester</label>

                        </div>
                        <div class="col-75">
                            <select name="studentSemester" id="studentSemester">
                                <option value="" selected>Choose...</option>
                                <option value="Level:1 Term:I">Level:1 Term:I</option>
                                <option value="Level:1 Term:II">Level:1 Term:II</option>
                                <option value="Level:2 Term:I">Level:2 Term:I</option>
                                <option value="Level:2 Term:II">Level:2 Term:II</option>
                                <option value="Level:3 Term:I">Level:3 Term:I</option>
                                <option value="Level:3 Term:II">Level:3 Term:II</option>
                                <option value="Level:4 Term:I">Level:4 Term:I</option>
                                <option value="Level:4 Term:II">Level:4 Term:II</option>
                            </select>
                            <div class="invalid-feedback">
                                * Please select semester.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentPhoto">Photo</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="studentPhoto" id="studentPhoto" placeholder="Browse..">
                            <div class="invalid-feedback">
                                * Please choose photo.
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
