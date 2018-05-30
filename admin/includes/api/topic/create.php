<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    parse_str(file_get_contents("php://input"),$post_vars);

    if(empty($post_vars['title']) || empty($post_vars['description']))
        throw new Exception("You have missing fields.");

    $title = trim(strip_tags($post_vars['title']));
    $description = trim(strip_tags($post_vars['description']));
    $new_topic = new Topic();
    $new_topic->title = $title;
    $new_topic->description = $description;
    
    if($new_topic->save() && $new_topic->append_to_board($_POST['board_item_id']))
        echo json_encode($new_topic);
    else echo json_encode(
        array('message' => 'Something went wrong, check your input.')
    );

} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}


?>