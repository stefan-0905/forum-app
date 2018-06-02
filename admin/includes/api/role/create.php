<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try 
{
    parse_str(file_get_contents("php://input"),$post_vars);
    $role = new Role();

    if(isset($post_vars['role_name'])) 
    {
        $role->name = trim(strip_tags($post_vars['role_name']));
        if(isset($post_vars['role_permissions']))
            if($role->save()) 
                foreach ($post_vars['role_permissions'] as $permission)
                    $role->saveRolePerm($permission);
    } else 
        throw new Exception("Role name not set");
    echo json_encode($role);
} catch (Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>