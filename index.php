<?php include "includes/header.php";
// Initializing Board List 
$board_list = BoardList::find_all();

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
}

include "includes/nav.php";
include "includes/showcase.php"; ?>

<!-- CONTENT -->
        <div class="row m-3 px-3">
        
            <main id="main-content" class="col-lg-9 mt-4 px-0">
                <div class="card border-0">
                    <div class="card-header pt-3 px-3">
                        <h3>Online Forum Comunity</h3>
                        <hr>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab accusantium alias, aliquam commodi cum dolorem dolores ea error fugiat molestias nemo neque recusandae rem similique sit soluta vero vitae voluptas.</p>
                    </div>
                    <div class="card-body">
                    <?php 
                    if($board_list) {
                    $i = 0; // Iterator needed for creating individual id name for accordion
                    foreach($board_list as $board_item) : ?>
                        <header class="mb-4">
                            <h4>
                                <a href="#<?php echo "multiCollapse" . ++$i; ?>"
                                   data-toggle="collapse" role="button"
                                   aria-expanded="false" aria-controls="<?php echo "multiCollapse" . $i; ?>">
                                    <small><i style="position:relative; bottom:3px;" class="fa fa-chevron-up align-center"></i></small> <?php echo $board_item->title; ?>
                                </a>
                                <?php if($session->is_signed_in() && $privU->hasPrivilege('board_topic_management')) : ?>
                                <ul class="pull-right list-inline">
                                    <li class="list-inline-item">
                                        <a id="<?php echo $board_item->id; ?>" data-toggle="modal" data-target="#addTopicModal" class="text-secondary" title="Quick Add Topic"><small><i class="fa fa-plus"></i></small></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-secondary" title="Edit Board Item"><small><i class="fa fa-gear"></i></small></a>
                                    </li>
                                </ul>
                                <?php endif; ?>
                            </h4>
                        </header>
                        
                        <div id="<?php echo "multiCollapse" . $i; ?>" class="collapse multi-collapse show">
                        <?php $topics = Topic::getRelatedTopics($board_item->id); 
                        if(!empty($topics)) {
                        foreach($topics as $topic) : ?>
                            <div class="row topic">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="media my-1 p-1">
                                        <img src="img/topic_default.png" style="width:50px;height:50px;" alt="Board Topic" class="d-flex mr-3 align-self-center">
                                        <div class="media-body">
                                            <h6 class="mt-0"><a href="topic.php?topic_id=<?php echo $topic->id; ?>"><?php echo $topic->title; ?></a></h6>
                                            <span class="text-muted"><?php echo $topic->description; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-right d-none d-lg-block">
                                    <div class="my-1 p-1">
                                        <p class="text-muted m-0"><?php echo Thread::count_by_topic_id($topic->id); ?> threads</p>
                                        <p class="text-muted m-0"><?php echo Post::count_by_topic_id($topic->id); ?> posts</p>
                                    </div>
                                </div>
                                <?php $latest_thread = Thread::getLastThread($topic->id);
                                if(!empty($latest_thread)) {
                                ?>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="media my-1 p-1 text-md-left text-sm-right">
                                        <img src="img/profile_images/<?php echo User::find($latest_thread->user_id)->profile_avatar; ?>" style="width:40px;height:40px;" alt="User Avatar"
                                             class="d-flex mr-3 align-self-center rounded">
                                        <div class="media-body">
                                            <h6 class="my-0"><a href="thread.php?thread_id=<?php echo $latest_thread->id; ?>"><?php echo $latest_thread->subject; ?></a></h6>
                                            <a href="#"><?php echo User::find($latest_thread->user_id)->username; ?></a> - <span class="text-muted"><?php echo dateDiff($latest_thread->created_at, 'now'); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <hr>
                            <?php endforeach; } ?>
                        </div>
                        <?php endforeach; } ?>
                    </div>
                </div>
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
                            <img src="img/profile_images/<?php echo User::find($topThread->user_id)->profile_avatar; ?>" style="width:40px;height:40px;" alt="" class="d-flex mr-3 align-self-center">
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

$script_array = array (
    'js/signin_ajax.js',
    'js/add_topic_ajax.js',
    'js/main.js'
);
footer($script_array); ?>