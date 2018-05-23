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
            if($session->user_id == $post_to_edit->user_id)
                redirect("../edit_profile.php");
            else redirect("../thread.php?thread_id=" . $post_to_edit->thread_id . "#post" . $post_to_edit->id);
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
            if($session->user_id == $post_to_edit->user_id)
                redirect("../edit_profile.php");
            else redirect("../thread.php?thread_id=".$post_to_edit->thread_id."#post".$post_to_edit->id);
        }
    }
}

if(isset($_GET['delete_post']) && !empty($_GET['delete_post']))
{
    $post_to_delete = Post::find($_GET['delete_post']);
    $possible_thread = Thread::find($post_to_delete->thread_id);
    if($post_to_delete->delete()) {
        $user = User::find($session->user_id);
        $user->number_of_posts--;
        $user->save();
        // Checking to see if post is OP, in that case we need to delete it's thread also
        if($possible_thread->user_id == $session->user_id && $possible_thread->created_at == $post_to_delete->created_at)
            $possible_thread->delete();
        redirect("../edit_profile.php");
    }
}







?>