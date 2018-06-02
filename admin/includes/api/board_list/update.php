<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try {
    if(!isset($_GET['board_list_item_id']))
        throw new Exception("No id Set");
    if(!$board_item = BoardList::find($_GET['board_list_item_id']))
        throw new Excepetion('Ups! That id doesn\'t exist');
    
    parse_str(file_get_contents("php://input"),$post_vars);
    
    $title = trim(strip_tags($post_vars['board_title']));

    $board_item->title = $title;
    if($board_item->save())
        echo json_encode($board_item);    
    
} catch (Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}


?>