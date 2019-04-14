<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 13-Apr-19
 * Time: 10:36 PM
 */

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
        $dept_head = $_POST['deptHead'];

        $sql = "INSERT INTO department (name, description, head) VALUES('$dept_name', '$dept_desc', '$dept_head')";

        if($result = mysqli_query($db_conn, $sql)){
            echo "Successful";
        } else {
            echo "Error";
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
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>BAUST Online - Dashboard</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top">

<?php include "includes/header.php" ?>

<div id="wrapper">

    <!-- Sidebar -->
    <?php $active_page = "departments"; include "includes/sidebar.php"; ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Departments</li>
            </ol>

            <!-- Department Table -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Departments</div>
                <div class="card-body">

                    <p><button type='button' class='btn btn-primary' data-toggle="modal" data-target="#addModal">Add</button></p>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Dept. Name</th>
                                <th>Description</th>
                                <th>Head</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Dept. Name</th>
                                <th>Description</th>
                                <th>Head</th>
                                <th>Options</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                                $sql = "SELECT * FROM department";
                                if($result = mysqli_query($db_conn, $sql)){
                                    while ($row = mysqli_fetch_assoc($result)){
                                        echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['description'] . "</td>
                                            <td>" . $row['head'] . "</td>
                                            <td>" . "<button type='button' class='btn btn-success btn-sm'>Edit</button>
                                            <button type='button' class='btn btn-danger btn-sm'>Delete</button>" . "</td>
                                        </tr>";
                                    }
                                }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
<!--                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>-->
            </div>

<!--            <p class="small text-center text-muted my-5">-->
<!--                <em>Departments</em>-->
<!--            </p>-->

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php include "includes/footer.php" ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Add Departmetn Modal-->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="?p=departments" method="post">
                    <div class="form-group">
                        <label for="departmentName">Department Name</label>
                        <input type="text" class="form-control" name="deptName" id="departmentName" placeholder="Enter Department Name">
                    </div>
                    <div class="form-group">
                        <label for="departmentDesc">Description</label>
                        <textarea class="form-control" name="deptDesc" id="departmentDesc" placeholder="Enter Department Description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="departmentHead">Department Head</label>
                        <select class="form-control" name="deptHead" id="departmentHead">
                            <option selected>Choose...</option>
                            <?php
                                $sql = "SELECT username, name FROM teacher";

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
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <input type="submit" value="Add">
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Page level plugin JavaScript-->
<script src="../vendor/datatables/jquery.dataTables.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/script.min.js"></script>

<!-- Demo scripts for this page-->
<script src="js/demo/datatables-demo.js"></script>

</body>

</html>
