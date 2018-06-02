<?php
require_once "admin/includes/init.php";
$site_title = "Register";
include "includes/header.php";
include "includes/nav.php";
include "includes/showcase.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <h3>Please register to get full experience!</h3>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus amet, assumenda aut autem eaque eius molestiae quaerat rem sint tenetur? Accusantium asperiores, beatae distinctio eius eligendi eveniet incidunt laboriosam odit quos ratione reprehenderit repudiandae sed sint suscipit tempora totam, voluptate?</p>
        </div>
        <div class="col-md-5">
            <form method="POST">
                <div id="errors" class="alert alert-danger d-none"></div>
                <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username" required/>
                </div>
                <div class="form-group">
                    <label for="email" class="sr-only">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required/>
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required/>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="sr-only">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required/>
                </div>
                <div class="form-group">
                    <input id="register" type="button" name="register" value="Register" class="btn btn-primary pull-right"/>
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include "includes/modals/signin_modal.php";

$script_array = array (
    'js/register.js',
    'js/signin_ajax.js',
    'js/main.js'
);
footer($script_array); ?>


