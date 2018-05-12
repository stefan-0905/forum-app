<?php
require("init.php");

if(isset($_POST['create'])) {
    // Create role & update DOM
        $new_role = new Role();
        $new_role->name = $_POST['role_name'];
        $new_role->save();
        if (isset($_POST['role_permissions']))
            foreach ($_POST['role_permissions'] as $permission) {
                $new_role->saveRolePerm($permission);
            }
        echo json_encode($new_role);
}
if(isset($_POST['update'])) {
    $role = Role::find($_POST['role_id']);
    $role->name = $_POST['role_name'];
    $role->save();
    $role_permissions = Role::getRolePerm($role->id);

    $role_perm_names = array(); // Assigned Permission Names Array
    if (isset($_POST['role_permissions']))
        foreach ($_POST['role_permissions'] as $permission) {
            $role_perm_names[] = Permission::find($permission)->name;
            if (!$role_permissions->hasPerm(Permission::find($permission)->name))
                $role->saveRolePerm($permission);
        }
    $old_perm = array(); // Old Permission Names Array
    foreach ($role_permissions->permissions as $key => $value) $old_perm[] = $key;
    foreach(array_diff($old_perm, $role_perm_names) as $diff_item)
        $role->deleteRolePerm(Permission::find_by_name($diff_item)->id);
    //echo json_encode([$role, $role_permissions]);
}
if(isset($_POST['delete'])) {
    // Delete role & update DOM
    $role = Role::find($_POST['role_id']);
    echo $role->name;
    $role->delete();
}

if(isset($_POST['delete_user'])) {
    $user = User::find($_POST['user_id']);
    echo $user->id;
    $user->delete();
}

if(isset($_POST['update_user_role'])) {
    $user = User::find($_POST['user_id']);
    //if($user->setRole($_POST['role_id']))
        //echo json_encode($user);
        //else echo json_encode($user);
        $user->setRole($_POST['role_id']);
}