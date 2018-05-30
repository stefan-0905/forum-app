<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    parse_str(file_get_contents("php://input"),$post_vars);

    if(!$role = Role::find($post_vars['role_id']))
        throw new Exception("No role with this id.");
    
    if($role->delete())
        echo json_encode(
            array('message' => 'Role deleted')
        );
    else 
        throw new Exception("Something went wrong with deletion.");
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}



?>