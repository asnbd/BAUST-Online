<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 08-Apr-19
 * Time: 12:59 AM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>

<?php $active_page="dashboard"; include("includes/sidebar.php"); ?>

<div class="content">
    <h2>Dashboard</h2>
    <p>Welcome to BASUT Online Dashboard</p>

    <div class="row">
        <div class="column" style="background-color: #B9F6CA;">
            <i class="right_icon material-icons" style="font-size: 130px">person</i>
            <div class="big_text">0</div>
            <p>Students</p>
        </div>
        <div class="column" style="background-color:#A5D6A7;">
            <i class="right_icon material-icons" style="font-size: 130px">account_box</i>
            <div class="big_text">0</div>
            <p>Teachers</p>
        </div>
    </div>

    <div class="row">
        <div class="column" style="background-color: #B9F6CA;">
            <i class="right_icon material-icons" style="font-size: 130px">security</i>
            <div class="big_text">0</div>
            <p>Admins</p>
        </div>
        <div class="column" style="background-color:#A5D6A7;">
            <i class="right_icon material-icons" style="font-size: 130px">class</i>
            <div class="big_text">0</div>
            <p>Classes</p>
        </div>
    </div>
</div>
</body>
</html>
