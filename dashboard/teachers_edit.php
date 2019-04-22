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
$teacher_row = NAN;

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
        $sql = "SELECT teacher.username, teacher.name,
                teacher.designation, teacher.department,
                department.name AS dept_name,
                teacher.gender, teacher.birthdate,
                teacher.email,teacher.phone,
                teacher.address, teacher.district,
                teacher.photo FROM teacher
                LEFT JOIN department ON teacher.department = department.id
                WHERE username = '$user_id'";
        //mysqli_real_escape_string($sql);

        if($result = mysqli_query($db_conn, $sql)){
            $teacher_row = mysqli_fetch_assoc($result);
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

        <!-- Teacher Edit -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit"></i> Edit Teacher</div>
            <div class="card-body">
                <p>
                <form class="form-group" name="AddTeacher" action="action/update_teacher.php" method="post" onsubmit="return validateTeacherForm()">
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherUsername">Username</label>

                        </div>
                        <div class="col-75">
                            <input type="text" readonly name="teacherUsername" id="teacherUsername" placeholder="" value="<?php echo $teacher_row['username'] ?>">
                            <div class="invalid-feedback">
                                * Please enter username.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherName">Name</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherName" id="teacherName" placeholder="Enter Teacher Name" value="<?php echo $teacher_row['name'] ?>">
                            <div class="invalid-feedback">
                                * Please enter name.
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
                                <option <?php if ($teacher_row['designation'] == "Professor") echo "selected"?> value="Professor">Professor</option>
                                <option <?php if ($teacher_row['designation'] == "Associate Professor") echo "selected"?> value="Associate Professor">Associate Professor</option>
                                <option <?php if ($teacher_row['designation'] == "Assistant Professor") echo "selected"?> value="Assistant Professor">Assistant Professor</option>
                                <option <?php if ($teacher_row['designation'] == "Lecturer") echo "selected"?> value="Lecturer">Lecturer</option>
                            </select>
                            <div class="invalid-feedback">
                                * Please select a designation.
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
                                $sql = "SELECT id, name FROM department";
                                //                            $sql = "SELECT username, name FROM teacher";

                                if($result = mysqli_query($db_conn, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            if($row['id'] == $teacher_row['department']){
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
                            <label for="teacherGender">Gender</label>

                        </div>
                        <div class="col-75">
                            <select name="teacherGender" id="teacherGender">
                                <option value="">Choose...</option>
                                <option <?php if ($teacher_row['gender'] == "Male") echo "selected"?> value="Male">Male</option>
                                <option <?php if ($teacher_row['gender'] == "Female") echo "selected"?> value="Female">Female</option>
                            </select>
                            <div class="invalid-feedback">
                                * Please select a gender.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherBirthdate">Birthdate</label>

                        </div>
                        <div class="col-75">
                            <input type="date" name="teacherBirthdate" id="teacherBirthdate" placeholder="MM/DD/YYYY" value="<?php echo $teacher_row['birthdate'] ?>">
                            <div class="invalid-feedback">
                                * Please enter birthdate.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherEmail">Email</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherEmail" id="teacherEmail" placeholder="Enter Email Address" value="<?php echo $teacher_row['email'] ?>">
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
                            <input type="text" name="teacherPhone" id="teacherPhone" placeholder="Enter Phone Number" value="<?php echo $teacher_row['phone'] ?>">
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
                            <input type="text" name="teacherAddress" id="teacherAddress" placeholder="Enter Address" value="<?php echo $teacher_row['address'] ?>">
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
                                <option value="">Choose...</option>
                                <option <?php if($teacher_row['district'] == "Bagerhat") echo "selected" ?> value="Bagerhat">Bagerhat</option>
                                <option <?php if($teacher_row['district'] == "Bandarban") echo "selected" ?> value="Bandarban">Bandarban</option>
                                <option <?php if($teacher_row['district'] == "Barguna") echo "selected" ?> value="Barguna">Barguna</option>
                                <option <?php if($teacher_row['district'] == "Barisal") echo "selected" ?> value="Barisal">Barisal</option>
                                <option <?php if($teacher_row['district'] == "Bhola") echo "selected" ?> value="Bhola">Bhola</option>
                                <option <?php if($teacher_row['district'] == "Bogra") echo "selected" ?> value="Bogra">Bogra</option>
                                <option <?php if($teacher_row['district'] == "Brahmanbaria") echo "selected" ?> value="Brahmanbaria">Brahmanbaria</option>
                                <option <?php if($teacher_row['district'] == "Chandpur") echo "selected" ?> value="Chandpur">Chandpur</option>
                                <option <?php if($teacher_row['district'] == "Chittagong") echo "selected" ?> value="Chittagong">Chittagong</option>
                                <option <?php if($teacher_row['district'] == "Chuadanga") echo "selected" ?> value="Chuadanga">Chuadanga</option>
                                <option <?php if($teacher_row['district'] == "Comilla") echo "selected" ?> value="Comilla">Comilla</option>
                                <option <?php if($teacher_row['district'] == "Cox's Bazar") echo "selected" ?> value="Cox's Bazar">Cox's Bazar</option>
                                <option <?php if($teacher_row['district'] == "Dhaka") echo "selected" ?> value="Dhaka">Dhaka</option>
                                <option <?php if($teacher_row['district'] == "Dinajpur") echo "selected" ?> value="Dinajpur">Dinajpur</option>
                                <option <?php if($teacher_row['district'] == "Faridpur") echo "selected" ?> value="Faridpur">Faridpur</option>
                                <option <?php if($teacher_row['district'] == "Feni") echo "selected" ?> value="Feni">Feni</option>
                                <option <?php if($teacher_row['district'] == "Gaibandha") echo "selected" ?> value="Gaibandha">Gaibandha</option>
                                <option <?php if($teacher_row['district'] == "Gazipur") echo "selected" ?> value="Gazipur">Gazipur</option>
                                <option <?php if($teacher_row['district'] == "Gopalganj") echo "selected" ?> value="Gopalganj">Gopalganj</option>
                                <option <?php if($teacher_row['district'] == "Habiganj") echo "selected" ?> value="Habiganj">Habiganj</option>
                                <option <?php if($teacher_row['district'] == "Jaipurhat") echo "selected" ?> value="Jaipurhat">Jaipurhat</option>
                                <option <?php if($teacher_row['district'] == "Jamalpur") echo "selected" ?> value="Jamalpur">Jamalpur</option>
                                <option <?php if($teacher_row['district'] == "Jessore") echo "selected" ?> value="Jessore">Jessore</option>
                                <option <?php if($teacher_row['district'] == "Jhalakati") echo "selected" ?> value="Jhalakati">Jhalakati</option>
                                <option <?php if($teacher_row['district'] == "Jhenaidah") echo "selected" ?> value="Jhenaidah">Jhenaidah</option>
                                <option <?php if($teacher_row['district'] == "Khagrachari") echo "selected" ?> value="Khagrachari">Khagrachari</option>
                                <option <?php if($teacher_row['district'] == "Khulna") echo "selected" ?> value="Khulna">Khulna</option>
                                <option <?php if($teacher_row['district'] == "Kishoreganj") echo "selected" ?> value="Kishoreganj">Kishoreganj</option>
                                <option <?php if($teacher_row['district'] == "Kurigram") echo "selected" ?> value="Kurigram">Kurigram</option>
                                <option <?php if($teacher_row['district'] == "Kushtia") echo "selected" ?> value="Kushtia">Kushtia</option>
                                <option <?php if($teacher_row['district'] == "Lakshmipur") echo "selected" ?> value="Lakshmipur">Lakshmipur</option>
                                <option <?php if($teacher_row['district'] == "Lalmonirhat") echo "selected" ?> value="Lalmonirhat">Lalmonirhat</option>
                                <option <?php if($teacher_row['district'] == "Madaripur") echo "selected" ?> value="Madaripur">Madaripur</option>
                                <option <?php if($teacher_row['district'] == "Magura") echo "selected" ?> value="Magura">Magura</option>
                                <option <?php if($teacher_row['district'] == "Manikganj") echo "selected" ?> value="Manikganj">Manikganj</option>
                                <option <?php if($teacher_row['district'] == "Meherpur") echo "selected" ?> value="Meherpur">Meherpur</option>
                                <option <?php if($teacher_row['district'] == "Moulvibazar") echo "selected" ?> value="Moulvibazar">Moulvibazar</option>
                                <option <?php if($teacher_row['district'] == "Munshiganj") echo "selected" ?> value="Munshiganj">Munshiganj</option>
                                <option <?php if($teacher_row['district'] == "Mymensingh") echo "selected" ?> value="Mymensingh">Mymensingh</option>
                                <option <?php if($teacher_row['district'] == "Narail") echo "selected" ?> value="Narail">Narail</option>
                                <option <?php if($teacher_row['district'] == "Naogaon") echo "selected" ?> value="Naogaon">Naogaon</option>
                                <option <?php if($teacher_row['district'] == "Narayanganj") echo "selected" ?> value="Narayanganj">Narayanganj</option>
                                <option <?php if($teacher_row['district'] == "Narsingdi") echo "selected" ?> value="Narsingdi">Narsingdi</option>
                                <option <?php if($teacher_row['district'] == "Natore") echo "selected" ?> value="Natore">Natore</option>
                                <option <?php if($teacher_row['district'] == "Nawabganj") echo "selected" ?> value="Nawabganj">Nawabganj</option>
                                <option <?php if($teacher_row['district'] == "Netrakona") echo "selected" ?> value="Netrakona">Netrakona</option>
                                <option <?php if($teacher_row['district'] == "Nilphamari") echo "selected" ?> value="Nilphamari">Nilphamari</option>
                                <option <?php if($teacher_row['district'] == "Noakhali") echo "selected" ?> value="Noakhali">Noakhali</option>
                                <option <?php if($teacher_row['district'] == "Pabna") echo "selected" ?> value="Pabna">Pabna</option>
                                <option <?php if($teacher_row['district'] == "Panchagarh") echo "selected" ?> value="Panchagarh">Panchagarh</option>
                                <option <?php if($teacher_row['district'] == "Parbattya Chattagram") echo "selected" ?> value="Parbattya Chattagram">Parbattya Chattagram</option>
                                <option <?php if($teacher_row['district'] == "Patuakhali") echo "selected" ?> value="Patuakhali">Patuakhali</option>
                                <option <?php if($teacher_row['district'] == "Pirojpur") echo "selected" ?> value="Pirojpur">Pirojpur</option>
                                <option <?php if($teacher_row['district'] == "Rangpur") echo "selected" ?> value="Rangpur">Rangpur</option>
                                <option <?php if($teacher_row['district'] == "Rajshahi") echo "selected" ?> value="Rajshahi">Rajshahi</option>
                                <option <?php if($teacher_row['district'] == "Rajbari") echo "selected" ?> value="Rajbari">Rajbari</option>
                                <option <?php if($teacher_row['district'] == "Satkhira") echo "selected" ?> value="Satkhira">Satkhira</option>
                                <option <?php if($teacher_row['district'] == "Shariatpur") echo "selected" ?> value="Shariatpur">Shariatpur</option>
                                <option <?php if($teacher_row['district'] == "Sherpur") echo "selected" ?> value="Sherpur">Sherpur</option>
                                <option <?php if($teacher_row['district'] == "Sirajganj") echo "selected" ?> value="Sirajganj">Sirajganj</option>
                                <option <?php if($teacher_row['district'] == "Sunamganj") echo "selected" ?> value="Sunamganj">Sunamganj</option>
                                <option <?php if($teacher_row['district'] == "Sylhet") echo "selected" ?> value="Sylhet">Sylhet</option>
                                <option <?php if($teacher_row['district'] == "Tangail") echo "selected" ?> value="Tangail">Tangail</option>
                                <option <?php if($teacher_row['district'] == "Thakurgaon") echo "selected" ?> value="Thakurgaon">Thakurgaon</option>

                            </select>
                            <div class="invalid-feedback">
                                * Please select a district.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="teacherPhoto">Photo</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="teacherPhoto" id="teacherPhoto" placeholder="Browse.." value="<?php echo $teacher_row['photo'] ?>">
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
