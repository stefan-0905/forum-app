<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    parse_str(file_get_contents("php://input"),$post_vars);
    
    if(!$role = Role::find($post_vars['role_id']))
        throw new Exception("No Role with this id.");

    $role->name = $post_vars['role_name'];
    $role->save();
    $role_permissions = Role::getRolePerm($role->id);
    
    $role_perm_names = array(); // Assigned Permission Names Array
    if (isset($post_vars['role_permissions']))
        foreach ($post_vars['role_permissions'] as $permission) {
            $role_perm_names[] = Permission::find($permission)->name;
            if (!$role_permissions->hasPerm(Permission::find($permission)->name))
                $role->saveRolePerm($permission);
        }
    $old_perm = array(); // Old Permission Names Array
    foreach ($role_permissions->permissions as $key => $value) 
        $old_perm[] = $key;
    foreach(array_diff($old_perm, $role_perm_names) as $diff_item)
        $role->deleteRolePerm(Permission::find_by_name($diff_item)->id);

} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>