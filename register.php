<?php
include "includes/header.php";
include "includes/nav.php";
include "includes/showcase.php";


if(isset($_POST['register'])) {
    if($_POST['password'] == $_POST['confirm_password']) {
        if ($new_user = new User()) {
            $new_user->email = $_POST['email'];
            $new_user->username = $_POST['username'];
            $new_user->password = $_POST['password'];

            $new_user->save();
            $session->login($new_user);
            redirect('index.php');
        }
    }
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <h3>Please register to get full experience!</h3>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus amet, assumenda aut autem eaque eius molestiae quaerat rem sint tenetur? Accusantium asperiores, beatae distinctio eius eligendi eveniet incidunt laboriosam odit quos ratione reprehenderit repudiandae sed sint suscipit tempora totam, voluptate?</p>
        </div>
        <div class="col-md-5">
            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="email" class="sr-only">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="sr-only">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <input type="submit" name="register" value="Register" class="btn btn-primary pull-right">
                </div>
            </form>
        </div>
    </div>
</div>


<?php include "includes/footer.php"; ?>


