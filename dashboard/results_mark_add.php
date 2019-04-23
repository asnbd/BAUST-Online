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
            <li><a href="?p=students">Results</a></li>
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

        <!-- Result Add -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-edit"></i> Add Result</div>
            <div class="card-body">
                <p>
                <form class="form-group" name="AddResult" action="action/add_result_mark.php" method="post" onsubmit="return validateResultForm()">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <!--                                <th width='15px'>#</th>-->
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Mark</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                            $sql = "SELECT student.student_id, student.name, result_marks.mark FROM student LEFT JOIN result_marks ON student.student_id = result_marks.student_id ";
                            if($result = mysqli_query($db_conn, $sql)){
                                if(mysqli_num_rows($result)){
                                    while ($row = mysqli_fetch_assoc($result)){
                                        $input1 = "<input type='hidden' name='ids[]' value='". $row['student_id'] ."'>";
                                        $input2 = "<input type='text' name='marks[]' value='". $row['mark'] ."'>";
                                        echo "<tr>
                                            <td>" . $row['student_id'] . "</td>
                                            <td>" . $row['name'] . "</td>
                                            " . $input1 . "
                                            <td>" . $input2 . "</td>
                                        </tr>";
                                    }
                                }else {
                                    echo "<tr><td colspan='3'><center>No Courses<center></td></tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'><center>Database Error! ". mysqli_error($db_conn) . "<center></td></tr>";
                            }

                        ?>

                        </tbody>
                    </table>
                    <input type="hidden" name="rid" value="<?php echo $_GET['id'] ?>">
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
