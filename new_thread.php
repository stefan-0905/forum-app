
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
                <textarea rows="5" placeholder="Message" id="edit" name="content" class="form-control w-100"></textarea>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $session->user_id; ?>">
            <input type="submit" name="create_thread" class="btn btn-primary" value="Create Thread"/>

        </form>
    </main>
</div>

<?php include "includes/signin_modal.php"; ?>
<?php include "includes/add_topic_modal.php"; ?>


<?php include "includes/footer.php"; ?>