<?php 
require_once("includes/init.php");
$site_title = "Roles";
include "includes/header.php";
$access_permission = "role_management";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
    if(!$privU->hasPrivilege($access_permission)) {
        //$session->logout();
        $_SESSION['message'] = "You do not have privilege to access this url";
        redirect("../index.php");
    }
}else
    redirect("signin.php");

if((isset($_GET['role_id']))) {
    $edit_role = Role::find($_GET['role_id']);
    $edit_role_permissions = Role::getRolePerm($edit_role->id);
}

include "includes/top_nav.php"; ?>
<div class="row no-gutters">
<aside class="col-md-2 p-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="nav-item  active" data-toggle="tooltip" data-placement="right" title="Components">
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
            <a class="nav-link" href="board_topic.php"><i class="fa fa-folder-open"></i> Board & Topics</a>
        </li>
            <li class="nav-item">
                <a class="nav-link" href="comments.php"><i class="fa fa-comments"></i> Comments</a>
            </li>
        </ul>
    </nav>
</aside>
<div class="col-md-10">
    <div class="container pt-3">
    <div class="row no-gutters">
        <div class="col-md-7">
            <h3>Manage Your Sites Roles and Permissions</h3>
            <p>Want to create role? Just complete form below.</p>
            <form id="role-form"  action="" method="POST">
                <div class="form-group">
                    <label for="role_name" class="sr-only">Role Name:</label>
                    <div class="input-group mb-3">
                        <input type="text" name="role_name" <?php if(isset($_GET['role_id'])) echo "value='{$edit_role->name}'"; ?> class="form-control" placeholder="Role Name...">
                        <?php if(isset($_GET['role_id'])) echo "<input type='hidden' name='role_id' value='{$edit_role->id}'>"; ?>
                        <div class="input-group-append">
                            <?php if(isset($_GET['role_id'])) : ?>
                            <button id="update_role" type="button" name="update_role" class="form-control btn btn-primary"><?php if(isset($_GET['role_id'])) echo "Save Role"; ?></button>
                            <?php else : ?>
                            <button id="create_role" type="button" name="create_role" class="form-control btn btn-primary">Create Role</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <h4>Access Permissions for Role <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#createPermission">Create New</button></h4>
                <hr>

                <?php
                $permissions = Permission::find_all();
                if(!empty($permissions)) {
                $i = 0;
                foreach ($permissions as $permission) : ?>
                <div class="form-group form-check">
                    <?php if(isset($edit_role_permissions) && $edit_role_permissions->hasPerm($permission->name)) : ?>
                    <input type="checkbox" name="selected_permissions[]" <?php echo "checked"; ?> value="<?php echo $permission->id; ?>" class="form-check-input" id="<?php echo "checkbox" . ++$i; ?>">
                    <?php else : ?>
                    <input type="checkbox" name="selected_permissions[]" value="<?php echo $permission->id; ?>" class="form-check-input" id="<?php echo "checkbox" . ++$i; ?>">
                    <?php endif; ?>
                    <label class="form-check-label" for="<?php echo "checkbox" . $i; ?>"><?php echo $permission->name; ?></label>
                </div>
                <?php endforeach; } ?>
            </form>
        </div>
        <div class="col-md-5">
            <div class="container">
                <h5>Roles currently existing</h5>
                <table class="table table-hover">
                    <thead><tr><th>Name</th><th>Controls</th></tr></thead>
                    <tbody id="role_tb">
                    <?php 
                    $roles = Role::find_all();
                    if(!empty($roles)) {
                    foreach ($roles as $role) : ?>
                        <tr>
                            <td><?php echo $role->name; ?></td>
                            <td>
                                <a href="roles.php?role_id=<?php echo $role->id; ?>" class="edit-role text-primary"><i class="fa fa-edit"></i></a>
                                <a data-id="<?php echo $role->id; ?>" class="delete_role text-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>
</div>

<?php include "includes/modals/permission_modal.php"; ?>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>