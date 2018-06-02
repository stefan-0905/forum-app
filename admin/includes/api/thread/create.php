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

    
    if($decoded['message']!='' && $decoded['subject']!='') {
        $new_thread = new Thread();
        $new_thread->topic_id = $decoded['topic_id'];
        $new_thread->user_id = $session->user_id; 
        $new_thread->subject = $decoded['subject'];
        if($new_thread->save()) {
            $new_post = new Post();
            $new_post->thread_id = $new_thread->id;
            $new_post->user_id =  $session->user_id;
            $new_post->message = $decoded['message'];
            if($new_post->save()) {
                $user = User::find($session->user_id);
                $user->number_of_posts++; // Increasing number of posts of specific user 
                if($user->save())
                    echo json_encode(
                        array('message' => 'Successfully created new thread.')
                    );
            }
        }
    }
    

} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>