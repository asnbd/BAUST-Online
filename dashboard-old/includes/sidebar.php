<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 13-Apr-19
 * Time: 3:36 AM
 */
?>
<ul class="sidebar navbar-nav">
    <li class="nav-item <?php if($active_page == 'dashboard') echo 'active'; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item <?php if($active_page == 'departments') echo 'active'; ?>">
        <a class="nav-link" href="?p=departments">
            <i class="fas fa-fw fa-table"></i>
            <span>Departments</span></a>
    </li>

        <!--    <li class="nav-item dropdown">-->
<!--        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" data-toggle="dropdown">-->
<!--            <i class="fas fa-fw fa-folder"></i>-->
<!--            <span>Pages</span>-->
<!--        </a>-->
<!--        <div class="dropdown-menu" aria-labelledby="pagesDropdown">-->
<!--            <h6 class="dropdown-header">Login Screens:</h6>-->
<!--            <a class="dropdown-item" href="login.html">Login</a>-->
<!--            <a class="dropdown-item" href="register.html">Register</a>-->
<!--            <a class="dropdown-item" href="forgot-password.html">Forgot Password</a>-->
<!--            <div class="dropdown-divider"></div>-->
<!--            <h6 class="dropdown-header">Other Pages:</h6>-->
<!--            <a class="dropdown-item" href="404.html">404 Page</a>-->
<!--            <a class="dropdown-item" href="blank.html">Blank Page</a>-->
<!--        </div>-->
<!--    </li>-->
<!--    -->
<!--    <li class="nav-item">-->
<!--        <a class="nav-link" href="charts.html">-->
<!--            <i class="fas fa-fw fa-chart-area"></i>-->
<!--            <span>Charts</span></a>-->
<!--    </li>-->
<!--    -->
<!--    <li class="nav-item">-->
<!--        <a class="nav-link" href="tables.html">-->
<!--            <i class="fas fa-fw fa-table"></i>-->
<!--            <span>Tables</span></a>-->
<!--    </li>-->
</ul>
