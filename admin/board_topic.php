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
        <div class="container pt-2 pl-3">
            <div id="board-list" class="pull-left card w-50 d-inline-block">
                <div class="card-header pt-3 px-3">
                    <h3>Board Items</h3>
                    <hr>
                    <p class="lead">Take control over your board list and customize it to your needs.</p>
                </div>
                <div class="card-body pt-2">
                    <ul class="list-unstyled">
                        <li>
                            <i id="create-item" class="pull-left mt-2 ml-4 text-success fa fa-plus" title="Create new Board Item"></i>
                        </li>
                        <br>
                        <hr class="mt-4">
                        <?php $board = BoardList::find_all();
                        foreach($board as $board_item) : ?>
                        <li>
                            <h3 class="w-75 d-inline-block"><?php echo $board_item->title; ?></h3>
                            <span class="pull-right mt-2 btn btn-sm btn-danger py-0">Delete</span>
                        </li>
                        <hr>
                        <?php endforeach; ?>
                        
                    </ul>
                </div>
            </div>
            <div id='create-form' class='w-50 d-none pl-5'>
                <div class="card">
                    <div class="card-header">
                        <h5>Create board Item</h5>
                    </div>
                    <div class="card-body">
                        <form action="includes/board_list_management.php" method="POST">
                            <form-group>
                                <label for="item-title">Title:</label>
                                <input type="text" id='item_title' name='board_item' class="w-75 form-control" required/>
                            </form-group>
                            <input type="submit" id="add-item" name="add_item" class="mt-3 btn btn-primary">
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