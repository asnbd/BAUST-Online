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
    case 'teacher':
        $url = 'teacher.php';
        break;
    case 'overview':
        $url = 'overview.php';
        break;
    default:
        $url = '404.php';
        break;
}

if (file_exists('pages/' . $url)){
    include 'pages/' . $url;
} else {
    include '../404.php';
}

?>
