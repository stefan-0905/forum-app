<?php
require_once("includes/init.php");
$site_title = "Users";
include "includes/header.php";
$access_permision = "user_management";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
    if(!$privU->hasPrivilege($access_permision)) {
        //$session->logout();
        $_SESSION['message'] = "You do not have privilege to access this url";
        redirect("../index.php");
    }
}else
    redirect("signin.php");

include "includes/top_nav.php"; ?>
<div class="row no-gutters">
    <aside class="col-md-2">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                    <a class="nav-link active" href="users.php"><i class="fa fa-users"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="board_topic.php"><i class="fa fa-folder-open"></i> Board & Topics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="comments.php"><i class="fa fa-comments"></i> Comments</a>
                </li>
            </ul>
        </nav>
    </aside>
    <main class="col-md-10">
        <div class="container pt-2 pl-3">
            <h3 class="mb-4">Overview of Application Users</h3>
            <?php
            $roles = Role::find_all();
            if(!empty($roles)) {
            foreach($roles as $role) { ?>
                <div class="mb-5">
                    <h5 class="mb-2">Users with <?php echo $role->name; ?> role</h5>
                    <div class="row no-gutters data-heading py-2">
                        <div class="col px-2">Id</div>
                        <div class="col px-2">Email</div>
                        <div class="col px-2">Username</div>
                        <div class="col px-2">Controls</div>
                    </div>
                    <hr class="m-0">
                    <?php
                    // Fetching users with  assigned role
                    $sql = "SELECT * FROM users as u JOIN user_role as ur ON u.id = ur.user_id WHERE ur.role_id = " . $role->id;
                    $users = User::find_by_query($sql);
                    if(!empty($users)){ // Print if we found any user
                    foreach($users as $user) : ?>
                        <div class="row no-gutters data-content py-2">
                            <div class="col px-2"><?php echo $user->id; ?></div>
                            <div class="col px-2"><?php echo $user->email; ?></div>
                            <div class="col px-2"><?php echo $user->username; ?></div>
                            <div class="col px-2">
                                <select name="role_change()" id="role-change" class="d-none"><!-- Select option for changing user role -->
                                    <option value="0">Commoner</option>
                                <?php foreach($roles as $role) : ?>
                                    <option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
                                <?php endforeach; ?>
                                </select>
                                <a data-id="<?php echo $user->id; ?>" class="change-role text-primary"><i class="fa fa-edit"></i></a>
                                <a data-id="<?php echo $user->id; ?>" class="delete-user btn btn-sm btn-danger text-light py-0">Delete</a>
                            </div>
                        </div>
                        <hr class="m-0">
                    <?php endforeach; ?>
                    <?php } else echo "<p class='text-secondary font-italic'>There are no users with this role.</p>"; ?>
                </div>
            <?php
            } } else echo "<p class='alert alert-info'>No roles were asigned.</p>"; ?>
            <div class="mb-5">
                <h5 class="mb-2">Common Folks</h5>
                <div class="row no-gutters data-heading py-2">
                    <div class="col px-2">Id</div>
                    <div class="col px-2">Email</div>
                    <div class="col px-2">Username</div>
                    <div class="col px-2">Controls</div>
                </div>
                <hr class="m-0">
            <?php
            // Getting users without role
            $sql = "SELECT * FROM users as u LEFT JOIN user_role as ur ON u.id = ur.user_id WHERE role_id IS NULL";
            $without_role_users = User::find_by_query($sql);
            if(!empty($without_role_users)){
                foreach($without_role_users as $without_role_user) : ?>
                    <div class="row no-gutters data-content py-2">
                        <div class="col px-2"><?php echo $without_role_user->id; ?></div>
                        <div class="col px-2"><?php echo $without_role_user->email; ?></div>
                        <div class="col px-2"><?php echo $without_role_user->username; ?></div>
                        <div class="col px-2">
                            <select name="role_change()" id="role-change" class="d-none">
                            <?php foreach($roles as $role) : ?>
                                <option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
                            <?php endforeach; ?>
                            </select>
                            <a title="Update Role" data-id="<?php echo $without_role_user->id; ?>" class="change-role text-primary"><i class="fa fa-edit"></i></a>
                            <a title="Delete User" data-id="<?php echo $without_role_user->id; ?>" class="delete-user btn btn-sm btn-danger text-light py-0">Delete</a>
                        </div>
                    </div>
                    <hr class="m-0">
                <?php endforeach; ?>
            </div>
            <?php } else { echo "<p class='text-secondary font-italic'>There are no users without role.</p></div>";} ?>
        </div>
    </main>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="js/user_ajax.js"></script>
<script src="js/role_changer.js"></script>
</body>
</html>