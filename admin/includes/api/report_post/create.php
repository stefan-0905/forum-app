<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    $reported_post = new ReportedPost();

    if(!isset($_GET['post_id']))
        throw new Exception("No id set");
    
    $post_id = $_GET['post_id'];

    $reported_post->post_id = $post_id;
    $reported_post->reported_by = $session->user_id;
    
    if($reported_post->save()){
        echo json_encode($reported_post);
        http_response_code('200');
    }
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>