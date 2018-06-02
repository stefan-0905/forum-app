<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try 
{
    if(!$posts = Post::find_all())
        throw new Exception("No posts found.");
    echo json_encode($posts);
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex.getMessage())
    );
}