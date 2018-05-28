<?php
include "includes/init.php";

if($session->is_signed_in()) {
    $access_permision = 'admin_panel';
    $privU = PrivilegedUser::find($session->user_id);
    if($privU->hasPrivilege($access_permision)) {
        redirect("index.php");
    } else {
        $session->logout();
    }
};

if(isset($_POST['submit'])) {
    $username = trim($_POST['user_username']);
    $password = trim($_POST['user_password']);
    if(!empty($username) && !empty($password)) {
        //Method to check database user
        $user_found = User::verify_user($username, $password);

        if($user_found) {
            $session->login($user_found);
            redirect("index.php");
        } else {
            $the_message = "Your password or username is incorrect";
        }
    } else $the_message = "Please fill up form before submiting.";
} else {
    $the_message = $session->message();
    $username = "";
    $password = "";
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Admin - Log In</title>
    <link rel="stylesheet" href="../css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/admin_style.css"/>
</head>
<body id="signin" class="text-center">
    <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"/>
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <?php if(isset($the_message) && !empty($the_message)) : ?>
        <p class="alert alert-danger"><?php echo $the_message; ?></p>
        <?php endif; ?>
        <label for="inputUsername" class="sr-only">Email Username</label>
        <input type="text" id="inputUsername" name="user_username" class="form-control" placeholder="Username" required autofocus/>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="user_password" class="form-control" placeholder="Password" required/>
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="" value="remember-me"/> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2018</p>
    </form>

<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>