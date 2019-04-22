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
$student_row = NAN;

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
        $user_id = $_GET['id'];
        $sql = "SELECT student.student_id, student.name,
                student.semester, student.department,
                department.name AS dept_name,
                student.gender, student.birthdate,
                student.email,student.phone,
                student.address, student.district,
                student.photo FROM student
                LEFT JOIN department ON student.department = department.id
                WHERE student_id = '$user_id'";
        //mysqli_real_escape_string($sql);

        if($result = mysqli_query($db_conn, $sql)){
            $student_row = mysqli_fetch_assoc($result);
        } else {
            echo "Database Error: " . mysqli_error($db_conn);
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
    <?php $active_page = "students"; include "includes/sidebar.php"; ?>

    <?php include "includes/header.php" ?>

    <div class="content">
        <ul class="breadcrumb">
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="?p=student">Student</a></li>
            <li>Edit Student</li>
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

        <!-- Student Edit -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit"></i> Edit Student</div>
            <div class="card-body">
                <p>
                <form class="form-group" name="AddStudent" action="action/update_student.php" method="post" onsubmit="return validateStudentForm()">
                    <div class="row">
                        <div class="col-25">
                            <label for="studentID">Student ID</label>

                        </div>
                        <div class="col-75">
                            <input type="text" readonly name="studentID" id="studentID" placeholder="Enter Student ID" value="<?php echo $student_row['student_id'];?>">
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
                            <input type="text" name="studentName" id="studentName" placeholder="Enter Student Name" value="<?php echo $student_row['name'];?>">
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
                            <input type="text" name="studentEmail" id="studentEmail" placeholder="Enter Email Address" value="<?php echo $student_row['email'];?>">
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
                            <input type="text" name="studentPhone" id="studentPhone" placeholder="Enter Phone Number" value="<?php echo $student_row['phone'];?>">
                            <div class="invalid-feedback">
                                * Please enter a phone number.
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
                                <option <?php if ($student_row['gender'] == "Male") echo "selected"?> value="Male">Male</option>
                                <option <?php if ($student_row['gender'] == "Female") echo "selected"?> value="Female">Female</option>
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
                            <input type="date" name="studentBirthdate" id="studentBirthdate" placeholder="" value="<?php echo $student_row['birthdate'];?>">
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
                            <input type="text" name="studentAddress" id="studentAddress" placeholder="Enter Address" value="<?php echo $student_row['address'];?>">
                            <div class="invalid-feedback">
                                * Please enter an address.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentDistrict">District</label>

                        </div>
                        <div class="col-75">
                            <select name="studentDistrict" id="studentDistrict">
                                <option value="">Choose...</option>
                                <option <?php if($student_row['district'] == "Bagerhat") echo "selected" ?> value="Bagerhat">Bagerhat</option>
                                <option <?php if($student_row['district'] == "Bandarban") echo "selected" ?> value="Bandarban">Bandarban</option>
                                <option <?php if($student_row['district'] == "Barguna") echo "selected" ?> value="Barguna">Barguna</option>
                                <option <?php if($student_row['district'] == "Barisal") echo "selected" ?> value="Barisal">Barisal</option>
                                <option <?php if($student_row['district'] == "Bhola") echo "selected" ?> value="Bhola">Bhola</option>
                                <option <?php if($student_row['district'] == "Bogra") echo "selected" ?> value="Bogra">Bogra</option>
                                <option <?php if($student_row['district'] == "Brahmanbaria") echo "selected" ?> value="Brahmanbaria">Brahmanbaria</option>
                                <option <?php if($student_row['district'] == "Chandpur") echo "selected" ?> value="Chandpur">Chandpur</option>
                                <option <?php if($student_row['district'] == "Chittagong") echo "selected" ?> value="Chittagong">Chittagong</option>
                                <option <?php if($student_row['district'] == "Chuadanga") echo "selected" ?> value="Chuadanga">Chuadanga</option>
                                <option <?php if($student_row['district'] == "Comilla") echo "selected" ?> value="Comilla">Comilla</option>
                                <option <?php if($student_row['district'] == "Cox's Bazar") echo "selected" ?> value="Cox's Bazar">Cox's Bazar</option>
                                <option <?php if($student_row['district'] == "Dhaka") echo "selected" ?> value="Dhaka">Dhaka</option>
                                <option <?php if($student_row['district'] == "Dinajpur") echo "selected" ?> value="Dinajpur">Dinajpur</option>
                                <option <?php if($student_row['district'] == "Faridpur") echo "selected" ?> value="Faridpur">Faridpur</option>
                                <option <?php if($student_row['district'] == "Feni") echo "selected" ?> value="Feni">Feni</option>
                                <option <?php if($student_row['district'] == "Gaibandha") echo "selected" ?> value="Gaibandha">Gaibandha</option>
                                <option <?php if($student_row['district'] == "Gazipur") echo "selected" ?> value="Gazipur">Gazipur</option>
                                <option <?php if($student_row['district'] == "Gopalganj") echo "selected" ?> value="Gopalganj">Gopalganj</option>
                                <option <?php if($student_row['district'] == "Habiganj") echo "selected" ?> value="Habiganj">Habiganj</option>
                                <option <?php if($student_row['district'] == "Jaipurhat") echo "selected" ?> value="Jaipurhat">Jaipurhat</option>
                                <option <?php if($student_row['district'] == "Jamalpur") echo "selected" ?> value="Jamalpur">Jamalpur</option>
                                <option <?php if($student_row['district'] == "Jessore") echo "selected" ?> value="Jessore">Jessore</option>
                                <option <?php if($student_row['district'] == "Jhalakati") echo "selected" ?> value="Jhalakati">Jhalakati</option>
                                <option <?php if($student_row['district'] == "Jhenaidah") echo "selected" ?> value="Jhenaidah">Jhenaidah</option>
                                <option <?php if($student_row['district'] == "Khagrachari") echo "selected" ?> value="Khagrachari">Khagrachari</option>
                                <option <?php if($student_row['district'] == "Khulna") echo "selected" ?> value="Khulna">Khulna</option>
                                <option <?php if($student_row['district'] == "Kishoreganj") echo "selected" ?> value="Kishoreganj">Kishoreganj</option>
                                <option <?php if($student_row['district'] == "Kurigram") echo "selected" ?> value="Kurigram">Kurigram</option>
                                <option <?php if($student_row['district'] == "Kushtia") echo "selected" ?> value="Kushtia">Kushtia</option>
                                <option <?php if($student_row['district'] == "Lakshmipur") echo "selected" ?> value="Lakshmipur">Lakshmipur</option>
                                <option <?php if($student_row['district'] == "Lalmonirhat") echo "selected" ?> value="Lalmonirhat">Lalmonirhat</option>
                                <option <?php if($student_row['district'] == "Madaripur") echo "selected" ?> value="Madaripur">Madaripur</option>
                                <option <?php if($student_row['district'] == "Magura") echo "selected" ?> value="Magura">Magura</option>
                                <option <?php if($student_row['district'] == "Manikganj") echo "selected" ?> value="Manikganj">Manikganj</option>
                                <option <?php if($student_row['district'] == "Meherpur") echo "selected" ?> value="Meherpur">Meherpur</option>
                                <option <?php if($student_row['district'] == "Moulvibazar") echo "selected" ?> value="Moulvibazar">Moulvibazar</option>
                                <option <?php if($student_row['district'] == "Munshiganj") echo "selected" ?> value="Munshiganj">Munshiganj</option>
                                <option <?php if($student_row['district'] == "Mymensingh") echo "selected" ?> value="Mymensingh">Mymensingh</option>
                                <option <?php if($student_row['district'] == "Narail") echo "selected" ?> value="Narail">Narail</option>
                                <option <?php if($student_row['district'] == "Naogaon") echo "selected" ?> value="Naogaon">Naogaon</option>
                                <option <?php if($student_row['district'] == "Narayanganj") echo "selected" ?> value="Narayanganj">Narayanganj</option>
                                <option <?php if($student_row['district'] == "Narsingdi") echo "selected" ?> value="Narsingdi">Narsingdi</option>
                                <option <?php if($student_row['district'] == "Natore") echo "selected" ?> value="Natore">Natore</option>
                                <option <?php if($student_row['district'] == "Nawabganj") echo "selected" ?> value="Nawabganj">Nawabganj</option>
                                <option <?php if($student_row['district'] == "Netrakona") echo "selected" ?> value="Netrakona">Netrakona</option>
                                <option <?php if($student_row['district'] == "Nilphamari") echo "selected" ?> value="Nilphamari">Nilphamari</option>
                                <option <?php if($student_row['district'] == "Noakhali") echo "selected" ?> value="Noakhali">Noakhali</option>
                                <option <?php if($student_row['district'] == "Pabna") echo "selected" ?> value="Pabna">Pabna</option>
                                <option <?php if($student_row['district'] == "Panchagarh") echo "selected" ?> value="Panchagarh">Panchagarh</option>
                                <option <?php if($student_row['district'] == "Parbattya Chattagram") echo "selected" ?> value="Parbattya Chattagram">Parbattya Chattagram</option>
                                <option <?php if($student_row['district'] == "Patuakhali") echo "selected" ?> value="Patuakhali">Patuakhali</option>
                                <option <?php if($student_row['district'] == "Pirojpur") echo "selected" ?> value="Pirojpur">Pirojpur</option>
                                <option <?php if($student_row['district'] == "Rangpur") echo "selected" ?> value="Rangpur">Rangpur</option>
                                <option <?php if($student_row['district'] == "Rajshahi") echo "selected" ?> value="Rajshahi">Rajshahi</option>
                                <option <?php if($student_row['district'] == "Rajbari") echo "selected" ?> value="Rajbari">Rajbari</option>
                                <option <?php if($student_row['district'] == "Satkhira") echo "selected" ?> value="Satkhira">Satkhira</option>
                                <option <?php if($student_row['district'] == "Shariatpur") echo "selected" ?> value="Shariatpur">Shariatpur</option>
                                <option <?php if($student_row['district'] == "Sherpur") echo "selected" ?> value="Sherpur">Sherpur</option>
                                <option <?php if($student_row['district'] == "Sirajganj") echo "selected" ?> value="Sirajganj">Sirajganj</option>
                                <option <?php if($student_row['district'] == "Sunamganj") echo "selected" ?> value="Sunamganj">Sunamganj</option>
                                <option <?php if($student_row['district'] == "Sylhet") echo "selected" ?> value="Sylhet">Sylhet</option>
                                <option <?php if($student_row['district'] == "Tangail") echo "selected" ?> value="Tangail">Tangail</option>
                                <option <?php if($student_row['district'] == "Thakurgaon") echo "selected" ?> value="Thakurgaon">Thakurgaon</option>

                            </select>
                            <div class="invalid-feedback">
                                * Please select a district.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentDepartment">Department</label>

                        </div>
                        <div class="col-75">
                            <select name="studentDepartment" id="studentDepartment">
                                <option value="">Choose...</option>

                                <?php
                                $sql = "SELECT id, name FROM department";

                                if($result = mysqli_query($db_conn, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            if($row['id'] == $student_row['department']){
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
                            <div class="invalid-feedback">
                                * Please select a department.
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
                                <option <?php if ($student_row['semester'] == "1") echo "selected"?> value="1">Level 1, Term I</option>
                                <option <?php if ($student_row['semester'] == "2") echo "selected"?> value="2">Level 1, Term II</option>
                                <option <?php if ($student_row['semester'] == "3") echo "selected"?> value="3">Level 2, Term I</option>
                                <option <?php if ($student_row['semester'] == "4") echo "selected"?> value="4">Level 2, Term II</option>
                                <option <?php if ($student_row['semester'] == "5") echo "selected"?> value="5">Level 3, Term I</option>
                                <option <?php if ($student_row['semester'] == "6") echo "selected"?> value="6">Level 3, Term II</option>
                                <option <?php if ($student_row['semester'] == "7") echo "selected"?> value="7">Level 4, Term I</option>
                                <option <?php if ($student_row['semester'] == "8") echo "selected"?> value="8">Level 4, Term II</option>
                            </select>
                            <div class="invalid-feedback">
                                * Please select a semester.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="studentPhoto">Photo</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="studentPhoto" id="studentPhoto" placeholder="Browse.." value="<?php echo $student_row['photo'];?>">
                            <div class="invalid-feedback">
                                * Please choose a photo.
                            </div>
                        </div>
                    </div>
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

    <script src="js/scripts.js" type="text/javascript"></script>
    <script src="js/validation.js" type="text/javascript"></script>

</body>

</html>
