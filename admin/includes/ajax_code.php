<?php
require("init.php");


if(isset($_POST['delete_board_item']))
{
    try {
        if(!$board_item = BoardList::find($_POST['board_item_id']))
            throw new Exception('Ups! Something went wrong');
        if($board_item->delete())
            echo "Successfully deleted item";
    } catch(Exception $ex) {
        redirect("../../error404.php?message=".$ex->getMessage());
    }
}
if(isset($_POST['update_board_item']))
{
    try {
        if(!$board_item = BoardList::find($_POST['board_item_id']))
            throw new Excepetion('Ups! That id doesn\'t exist');
        $board_item->title = trim(strip_tags($_POST['board_title']));
        if($board_item->save())
            echo "Success";
    } catch(Exception $ex) {
        redirect("../../error404.php?message=".$ex->getMessage());
    }
}

if(isset($_POST['delete_user'])) {
    $user = User::find($_POST['user_id']);
    echo $user->id;
    $user->delete();
}

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