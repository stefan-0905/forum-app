
<?php include "includes/header.php"; ?>
<?php
// Initializing Board List 
//$threads = Topic::getThreads();
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
    
    <main id="main-content" class="col-lg-9 bg-light pl-4 pt-4">
            <header class="mb-5">
                <h3>Topic Name</h3>
                <p class="lead d-inline">Topic description</p>
                <a href="#" class="pull-right btn btn-outline-success">Create Thread</a>
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
                <div class="row no-gutters">
                    <div class="col-md-8 pr-5">
                        <div class="media my-1 p-1">
                            <img src="https://placehold.it/40x40" alt="" class="d-flex mr-3 align-self-center">
                            <div class="media-body">
                                <h6 class="my-0"><a href="#">Thread Name</a></h6>
                                <small href="#"><a href="#">Stefi</a> - 15/1/2018</small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-1">
                <div class="row no-gutters">
                    <div class="col-md-8 pr-5">
                        <div class="media my-1 p-1">
                            <img src="https://placehold.it/40x40" alt="" class="d-flex mr-3 align-self-center">
                            <div class="media-body">
                                <h6 class="my-0"><a href="#">Thread Name</a></h6>
                                <small href="#"><a href="#">Stefi</a> - 15/1/2018</small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-1">
                <div class="row no-gutters">
                    <div class="col-md-8 pr-5">
                        <div class="media my-1 p-1">
                            <img src="https://placehold.it/40x40" alt="" class="d-flex mr-3 align-self-center">
                            <div class="media-body">
                                <h6 class="my-0"><a href="#">Thread Name</a></h6>
                                <small href="#"><a href="#">Stefi</a> - 15/1/2018</small>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-1">
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