<?php 
include_once "../admin/includes/init.php";

if(isset($_POST['update_post']))
{
    if(isset($_POST['thread_subject']) && !empty($_POST['thread_subject'])) {
        $thread_subject = $_POST['thread_subject'];
        if(!empty($_POST['content']))
        {
            $message = $_POST['content'];
            $post_to_edit = Post::find($_GET['post_id']);
            if($post_to_edit->message != $message){
                $post_to_edit->message = $message;
                $post_to_edit->save();
            }
            $thread_to_edit = Thread::find($post_to_edit->thread_id);
            if($thread_to_edit->subject != $thread_subject) {
                $thread_to_edit->subject = $thread_subject;
                $thread_to_edit->save();
            }
            redirect("../edit_profile.php");
        }
    } else {
        if(!empty($_POST['content']))
        {
            $message = $_POST['content'];
            $post_to_edit = Post::find($_GET['post_id']);
            if($post_to_edit->message != $message){
                $post_to_edit->message = $message;
                $post_to_edit->save();
            }
            redirect("../edit_profile.php");
        }
    }
}










?>