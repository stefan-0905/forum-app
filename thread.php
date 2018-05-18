<?php include "includes/header.php";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
}

include "includes/nav.php";
include "includes/showcase.php"; ?>

<!-- CONTENT -->
<div class="m-3">
    <main id="main-content" class="col-lg-9 bg-light mx-auto p-5">
        <?php if(isset($_GET['thread_id']) && $thread = Thread::find($_GET['thread_id'])) : ?>
        <header class="mb-5">
            <div class="media">
                <img src="https://placehold.it/80x80" alt="" class="d-flex mr-3">
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
        ?>
        <div class="post row no-gutters mb-3">
            <div class="user-profile-section col-md-3 py-3 text-center">
                <img src="https://placehold.it/80x80" alt="" class="mx-auto mb-3">
                <p><?php echo User::find($post->user_id)->username; ?></p>
                <p>Moderator</p>
                <p>123 posts</p>
            </div>
            <div class="col-md-9 p-2">
                <small>Posted 
                    <?php 
                    echo dateDiff($post->updated_at, 'now');
                    ?>
                </small>
                <div class="d-inline pull-right">
                <?php if($session->is_signed_in() && $session->user_id == $post->user_id) : ?>
                <span><a href="#"><i class="fa fa-pencil"></i></a></span>
                <?php endif; ?>
                <span><a href="#"><i class="fa fa-exclamation-triangle"></i></a></span>
                </div>
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
                <img src="https://placehold.it/80x80" alt="" class="d-flex mx-auto">
                <p><?php echo User::find($session->user_id)->username; ?></p>
                <p>Moderator</p>
                <p>123 posts</p>
            </div>
            <div class="col-md-9 px-3">
                <form action="includes/create_post.php?thread_id=<?php echo $_GET['thread_id']; ?>" method="POST">
                    <textarea rows="5" placeholder="Message" id="reply" name="reply_message" class="w-100"></textarea>
                    <input type="hidden" name="user_id" value="<?php echo $session->user_id; ?>"/>
                    <input type="submit" name="reply" class="btn btn-secondary" value="Reply"/>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </main>
</div>


<?php 
include "includes/signin_modal.php";
include "includes/add_topic_modal.php";

$script_array = array(
    'js/signin_ajax.js', 
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js',
    'js/main.js',
    'js/froala.js'
);

footer($script_array); ?>