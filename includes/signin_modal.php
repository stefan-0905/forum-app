<?php

if(isset($_POST['signin']))
{
    include "../admin/includes/init.php";
    $username = trim($_POST['user_username']);
    $password = trim($_POST['user_password']);

    //Method to check database user
    $user_found = User::verify_user($username, $password);

    if($user_found) {
        $session->login($user_found);
        redirect("../index.php");
    } else {
        $the_message = "Your password or username is incorrect";
    }

} else {
    $the_message = "";
    $username = "";
    $password = "";
}

?>


<!-- LOGIN MODAL -->
<div class="modal" id="loginModal" style="top:10%">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">Login</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="includes/signin_modal.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" name="user_username" type="text" placeholder="Username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="user_password" type="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="modal-footer pb-0">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" name="signin" class="btn btn-primary" value="Sign In">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>