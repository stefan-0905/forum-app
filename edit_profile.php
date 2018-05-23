<?php 
require_once "admin/includes/init.php";
include "includes/header.php";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
} else {
    redirect('index.php');
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
                        <img src="img/profile_images/<?php echo $privU->profile_avatar; ?>" 
                             style="width:100px;height:100px;" 
                             class="d-inline-block" 
                             alt="User Avatar"/>
                    </div>
                    <div class="col-md-10">
                        <h3><?php echo strtoupper($privU->username); ?></h3>
                        <p class="m-0">Member since 
                        <?php $date = new DateTime($privU->created_at);
                        echo $date->format('F jS Y'); ?></p>
                        <p class="m-0">Posts: <?php echo $privU->number_of_posts; ?></p>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <ul class="nav nav-tabs" id="editUserTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                    </li>
                </ul>
                <div class="tab-content" id="editUserTabContent">
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                        <div class="text-light py-3">
                            <?php 
                            $user_posts = Post::getUserRelatedPosts($session->user_id);
                            if(!empty($user_posts))
                            foreach($user_posts as $user_post) {
                            ?>
                            <div class="user-post">
                                <div class="w-75 d-inline-block">
                                    <h5>
                                        <a href="thread.php?thread_id=<?php echo $user_post->thread_id; ?>#<?php echo $user_post->id; ?>">
                                        <?php 
                                        $subject = Thread::find($user_post->thread_id)->subject; 
                                        // If string has more then 50 characters 
                                        if(strlen($subject) > 80) {
                                            // Adding 3 dots in string
                                            $subject = wordwrap($subject, 80, '...');
                                            // Cutting string after 3 dots
                                            $subject = substr($subject, 0, strpos($subject, '...')+3);
                                        }   
                                        echo $subject; 
                                        ?>
                                        </a>
                                    </h5>
                                    <p class="mb-0">
                                        <?php 
                                        $message =  $user_post->message;
                                        // If string has more then 200 characters
                                        if(strlen($message) > 200) {
                                        // Adding 3 dots at aproximatly 200th(depends if it hit word) position in string
                                        $message = wordwrap($message, 200, '...'); 
                                        // Because of text editor plugin, each paragraph is saved in separated p tag. 
                                        // This way we join sub p tags in one p tag so that we can easily cut string
                                        $message = str_replace("</p><p>", " ", $message); 
                                        // Cutting string on first position of three dots + 3 so the we include dots also 
                                        $message =  substr($message, 0, strpos($message, '...')+3);
                                        } 
                                        echo $message;
                                        ?>
                                    </p>
                                </div>
                                <div class="user-post-options d-inline w-25 my-auto">
                                    <span class="pull-right">
                                        <a href="edit_post.php?post_id=<?php echo $user_post->id; ?>"><i class="text-warning fa fa-edit"></i></a>
                                        <a href="includes/update_post.php?delete_post=<?php echo $user_post->id; ?>"><i class="text-danger fa fa-times"></i></a>     
                                    </span>
                                </div>
                            </div>
                            <hr/>
                            <?php 
                            } 
                            else echo "<p>You haven't posted yet.</p>"
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <form class="p-3 text-light" 
                              action="includes/update_profile.php?user_id=<?php echo $session->user_id; ?>" 
                              method="POST" 
                              enctype="multipart/form-data">
                            <?php 
                            if(!empty($_GET['errors'])) 
                            {
                                $errors = unserialize($_GET['errors']);
                                echo "<p class='alert alert-danger'>";
                                foreach($errors as $error)
                                    echo $error . "<br/>";
                                echo "</p>";
                            }
                            ?>
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
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                </div>

                
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