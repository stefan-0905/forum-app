<?php
include_once "../admin/includes/init.php";
if(isset($_GET['user_id'])) 
{
    if(isset($_POST['save_changes']) && !empty($_POST['username']))
    {
        $user = User::find($_GET['user_id']);
        $user->username = $_POST['username'];
        $user->saveAvatar($_FILES['avatar']);
        
        if($user->save())
            if(!empty($user->errors))
                redirect('../edit_profile.php?errors='.serialize($user->errors));
            else redirect('../edit_profile.php');
    }
} else {
    $_SESSION['message'] = "Unknown user";
}





?>