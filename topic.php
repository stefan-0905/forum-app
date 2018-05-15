
<?php include "includes/header.php"; ?>
<?php
include "includes/nav.php";
include "includes/showcase.php";
?>

<?php

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
}

?>

<!-- CONTENT -->
<div class="row m-3">
    
    <main id="main-content" class="col-lg-9 bg-light pl-4 pt-4">
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
                <hr class="my-1"/>

                <!-- PHP CODE HERE -->
                <?php
                if($threads = Thread::getRelatedThreads($_GET['topic_id']) && !empty($threads)) {
                    foreach($threads as $thread) {
                ?>
                <div class="row no-gutters">
                    <div class="col-md-8 pr-5">
                        <div class="media my-1 p-1">
                            <img src="https://placehold.it/40x40" alt="" class="d-flex mr-3 align-self-center">
                            <div class="media-body">
                                <h6 class="my-0"><a href="#"><?php echo $thread->subject ?></a></h6>
                                <small href="#"><a href="#"><?php echo User::find($thread->user_id)->username; ?></a> - <?php  echo date($thread->created_at); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-1">
                <?php } } else echo "<p class='text-secondary font-italic'>There are no threads yet written for this topic</p>"; ?>
            </div>
        <?php } else { ?>
            <h3>No topic with that id.</h3> 
        <?php } ?>
    </main>

    <aside class="col-lg-3 p-4">
        <div class="card">
            <div class="card-header">
                <h3>Recent Posts</h3>
            </div>
            <div class="card-body">
                <div class="media mb-3">
                    <img src="https://placehold.it/40x40" alt="" class="d-flex mr-3 align-self-center">
                    <div class="media-body">
                        <h6 class="mt-0"><a href="#">Lorem ipsum dolor sit amet.</a></h6>
                        <a href="#">Stex</a> - <span class="text-muted">15 minutes ago</span>
                    </div>
                </div>
                <div class="media mb-2">
                    <img src="https://placehold.it/40x40" alt="" class="d-flex mr-3 align-self-center">
                    <div class="media-body">
                        <h6 class="mt-0"><a href="#">Lorem ipsum dolor sit amet.</a></h6>
                        <a href="#">Stex</a> - <span class="text-muted">15 minutes ago</span>
                    </div>
                </div>
                <div class="media">
                    <img src="https://placehold.it/40x40" alt="" class="d-flex mr-3 align-self-center">
                    <div class="media-body">
                        <h6 class="mt-0"><a href="#">Lorem ipsum dolor sit amet.</a></h6>
                        <a href="#">Stex</a> - <span class="text-muted">15 minutes ago</span>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>

<?php include "includes/signin_modal.php"; ?>
<?php include "includes/add_topic_modal.php"; ?>
<?php include "includes/footer.php"; ?>