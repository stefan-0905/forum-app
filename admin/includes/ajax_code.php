<?php
require("init.php");

if(isset($_POST['update_user_role'])) {
    $user = User::find($_POST['user_id']);
    $user->setRole($_POST['role_id']);
}

if(isset($_POST['signin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //Method to check database user
    $user_found = User::verify_user($username, $password);

    if($user_found) {
        $session->login($user_found);
        echo "Success";
    } else {
        echo "Your password or username is incorrect";
    }
}

?>