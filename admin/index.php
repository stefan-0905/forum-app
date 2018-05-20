<?php include "includes/header.php";
$access_permision = "admin_panel";

if($session->is_signed_in()) {
    $privU = PrivilegedUser::find($session->user_id);
    if(!$privU->hasPrivilege($access_permision)) {
        //$session->logout();
        $_SESSION['message'] = "You do not have privilege to access this url";
        redirect("../index.php");
    }
}else
    redirect("signin.php");

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
                <li class="nav-item">
                    <a class="nav-link" href="comments.php"><i class="fa fa-comments"></i> Comments</a>
                </li>
            </ul>
        </nav>
    </aside>
    <main class="col-md-10">
        <div class="container pt-2 pl-3">

        <h1>Dashboard</h1>
        <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                Reported User
            </div>
            <div class="col-md-4">
                Reported By
            </div>
            <div class="col-md-4">
                Options
            </div>
        </div>
        <hr/>
        <?php $reported_posts = ReportedPosts::find_all();
              foreach($reported_posts as $reported_post) {
        ?>
        <div class="row">
            <div class="col-md-4">
            <?php echo User::find($reported_post->reported_user_id)->username; ?>
            </div>
            <div class="col-md-4">
            <?php echo User::find($reported_post->reported_by)->username; ?>
            </div>
            <div class="col-md-4">
            <a href="../thread.php?thread_id=<?php echo $reported_post->thread_id; ?>#post<?php echo $reported_post->bookmark; ?>" class="view btn btn-sm btn-info">View Post</a>
            <a href="#" class="text-success"><span><i class="fa fa-check"></i></span></a>
            <a href="#" class="text-danger"><span><i class="fa fa-times"></i></span></a>
            </div>
        </div>
        <hr/>
        <?php } ?>
        </div>

        </div>
    </main>
</div>


<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>