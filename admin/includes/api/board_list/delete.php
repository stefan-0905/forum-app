<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    if(!isset($_GET['board_list_item_id']))
        throw new Exception("No ID set.");
    if(!$board_item = BoardList::find($_GET['board_list_item_id']))
        throw new Exception("No item with that ID.");

    if($board_item->delete()) {
        echo json_encode(
            array('message' => 'Successfully deleted item')
        );
    } else echo json_encode(
        array('message' => 'Something went wrong')
    );
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex.getMessage())
    );
}

?>