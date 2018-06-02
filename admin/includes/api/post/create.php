<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try 
{
    $json = file_get_contents("php://input");
    $decoded = json_decode($json, true);

    if(!isset($decoded['reply_message']) || empty($decoded['reply_message']))
        throw new Exception("You must write something.");
    if(!isset($decoded['thread_id']) || empty($decoded['thread_id']))
        throw new Exception("No thread ID set");

    $new_post = new Post();    
    $new_post->thread_id = $decoded['thread_id'];
    $new_post->user_id = $session->user_id;
    $new_post->message = $decoded['reply_message'];

    if($new_post->save()) {
        $post_user = User::find($session->user_id);
        $post_user->number_of_posts++;
        if($post_user->save())
            echo json_encode(
                array('message' => 'Successfully posted message.')
            );
    }
            
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}