<?php 
include_once "../admin/includes/init.php";

if(isset($_GET['thread_id']) && $_GET['thread_id']!="")
    if(isset($_POST['reply']))
        if(isset($_POST['reply_message']) && !empty($_POST['reply_message'])) {
            $new_post = new Post();
            $new_post->thread_id = $_GET['thread_id'];
            $new_post->user_id = $_POST['user_id'];
            $new_post->message = $_POST['reply_message'];

            if($new_post->save()){
                $post_user = User::find($session->user_id);
                $post_user->number_of_posts++;
                if($post_user->save())
                    redirect("../thread.php?thread_id=" . $_GET['thread_id']);
            }
        }


?>