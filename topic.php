<?php include "includes/header.php";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
}

include "includes/nav.php";
include "includes/showcase.php"; ?>

<!-- CONTENT -->
<div class="row m-3 px-3">
    
    <main id="main-content" class="col-lg-9 bg-light mt-4 py-3 px-3 rounded">
        <?php if($topic = Topic::find($_GET['topic_id'])) { ?>
            <header class="mb-5">
                <h3><?php echo $topic->title ?></h3>
                <p class="lead d-inline"><?php echo $topic->description; ?></p>
                <?php if($session->is_signed_in()) : ?>
                <a href="new_thread.php?topic_id=<?php if(isset($_GET['topic_id'])) echo $_GET['topic_id']; ?>" class="pull-right btn btn-outline-success">Create Thread</a>
                <?php endif; ?>
            </header>
            <div>
                <div class="row no-gutters mt-5">
                    <div class="col-md-8">
                        <h5>Thread</h5>
                    </div>
                    <div class="col-md-4">
                        <h5>Last Reply</h5>
                    </div>
                </div>
               

                <!-- PHP CODE HERE -->
                <?php
                if($threads = Thread::getRelatedThreads($_GET['topic_id'])) {
                    foreach($threads as $thread) {
                ?>
                <div class="row no-gutters">
                    <div class="col-md-8 pr-5">
                        <div class="media my-1 p-1">
                            <img src="img/thread_default.png" style="width:50px;height:50px;" class="d-flex mr-3 align-self-center">
                            <div class="media-body">
                                <h6 class="my-0"><a href="thread.php?thread_id=<?php echo $thread->id; ?>"><?php echo $thread->subject ?></a></h6>
                                <small href="#"><a href="#"><?php echo User::find($thread->user_id)->username; ?></a> - <?php  echo dateDiff($thread->updated_at, 'now'); ?></small>
                            </div>
                        </div>
                    </div>
                    <?php $latest_post = Post::getLastPost($thread->id);
                        if(!empty($latest_post)) {
                        ?>
                        <div class="col-lg-4 col-sm-6">
                            <div class="media my-1 p-1 text-md-left text-sm-right">
                                <img src="img/thread_default.png" style="width:40px;height:40px;" alt="User Avatar"
                                        class="d-flex mr-3 align-self-center rounded">
                                <div class="media-body">
                                    <a href="#" class="d-block"><?php echo User::find($latest_post->user_id)->username; ?></a>
                                    <span class="text-muted"><?php echo dateDiff($latest_post->created_at, 'now'); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <hr class="my-1">
                <?php } } else echo "<p class='text-secondary font-italic'>There are no threads yet written for this topic</p>"; ?>
            </div>
        <?php } else { ?>
            <h3 class="alert alert-danger">No topic with that id.</h3> 
        <?php } ?>
    </main>

    <aside id="recent-posts" class="col-lg-3 mt-4 p-0">
        <div class="card border-0">
            <div class="card-header">
                <h3>Recent Threads</h3>
            </div>
            <div class="card-body">
                <?php
                if($topFiveThreads = Thread::topFive()) {
                foreach($topFiveThreads as $topThread) {
                ?>
                <div class="media mb-3">
                    <img src="img/thread_default.png" style="width:40px;height:40px;" alt="" class="d-flex mr-3 align-self-center">
                    <div class="media-body">
                        <h6 class="my-0"><a href="thread.php?thread_id=<?php echo $topThread->id; ?>"><?php echo $topThread->subject; ?></a></h6>
                        <a href="#"><?php echo User::find($topThread->user_id)->username; ?></a> - <span class="text-muted"><?php echo dateDiff($topThread->created_at, 'now'); ?></span>
                    </div>
                </div>
                <?php } } else echo "<p class='font-italic text-secondary'>No recent Threads</p>"; ?>
            </div>
        </div>
    </aside>
</div>

<?php 
include "includes/signin_modal.php";
include "includes/add_topic_modal.php"; 

$script_array = array(
    'js/signin_ajax.js',
    'js/main.js'
);
footer($script_array); ?>