<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    parse_str(file_get_contents("php://input"),$post_vars);
    if(!$topic = Topic::find($post_vars['topic_id']))
        throw new Exception("No topic with that id.");
    $topic->deleteRelatedThreadsAndPosts();
    $topic->deleteRelationWithBoardList();
    $topic->delete();
    echo json_encode($topic);
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>