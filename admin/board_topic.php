<?php include "includes/header.php"?>
<?php
$access_permision = "board_topic_management";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
    if(!$privU->hasPrivilege($access_permision)) {
        //$session->logout();
        $_SESSION['message'] = "You do not have privilege to access this url";
        redirect("../index.php");
    }
}else
    redirect("signin.php");
?>
<?php include "includes/top_nav.php" ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark col-md-2">
    <ul class="navbar-nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                <i class="fa fa-id-card"></i>
                <span class="nav-link-text">Role Management</span>
            </a>
            <ul class="ml-4 navbar-nav flex-column collapse" id="collapseComponents">
                <li class="nav-item">
                    <a href="roles.php" class="nav-link">Roles</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="users.php"><i class="fa fa-users"></i> Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="board_topic.php"><i class="fa fa-folder-open"></i> Board & Topics</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="comments.php"><i class="fa fa-comments"></i> Comments</a>
        </li>
    </ul>
</nav>


<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>