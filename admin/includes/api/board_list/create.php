<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    parse_str(file_get_contents("php://input"),$post_vars);
    $board_list_item = new BoardList();

    if(!isset($post_vars['board_item_title']))
        throw new Exception("No title set");

    $item_title = trim(strip_tags($post_vars['board_item_title']));

    $board_list_item->title = $item_title;

    if($board_list_item->save())
        echo json_encode($board_list_item);

} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>