<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 02-Apr-19
 * Time: 2:59 AM
 */

session_start();
if(session_destroy()) {
    header("Location: index.php");
}
?>
