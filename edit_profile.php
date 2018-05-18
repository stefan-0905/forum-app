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
    <main id="main-content" class="col-lg-10 mx-auto bg-light pt-3">
        <div class="card border-0">
            <div class="card-header border-bottom-0">
                    <div class="row no-gutters">
                        <div class="col-md-3">
                            <img src="img/profile_images/user_default_blue.png" class="d-inline-block" alt="User Avatar">
                        </div>
                        <div class="col-md-9">
                            <h3><?php echo strtoupper($privU->username); ?></h3>
                            <p class="text-secondary">Member since 
                            <?php $date = new DateTime($privU->created_at);
                            echo $date->format('F jS Y'); ?></p>
                        </div>
                    </div>
                    <hr>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="username">Display Name:</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="image"/>
                        </div>
                        <input type="submit" class="btn btn-primary" name="save_changes" value="Save"/>
                    </form>
            </div>
        <div class="card-body">
    </main>
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