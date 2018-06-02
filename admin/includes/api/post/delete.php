<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try 
{
    if(!isset($_GET['post_id']))
        throw new Exception("No ID set. Cannot delete post without it.");
    if(!$post = Post::find($_GET['post_id']))
        throw new Exception("Unknown ID.");
    if($post->delete())
        echo json_encode(
            array('message' => 'Post successfully deleted.')
        );
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex.getMessage())
    );
}