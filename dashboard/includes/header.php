<?php
/**
 * Created by PhpStorm.
 * User: Nomaan
 * Date: 13-Apr-19
 * Time: 1:48 AM
 */
?>

<div id="navbar">
    <div class="nav-title">
        <a href="index.html">BAUST Online</a>
    </div>
    <div class="nav-items">
        <a href="profile.php"><i class="fas fa-user-circle fa-fw"></i></a>
        <a href="#" onclick="modalDisplay('logoutModel', 'block')"><i class="fas fa-sign-out-alt fa-fw"></i></a>
    </div>
</div>

<!-- Logout Modal -->
<div id="logoutModel" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" onclick="modalDisplay('logoutModel', 'none')">&times;</span>
            <h2>Ready to Leave?</h2>
        </div>
        <div class="modal-body">
            <p>Select "Logout" below if you are ready to end your current session.</p>
        </div>
        <div class="modal-footer">
            <a class="btn btn-danger" href="logout.php">Logout</a>
            <button class="btn btn-secondary" type="button" onclick="modalDisplay('logoutModel', 'none')">Cancel</button>
        </div>
    </div>
</div>
