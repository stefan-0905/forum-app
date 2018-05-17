<?php include "includes/header.php";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
}

include "includes/nav.php";
include "includes/showcase.php"; ?>
<!-- CONTENT -->
<div class="row mt-5">
    
    <main id="main-content" class="col-lg-10 mx-auto bg-light pt-3">
        <header>
            <h3>New Thread</h3>
            <p class="text-secondary">At begining your threads will need to be approved by our moderators regarding spam issues</p>
        </header>
        <form class="mb-3" action="includes/create_thread.php?topic_id=<?php if(isset($_GET['topic_id'])) echo $_GET['topic_id']; ?>" method="POST">
        
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input id="subject" name="subject" type="text" placeholder="Subject" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea rows="5" placeholder="Message" id="message" name="content" class="form-control w-100"></textarea>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $session->user_id; ?>">
            <input type="submit" name="create_thread" class="btn btn-primary" value="Create Thread"/>

        </form>
    </main>
</div>

<?php
include "includes/signin_modal.php"; 
include "includes/add_topic_modal.php"; 

$script_array = array (
    'js/signin_ajax.js', 
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js',
    'https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.5.1//js/froala_editor.pkgd.min.js',
    'js/main.js',
    'js/froala.js'
);
footer($script_array); ?>