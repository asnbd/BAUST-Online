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
} elseif ($login_role == 3) {

}else {   //Unauthorized
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
    <?php $active_page = "teachers"; include "includes/sidebar.php"; ?>

    <?php include "includes/header.php" ?>

    <div class="content">
        <ul class="breadcrumb">
            <li><a href="index.php">Dashboard</a></li>
            <li>Teachers</li>
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

        <!-- Teachers Table -->
        <div class="card">
            <div class="card-header"><i class="fas fa-table"></i> Teachers</div>
            <div class="card-body">
                <div class="data-table-head">
                    <div class="row">
                        <div class="col-25">
                            <?php if ($login_role < 2) { ?>
                                <a href="?p=add_teacher"><button type='button' class='btn btn-primary'>Add Teacher</button><br></a>
                            <?php } ?>

                        </div>
                        <div class="col-75">
                            <div class="f-right">
                                <form name="SearchDepartment" action="" method="get">
                                    <input type="hidden" name="p" value="teachers">
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

                                    <input type="text" style="min-width: 200px; width: 30%" name="search" placeholder="Search For..." value="<?php if(isset($_GET['search'])) echo $_GET['search'] ?>">

                                    <button type='submit' class='btn btn-primary'>Search</button><br>
                                    <div id="invalid-dept" class="invalid-feedback">
                                        * Please enter Search Text.
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <?php if(isset($_GET['search'])) echo "<p>Showing search result for: <strong>" . $_GET['search'] . "</strong></p>"; ?>
                    </div>
                </div>

                <?php if ($login_role < 2){ ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <!--                                <th width='15px'>#</th>-->
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($_GET['search'])){
                        $search = $_GET['search'];
                        $dept = isset($_GET['dept'])?$_GET['dept']:"";
                        if($dept == ""){
                            $sql = "SELECT teacher.username, teacher.name, teacher.designation, teacher.email, teacher.phone, teacher.department, department.name AS dept_name FROM teacher LEFT JOIN department ON department.id = teacher.department WHERE (teacher.name LIKE '%$search%' OR teacher.phone LIKE '%$search%') ORDER BY dept_name, teacher.designation, teacher.name";
                        } else {
                            $sql = "SELECT teacher.username, teacher.name, teacher.designation, teacher.email, teacher.phone, teacher.department, department.name AS dept_name FROM teacher LEFT JOIN department ON department.id = teacher.department WHERE (teacher.department = $dept) AND (teacher.name LIKE '%$search%' OR teacher.phone LIKE '%$search%') ORDER BY dept_name, teacher.designation, teacher.name";
                        }
                        if($result = mysqli_query($db_conn, $sql)){
                            if(mysqli_num_rows($result)){
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['designation'] . "</td>
                                            <td>" . $row['dept_name'] . "</td>
                                            <td>" . $row['email'] . "</td>
                                            <td>" . $row['phone'] . "</td>
                                            
                                            <td> <a href='?p=edit_teacher&id=". $row['username'] ."'><button type='button' class='btn btn-success btn-sm'>Edit</button></a>
                                            <button type='button' class='btn btn-danger btn-sm' onclick='deleteTeacher(\"" . $row['username'] . "\", \"" . $row['name'] . "\")'>Delete</button>" . "</td>
                                        </tr>";
                                }
                            } else{
                                echo "<tr><td colspan='6'><center>No Teachers Found<center></td></tr>";
                            }

                        } else {
                            echo "<tr><td colspan='6'><center>Database Error! ". mysqli_error($db_conn) ."<center></td></tr>";
                        }
                    } else {
                        $sql = "SELECT teacher.username, teacher.name, teacher.designation, teacher.email, teacher.phone, teacher.department, department.name AS dept_name FROM teacher LEFT JOIN department ON department.id = teacher.department WHERE active = 1 ORDER BY dept_name, teacher.designation, teacher.name";
                        if($result = mysqli_query($db_conn, $sql)){
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['designation'] . "</td>
                                            <td>" . $row['dept_name'] . "</td>
                                            <td>" . $row['email'] . "</td>
                                            <td>" . $row['phone'] . "</td>
                                            
                                            <td> <a href='?p=edit_teacher&id=". $row['username'] ."'><button type='button' class='btn btn-success btn-sm'>Edit</button></a>
                                            <button type='button' class='btn btn-danger btn-sm' onclick='deleteTeacher(\"" . $row['username'] . "\", \"" . $row['name'] . "\")'>Delete</button>" . "</td>
                                        </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'><center>No Teachers<center></td></tr>";
                        }
                    }
                    ?>

                    </tbody>
                </table>
                <?php } else { ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <!--                                <th width='15px'>#</th>-->
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($_GET['search'])){
                        $search = $_GET['search'];
                        $dept = isset($_GET['dept'])?$_GET['dept']:"";
                        if($dept == ""){
                            $sql = "SELECT teacher.username, teacher.name, teacher.designation, teacher.email, teacher.phone, teacher.department, department.name AS dept_name FROM teacher LEFT JOIN department ON department.id = teacher.department WHERE (teacher.name LIKE '%$search%' OR teacher.phone LIKE '%$search%') ORDER BY dept_name, teacher.designation, teacher.name";
                        } else {
                            $sql = "SELECT teacher.username, teacher.name, teacher.designation, teacher.email, teacher.phone, teacher.department, department.name AS dept_name FROM teacher LEFT JOIN department ON department.id = teacher.department WHERE (teacher.department = $dept) AND (teacher.name LIKE '%$search%' OR teacher.phone LIKE '%$search%') ORDER BY dept_name, teacher.designation, teacher.name";
                        }
                        if($result = mysqli_query($db_conn, $sql)){
                            if(mysqli_num_rows($result)){
                                while ($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['designation'] . "</td>
                                            <td>" . $row['dept_name'] . "</td>
                                            <td>" . $row['email'] . "</td>
                                            <td>" . $row['phone'] . "</td>
                                            
                                             </tr>";
                                }
                            } else{
                                echo "<tr><td colspan='6'><center>No Teachers Found<center></td></tr>";
                            }

                        } else {
                            echo "<tr><td colspan='6'><center>Database Error! ". mysqli_error($db_conn) ."<center></td></tr>";
                        }
                    } else {
                        $sql = "SELECT teacher.username, teacher.name, teacher.designation, teacher.email, teacher.phone, teacher.department, department.name AS dept_name FROM teacher LEFT JOIN department ON department.id = teacher.department WHERE active = 1 ORDER BY dept_name, teacher.designation, teacher.name";
                        if($result = mysqli_query($db_conn, $sql)){
                            while ($row = mysqli_fetch_assoc($result)){
                                echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['designation'] . "</td>
                                            <td>" . $row['dept_name'] . "</td>
                                            <td>" . $row['email'] . "</td>
                                            <td>" . $row['phone'] . "</td>
                                            
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'><center>No Teachers<center></td></tr>";
                        }
                    }
                    ?>

                </tbody>
                </table>
                <?php }
                ?>
            </div>
            <!--                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
        </div>



        <!-- Footer -->
        <?php include "includes/footer.php" ?>
    </div>

    <!-- Delete Teacher Modal -->
    <div id="deleteTeacherModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="modalDisplay('deleteTeacherModal', 'none')">&times;</span>
                <h2>Delete Teacher</h2>
            </div>
            <div class="modal-body">
                <p>Select "Delete" below if you want to delete <strong id="name_text">the selected</strong> teacher.</p>
            </div>
            <div class="modal-footer">
                <form name="DeleteTeacher" action="action/delete_teacher.php" method="post">
                    <input name="teacher_id" type="hidden">
                    <input name="teacher_name" type="hidden">
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                <button class="btn btn-secondary" type="button" onclick="modalDisplay('deleteTeacherModal', 'none')">Cancel</button>
            </div>
        </div>
    </div>

    <script src="js/scripts.js" type="text/javascript"></script>
    <script src="js/validation.js" type="text/javascript"></script>

</body>

</html>
