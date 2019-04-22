<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 13-Apr-19
 * Time: 12:07 AM
 */

$page = isset($_GET['p']) ? $_GET['p'] : 'overview';

switch ($page) {
    case 'departments':
        $url = 'departments.php';
        break;
    case 'edit_dept':
        $url = 'departments_edit.php';
        break;
    case 'teachers':
    $url = 'teachers.php';
    break;
    case 'add_teacher':
        $url = 'teachers_add.php';
        break;
    case 'edit_teacher':
        $url = 'teachers_edit.php';
        break;
    case 'students':
        $url = 'students.php';
        break;
    case 'add_student':
        $url = 'students_add.php';
        break;
    case 'edit_student':
        $url = 'students_edit.php';
        break;
    case 'courses':
        $url = 'courses.php';
        break;
    case 'add_course':
        $url = 'courses_add.php';
        break;
    case 'edit_course':
        $url = 'courses_edit.php';
        break;
    case 'results':
        $url = 'results.php';
        break;
    case 'overview':
        $url = 'overview.php';
        break;
    default:
        $url = '404.php';
        break;
}

if (file_exists($url)){
    include $url;
} else {
    include '../404.php';
}

?>
