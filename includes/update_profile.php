<?php
include_once "../admin/includes/init.php";

try{
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
        } else {
            throw new Exception('You are coming from an unknown source');
        }
    } else {
        throw new Exception('Trying to update unknown user.');
    }
} catch(Exception $ex) {
    redirect("../error404.php?message=".$ex->getMessage());
}





?>