<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 02-Apr-19
 * Time: 1:29 AM
 */
require_once "includes/db.php";
require_once('session.php');
?>

<div class="header">
    <div class="header-container">
        <a href="index.php"><img src="img/BAUST-Logo.png" height="55px" alt="BAUST Online" class="logo"></a>
        <nav>
            <ul>
                <?php if(!isset($login_user)){?>
                    <li <?php if($active_page == 'home') echo "class='active'"; ?> ><a href="index.php">Home</a></li>
                    <li <?php if($active_page == 'login') echo "class='active'"; ?> ><a href="login.php">Login</a></li>
                    <li <?php if($active_page == 'signup') echo "class='active'"; ?> ><a href="signup_student.php">Signup</a></li>
                    <li <?php if($active_page == 'about') echo "class='active'"; ?> ><a href="about.php">About</a></li>
                    <li <?php if($active_page == 'contact') echo "class='active'"; ?> ><a href="contact.php">Contact</a></li>
                <?php } else { ?>
                    <li <?php if($active_page == 'home') echo "class='active'"; ?> ><a href="index.php">Home</a></li>
                    <li <?php if($active_page == 'profile') echo "class='active'"; ?> ><a href="dashboard">Dashboard (<?php echo $login_user?>)</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li <?php if($active_page == 'about') echo "class='active'"; ?> ><a href="about.php">About</a></li>
                    <li <?php if($active_page == 'contact') echo "class='active'"; ?> ><a href="contact.php">Contact</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>
