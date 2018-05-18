<?php include "includes/header.php";
// Initializing Board List 
$board_list = BoardList::find_all();

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
}

include "includes/nav.php";
include "includes/showcase.php"; ?>

<!-- CONTENT -->
<div class="row no-gutters m-3 px-3">   
    <main id="main-content" class="col-lg-10 mx-auto bg-light">
        <div id="edit-profile-form" class="card border-0">
            <div class="card-header border-bottom-0 text-light bg-dark">
                <div class="row no-gutters">
                    <div class="col-md-2 text-center">
                        <img src="img/profile_images/user_default_blue.png" 
                             style="width:100px;height:100px;" 
                             class="d-inline-block" 
                             alt="User Avatar"/>
                    </div>
                    <div class="col-md-10">
                        <h3><?php echo strtoupper($privU->username); ?></h3>
                        <p>Member since 
                        <?php $date = new DateTime($privU->created_at);
                        echo $date->format('F jS Y'); ?></p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="p-3 text-light" action="includes/updated_profile.php?user_id=<?php echo $session->user_id; ?>" method="POST">
                    <div class="form-group">
                        <label for="username">Display Name:</label>
                        <input type="text" class="form-control w-25" name="username" id="username" required/>
                    </div>
                    <div class="form-group">
                        <label for="avatar">Avatar:</label>
                        <input type="file" class="form-control-file" name="avatar"/>
                    </div>
                    <input type="submit" class="btn btn-success" name="save_changes" value="Save"/>
                </form>
            </div>
        </div>
    </main>
</div>

<?php
include "includes/signin_modal.php"; 
include "includes/add_topic_modal.php"; 

$script_array = array (
    'js/signin_ajax.js',
    'js/main.js'
);
footer($script_array); ?>