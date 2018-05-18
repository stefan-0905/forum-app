<?php

if(isset($_GET['user_id'])) 
{
    if(isset($_POST['save_changes']) && !empty($_POST['username']))
    {
        $user = User::find($_GET['user_id']);
        $user->username = $_POST['username'];
        
    }
} else {
    $_SESSION['message'] = "Unknown user";
}





?>