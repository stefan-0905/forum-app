<?php 
require_once "admin/includes/init.php";
include "includes/header.php";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
}

if(!isset($_GET['topic_id']))
    redirect("error404.php?message=Topic ID does not exist");

include "includes/nav.php";
include "includes/showcase.php"; ?>
<!-- CONTENT -->
<div class="row mt-5">
    
    <main id="main-content" class="col-lg-10 mx-auto bg-light py-3">
        <header>
            <h3>New Thread</h3>
            <p class="text-secondary">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Et, voluptates ad? Reprehenderit inventore rerum natus omnis iusto, placeat iste nihil!</p>
        </header>
        <form class="mb-3" method="POST">
        
            <div class="form-group">
                <label for="subject">Subject: <span class="text-danger">*</span></label>
                <input id="subject" name="subject" type="text" placeholder="Subject" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="message">Message: <span class="text-danger">*</span></label>
                <textarea rows="5" placeholder="Message" id="message" name="content" class="form-control w-100"></textarea>
            </div>
            <input type="hidden" id="topic_id" name="user_id" value="<?php echo $_GET['topic_id']; ?>">
            <input type="button" id="create-thread" name="create_thread" class="pull-right btn btn-success" value="Create Thread"/>
        </form>
    </main>
</div>

<?php
include "includes/modals/signin_modal.php"; 
include "includes/modals/add_topic_modal.php"; 

$script_array = array (
    'js/create_thread.js',
    'js/signin_ajax.js', 
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js',
    'js/main.js',
    'js/froala.js'
);
footer($script_array); ?>