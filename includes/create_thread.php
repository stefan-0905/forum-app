<?php 
include_once "../admin/includes/init.php";

if(isset($_GET['topic_id']) && !empty($_GET['topic_id']))
    if(isset($_POST['create_thread'])) {
        if($_POST['content']!='' && $_POST['subject']!='' && $_POST['user_id']!='') {
            $new_thread = new Thread();
            $new_thread->topic_id = $_GET['topic_id'];
            $new_thread->user_id = $_POST['user_id']; 
            $new_thread->subject = $_POST['subject'];
            if($new_thread->save()) {
                $new_post = new Post();
                $new_post->thread_id = $new_thread->id;
                $new_post->user_id =  $_POST['user_id'];
                $new_post->message = $_POST['content'];
                
                if($new_post->save()) {
                    $user = User::find($_POST['user_id']);
                    $user->number_of_posts++; // Increasing number of posts of specific user 
                    if($user->save())
                        redirect('../topic.php?topic_id=' . $_GET['topic_id']);
                }
            }
        }
    }



?>