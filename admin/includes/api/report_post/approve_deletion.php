<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    parse_str(file_get_contents("php://input"),$post_vars);

    if(!$reported_post = Post::find($post_vars['post_id']))
        throw new Exception("No post with this id.");
    if(!$reported_post_info = ReportedPost::find($post_vars['report_id']))
        throw new Exception("No report with this id.");
    
    if($reported_post->delete())
        if($reported_post_info->delete())
            echo json_encode(
                array('message' => 'Successfully deleted report')
            );
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>