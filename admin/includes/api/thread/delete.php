<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    if(!isset($_GET['thread_id']))
        throw new Exception('You must set thread ID.');
    if(!$thread = thread::find($_GET['thread_id']))
        throw new Exception("No thread with this ID.");
    if($thread->delete())
        echo json_encode(
            array('message' => 'Successfully deleted thread')
        );
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>