<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 02-Apr-19
 * Time: 1:29 AM
 */
?>

<div class="sidebar">
    <a <?php if($active_page == 'dashboard') echo "class='active'"; ?> href="#">Dashboard</a>
    <a <?php if($active_page == 'teachers') echo "class='active'"; ?> href="teachers.php">Teachers</a>
    <a <?php if($active_page == 'students') echo "class='active'"; ?> href="students.php">Students</a>
    <a <?php if($active_page == 'admins') echo "class='active'"; ?> href="admins.php">Admins</a>
    <a <?php if($active_page == 'routines') echo "class='active'"; ?> href="routines.php">Routines</a>
    <a <?php if($active_page == 'admins') echo "class='active'"; ?> href="admins.php">Admins</a>
</div>
