<?php 
require_once("includes/init.php");
$site_title = "Dashboard";
include "includes/header.php";
$access_permision = "admin_panel";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
    if(!$privU->hasPrivilege($access_permision)) {
        $_SESSION['message'] = "You do not have privilege to access this url";
        //$session->logout();
        redirect("signin.php");
    }
} else {
    $_SESSION['message'] = "You must log in as admin first";
    redirect("signin.php");
}

include "includes/top_nav.php"; ?>
<div class="row no-gutters">
    <aside class="col-md-2">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                        <i class="fa fa-id-card"></i>
                        <span class="nav-link-text">Role Management</span>
                    </a>
                    <ul class="ml-4 navbar-nav flex-column collapse" id="collapseComponents">
                        <li class="nav-item">
                            <a href="roles.php" class="nav-link">Roles</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php"><i class="fa fa-users"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="board_topic.php"><i class="fa fa-folder-open"></i> Board & Topics</a>
                </li>
            </ul>
        </nav>
    </aside>
    <main class="col-md-10">
        <div class="container pt-2 pl-3">

        <h1>Dashboard</h1>
        <?php $reported_posts = ReportedPost::find_all();
        if(!empty($reported_posts)) :
        ?>
        <div id="reported-posts" class="col border p-3">
        <h6>You have some reported posts you need to attend to.<p class="small">Please check them out down below.</p></h6>
        
        <div class="row">
            <div class="col">
                Reported User
            </div>
            <div class="col">
                Reported By
            </div>
            <div class="col col-md-5 d-none d-md-block">
                Options
            </div>
        </div>
        <hr/>
        <?php foreach($reported_posts as $reported_post) : ?>
        <div class="row">
            <div class="col">
            <?php echo User::find(Post::find($reported_post->post_id)->user_id)->username; ?>
            </div>
            <div class="col">
            <?php echo User::find($reported_post->reported_by)->username; ?>
            </div>
            <div class="col col-12 col-md-5">
                <a href="../thread.php?thread_id=<?php echo Post::find($reported_post->post_id)->thread_id; ?>#post<?php echo $reported_post->post_id; ?>" 
                    class="view btn btn-sm btn-info text-light mr-0 py-0">View Post</a>
                <a data-post-id="<?php echo $reported_post->post_id; ?>"
                    data-report-id="<?php echo $reported_post->id; ?>" 
                    class="approve-report btn btn-sm btn-success text-light py-0"
                    data-toggle="tooltip" 
                    data-placement="top" 
                    title="Accept Report and Delete Post">Approve</a>
                <a class="reject-report btn btn-sm btn-danger text-light py-0"
                    data-report-id="<?php echo $reported_post->id; ?>" 
                    data-toggle="tooltip" 
                    data-placement="top" 
                    title="Reject Report">Reject</a>
            </div>
        </div>
        <hr/>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>

        </div>
    </main>
</div>


<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="js/reported_users.js"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
</script>
</body>
</html>