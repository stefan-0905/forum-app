<?php 
include_once "init.php";

if(isset($_POST['add_item']))
{
    if(!empty($_POST['board_item']))
    {
        $new_item = new BoardList();
        $new_item->title = trim($_POST['board_item']);
        
        if($new_item->save())
            redirect("../board_topic.php");
    }
}



?>