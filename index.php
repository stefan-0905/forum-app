
<?php include "includes/header.php"; ?>
<?php
// Initializing Board List 
$board_list = BoardList::find_all();
?>
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

            <main id="main-content" class="col-lg-9  pl-4 pt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Online Gamers Comunity</h3>
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
                        <?php $board_item->getBoardListItems(); 
                        if(!empty($board_item->list_items)) {
                        foreach($board_item->list_items as $list_item) : ?>
                            <div class="row topic">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="media my-1 p-1">
                                        <img src="https://placehold.it/40x40" alt="" class="d-flex mr-3 align-self-center">
                                        <div class="media-body">
                                            <h6 class="mt-0"><a href="#"><?php echo $list_item['title']; ?></a></h6>
                                            <span class="text-muted"><?php echo $list_item['description']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-right d-none d-lg-block">
                                    <div class="my-1 p-1">
                                        <p class="text-muted m-0">5 threads</p>
                                        <p class="text-muted m-0">50 posts</p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="media my-1 p-1 text-md-left text-sm-right">
                                        <img src="https://placehold.it/40x40" alt="User Avatar"
                                             class="d-flex mr-3 align-self-center rounded">
                                        <div class="media-body">
                                            <h6 class="mt-0"><a href="#">Newest Post</a></h6>
                                            <a href="#">Stex</a> - <span class="text-muted">15 minutes ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <?php endforeach; } ?>
                        </div>
                        <hr>
                        <?php endforeach; } ?>
                    </div>
                </div>
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