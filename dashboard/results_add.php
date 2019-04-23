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

if ($login_role <= 3){  //Owner or Admin
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
            <li><a href="?p=results">Results</a></li>
            <li>Add Result</li>
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

        <!-- Results Edit -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit"></i> Add Result</div>
            <div class="card-body">
                <p>
                <form class="form-group" name="AddResult" action="action/add_result.php" method="post" onsubmit="return validateResultForm()">
                    <div class="row">
                        <div class="col-25">
                            <label for="resultType">Result Type</label>

                        </div>
                        <div class="col-75">
                            <input type="text" name="resultType" id="resultType" placeholder="Enter Result Type">
                            <div class="invalid-feedback">
                                * Please enter Result Type
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="resultCourse">Course</label>

                        </div>
                        <div class="col-75">
                            <select name="resultCourse" id="resultCourse">
                                <option value="" selected>Choose...</option>

                                <?php
                                $sql = "SELECT id, code, title FROM course";

                                if($result = mysqli_query($db_conn, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo "<option value='" . $row['id'] . "'>" . $row['code'] . " - " . $row['title'] . "</option>";
                                        }
                                    } else {

                                    }
                                } else {
                                    die("Error: " . mysqli_connect_error($db_conn). " SQL: " . $sql);
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                * Please select a course.
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
