<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 13-Apr-19
 * Time: 1:48 AM
 */
?>

<nav class="navbar navbar-expand navbar-dark bg-dark static-top navbar-fixed-top">

    <a class="navbar-brand mr-1" href="index.html">BAUST Online</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger">1</span>
            </a>
<!--            <div class="dropdown-menu dropdown-menu-right">-->
<!--                <a class="dropdown-item" href="#">Action</a>-->
<!--                <a class="dropdown-item" href="#">Another action</a>-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a class="dropdown-item" href="#">Something else here</a>-->
<!--            </div>-->
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger"><?php echo $message_count > 9 ? "9+" : $message_count?></span>
            </a>
<!--            <div class="dropdown-menu dropdown-menu-right">-->
<!--                <a class="dropdown-item" href="#">Action</a>-->
<!--                <a class="dropdown-item" href="#">Another action</a>-->
<!--                <div class="dropdown-divider"></div>-->
<!--                <a class="dropdown-item" href="?p=messages">See More</a>-->
<!--            </div>-->
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <p class="dropdown-header" href="#">Asswad Sarker Nomaan</p>
                <a class="dropdown-item" href="#">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
            </div>
        </li>
    </ul>

</nav>
