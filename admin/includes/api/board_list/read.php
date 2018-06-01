<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    if(!$board_list = BoardList::find_all())
        throw new Exception("No Board List items");
     echo json_encode($board_list);
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>