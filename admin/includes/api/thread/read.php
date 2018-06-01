<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    if(!$threads = Thread::find_all())
        throw new Exception("No threads");
     echo json_encode($threads);
} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex->getMessage())
    );
}

?>