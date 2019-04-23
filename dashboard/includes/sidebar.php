<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 13-Apr-19
 * Time: 3:36 AM
 */
?>
<div class="sidenav">
    <a <?php if($active_page == 'dashboard') echo 'class="active"'; ?> href="index.php"><i class="fas fa-tachometer-alt fa-fw"></i> Dashboard</a>
    <a <?php if($active_page == 'departments') echo 'class="active"'; ?> href="?p=departments"><i class="fas fa-table fa-fw"></i> Departments</a>
    <a <?php if($active_page == 'teachers') echo 'class="active"'; ?> href="?p=teachers"><i class="fas fa-table fa-fw"></i> Teachers</a>
    <?php if ($login_user < 2) { ?>
        <a <?php if($active_page == 'students') echo 'class="active"'; ?> href="?p=students"><i class="fas fa-table fa-fw"></i> Students</a>
    <?php } ?>
    <a <?php if($active_page == 'courses') echo 'class="active"'; ?> href="?p=courses"><i class="fas fa-table fa-fw"></i> Courses</a>
    <a <?php if($active_page == 'results') echo 'class="active"'; ?> href="?p=results"><i class="fas fa-table fa-fw"></i> Results</a>
<!--    <a --><?php //if($active_page == 'admins') echo 'class="active"'; ?><!-- href="?p=admins"><i class="fas fa-table fa-fw"></i> Admins</a>-->
    <a href="#" onclick="modalDisplay('logoutModel', 'block')"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a>
</div>