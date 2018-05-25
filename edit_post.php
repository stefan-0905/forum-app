<?php 
require_once "admin/includes/init.php";
include "includes/header.php";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
} else {
    redirect('index.php');
}
if(!isset($_GET['post_id'])) 
    redirect("error404.php?message=This page doesn't exist.");
$post = Post::find($_GET['post_id']);
if($session->user_id == $post->user_id OR $privU->hasPrivilege('user_management')) {

include "includes/nav.php";
include "includes/showcase.php"; ?>

<!-- CONTENT -->
<div class="row no-gutters m-3 px-3">   
    <main id="main-content" class="col-lg-10 mx-auto bg-light">
        <div id="edit-profile-form" class="card border-0">
            <div class="card-header border-bottom-0 text-light bg-dark">
                <div class="row no-gutters">
                    <?php $post_user = User::find(Post::find($_GET['post_id'])->user_id); ?>
                    <div class="col-md-2 text-center">
                        <img src="img/profile_images/<?php echo $post_user->profile_avatar; ?>" 
                             style="width:100px;height:100px;" 
                             class="d-inline-block" 
                             alt="User Avatar"/>
                    </div>
                    <div class="col-md-10">
                        <h3><?php echo strtoupper($post_user->username); ?></h3>
                        <p class="m-0">Member since 
                        <?php $date = new DateTime($post_user->created_at);
                        echo $date->format('F jS Y'); ?></p>
                        <p class="m-0">Posts: <?php echo $post_user->number_of_posts; ?></p>
                    </div>
                </div>
            </div>
            <div class="card-body text-light">
                <form action="includes/update_post.php?post_id=<?php echo $post->id ?>" method="POST">
                <?php 
                if(!empty($_GET['errors'])) 
                {
                    $errors = unserialize($_GET['errors']);
                    echo "<p class='alert alert-danger'>";
                    foreach($errors as $error)
                        echo $error . "<br/>";
                    echo "</p>";
                } 
                $thread = Thread::find($post->thread_id);
                if($thread && $thread->user_id == $post->user_id) :
                ?>
                <div class="form-group">
                    <label for="thread-subject">Thread Subject:</label>
                    <input type="text" 
                           class="form-control" 
                           name="thread_subject" 
                           id="thread-subject" value="<?php echo $thread->subject; ?>" required/>
                </div>    
                <?php endif; ?>
                <div class="form-group">
                    <label for="message">Your Message:</label>
                    <textarea rows="5" 
                              placeholder="Message" 
                              id="message" 
                              name="content" 
                              class="form-control w-100" required><?php echo $post->message; ?></textarea>
                </div>
                <a 
                href="
                <?php 
                if($privU->id == $_GET['post_id'])
                    echo "edit_profile.php?user_id=" . Post::find($_GET['post_id'])->user_id; 
                elseif($privU->hasPrivilege('user_management'))
                    echo "thread.php?thread_id=".$post->thread_id."#post".$post->id;
                ?>" 
                class="btn btn-lg btn-secondary">Cancel</a>
                <input type="submit" name="update_post" value="Update Post" class="pull-right btn btn-lg btn-warning"/>
                </form>
            </div>
        </div>
    </main>
</div>

<?php
} else redirect("error404.php?message=You are not eligible to do this action");

include "includes/modals/signin_modal.php"; 
include "includes/modals/add_topic_modal.php"; 

$script_array = array (
    'js/signin_ajax.js',
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js',
    'js/main.js',
    'js/froala.js'
);
footer($script_array); ?>