<?php 
require_once("includes/init.php");
include "includes/header.php";
$access_permision = "board_topic_management";

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
                <a class="nav-link" href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
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
                <a class="nav-link active" href="board_topic.php"><i class="fa fa-folder-open"></i> Board & Topics</a>
            </li>
        </ul>
    </nav>
    </aside>
    <main class="col-md-10">
        <div class="container row m-2 mx-auto">
            <div id="board-list" class="pull-left card col col-lg-6 px-0 d-inline-block mb-4">
                <div class="card-header pt-3 px-3">
                    <h3>Board Items</h3>
                    <hr>
                    <p class="lead">Take control over your board list and customize it to your needs.</p>
                </div>
                <div class="card-body pt-2">
                    <ul class="list-unstyled">
                        <li>
                            <a href="#create-form"><i id="create-item" class="pull-left mt-2 text-success fa fa-plus" title="Create new Board Item"> New Item</i></a>
                        </li>
                        <br>
                        <hr class="mt-4">
                        <?php 
                        if($board = BoardList::find_all())
                        foreach($board as $board_item) : ?>
                        <li>
                            <div class="row no-gutters">
                                <h3 class="col-8 d-inline-block"><?php echo $board_item->title; ?></h3>
                                <div class="col-12 col-sm d-md-inline-block text-left text-sm-right pt-1">
                                    <span class="edit-title btn btn-sm btn-info py-0">Edit</span>
                                    <span data-id=<?php echo $board_item->id; ?> class="delete-item btn btn-sm btn-danger py-0">Delete</span>
                                </div>
                            </div>
                            <div class="edit-section mt-2" style="display:none;">
                                <form action="" class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="item-title" class="sr-only">Title</label>
                                        <input type="text" class="form-control" id="item-title" placeholder="Title" value="<?php echo $board_item->title; ?>">
                                    </div>
                                    <button type="button" data-item-id=<?php echo $board_item->id; ?> class="update-title btn btn-primary ml-3 mb-2">Okay</button>
                                </form>
                            </div>
                        </li>
                        <hr>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div id='create-form' class='col col-12 col-lg-6 d-none'>
                <div class="card">
                    <div class="card-header">
                        <h5>Create board Item</h5>
                    </div>
                    <div class="card-body">
                        <form action="includes/board_list_management.php" method="POST">
                            <form-group>
                                <label for="item-title">Title:</label>
                                <input type="text" id='item_title' name='board_item' placeholder="Title" class="w-75 form-control" required/>
                            </form-group>
                            <input type="submit" id="add-item" name="add_item" class="mt-3 btn btn-primary" value="Add">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="js/board_list.js"></script>
</body>
</html>