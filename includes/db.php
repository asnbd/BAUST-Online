<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 02-Apr-19
 * Time: 12:54 AM
 */

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baust_online";

$db_conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$db_conn){
    die('DB Connection Failed: ' . mysqli_connect_error());
}
