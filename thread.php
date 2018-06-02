<?php 
require_once "admin/includes/init.php";
try {
    if(!isset($_GET['thread_id']))
        throw new Exception("Navigation system doesnt work like this. You need to set thread_id.");
    if(!$thread = Thread::find($_GET['thread_id']))
        throw new Exception("Thread you are trying to reach doesnt exist.");
} catch(Exception $ex) {
    redirect("error404.php?message=Caught Exception: ". $ex->getMessage());
}
include "includes/header.php";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
}

include "includes/nav.php";
include "includes/showcase.php"; ?>

<!-- CONTENT -->
<div class="m-3">
    <main id="main-content" class="col-lg-9 bg-light mx-auto p-5">
        <?php if($thread) : ?>
        <header class="mb-5">
            <div class="media">
                <img src="img/thread_default.png" style="width:60px;" alt="" class="d-flex mr-3">
                <div class="media-body">
                    <h3 class="mt-0"><?php echo $thread->subject; ?></h3>
                    <p class="text-secondary d-inline-block">
                        <i class="fa fa-user"></i>
                        <span><?php echo User::find($thread->user_id)->username; ?></span>
                        <i class="fa fa-clock-o"></i>
                        <span><?php echo dateDiff($thread->updated_at, 'now'); ?></span>
                    </p>
                    <?php if($session->is_signed_in()) : ?>
                    <a 
                        href="#reply-it" 
                        id="quick-reply" 
                        class="d-inline-block btn btn-outline-success pull-right">Reply</a>
                    <?php endif; ?>
                </div>
            </div>
        </header>
        <hr/>
        <?php 
        if($posts = Post::getRelatedPosts($thread->id)) {
        foreach($posts as $post) {
            $post_user = User::find($post->user_id);
        ?>
        <div id="post<?php echo $post->id; ?>" class="post row no-gutters mb-3">
            <div class="user-profile-section col-md-3 py-3 text-center">
                <img src="img/profile_images/<?php echo $post_user->profile_avatar; ?>" 
                     style="width:40p;height:40px" 
                     alt="" 
                     class="mx-auto mb-3"/>
                <p><?php echo $post_user->username; ?></p>
                <p><?php echo $post_user->number_of_posts; ?> posts</p>
            </div>
            <div class="col-md-9 p-2">
                <small>Posted 
                    <?php 
                    echo dateDiff($post->updated_at, 'now');
                    ?>
                </small>
                <?php if($session->is_signed_in()) : ?>
                <div class="d-inline pull-right">
                <?php if($privU->hasPrivilege('user_management')) : ?>
                <span><a href="edit_post.php?post_id=<?php echo $post->id; ?>"><i class="fa fa-pencil"></i></a></span>
                <?php endif; ?>
                <span>
                    <a data-toggle="modal" data-target="#reportUserModal"
                       data-post-id="<?php echo $post->id; ?>" 
                       class="text-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                    </a>
                </span>
                </div>
                <?php endif; ?>
                <p><?php echo $post->message; ?></p>
            </div>
        </div>
        
        <?php } 
        } else echo "<p class='alert alert-danger'>Something went wrong. Looks like there is no OP for this thread.</p>";
        ?>
        <?php endif; 
        
        if($session->is_signed_in()) :
        ?>
        <div id="reply-it" class="row no-gutters d-none">
            <div class="col-md-3 text-center border-right">
                <img src="img/profile_images/<?php echo User::find($session->user_id)->profile_avatar; ?>" alt="" class="d-flex mx-auto">
                <p><?php echo User::find($session->user_id)->username; ?></p>
                <p><?php echo User::find($session->user_id)->number_of_posts; ?> posts</p>
            </div>
            <div class="col-md-9 px-3">
                <form method="POST">
                    <textarea rows="5" placeholder="Message" id="reply" name="reply_message" class="w-100"></textarea>
                    <input type="hidden" name="thread_id" value="<?php echo $_GET['thread_id']; ?>"/>
                    <input type="button" name="reply" class="btn btn-secondary" value="Reply"/>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </main>
</div>


<?php 
include "includes/modals/signin_modal.php";
include "includes/modals/confirm_report_modal.php";

$script_array = array(
    'js/create_post.js',
    'js/signin_ajax.js', 
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js',
    'js/main.js',
    'js/froala.js'
);

footer($script_array); ?>