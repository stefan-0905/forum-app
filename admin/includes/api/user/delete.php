<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    if(!isset($_GET['user_id']))
        throw new Exception("You must set user_id");
    if(!$user = User::find($_GET['user_id']))
        throw new Exception("No user with this id.");
    
    if($user->delete())
        echo json_encode(
            array('message' => 'Successfully deleted user')
        );
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>