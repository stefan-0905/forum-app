<?php 
include_once "../admin/includes/init.php";

if(isset($_POST['create_thread'])) {
    if($_POST['content']!='' && $_POST['subject']!='') {
        $new_thread = new Thread();
    
        $new_thread->topic_id = $_GET['topic_id'];
        $new_thread->user_id = $_POST['user_id']; 
        $new_thread->subject = $_POST['subject'];
        $new_thread->message = $_POST['content'];

        $new_thread->save();
        redirect('../topic.php?topic_id=' . $_GET['topic_id']);
    }
}



?>