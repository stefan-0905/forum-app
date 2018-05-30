<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    parse_str(file_get_contents("php://input"),$post_vars);
    if(!$report_id = ReportedPost::find($post_vars['report_id']))
        throw new Exception("No post with this id.");
    if($report_id->delete())
        echo json_encode(
            array('message' => 'Report rejected')
        );
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>