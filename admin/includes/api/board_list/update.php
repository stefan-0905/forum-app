<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try {
    if(!isset($_GET['board_list_item_id']))
        throw new Exception("No id Set");
    
} catch (Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}


?>