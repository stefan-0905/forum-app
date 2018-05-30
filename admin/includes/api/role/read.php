<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    if(!$roles = Role::find_all())
        throw new Exception("No roles");
    foreach($roles as $role)
        $role->permissions = Role::getRolePerm($role->id)->permissions;
     echo json_encode($roles);
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}






?>