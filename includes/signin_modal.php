

<!-- LOGIN MODAL -->
<div class="modal" id="loginModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">Login</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="alert alert-danger d-none"></p>
                <form id="signinForm" action="" method="POST">
                    <div class="form-group">
                        <label for="user_username">Username</label>
                        <input id="user_username" name="user_username" type="text" placeholder="Username" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input id="user_password" name="user_password" type="password" placeholder="Password" class="form-control" required/>
                    </div>
                    <div class="modal-footer pb-0">
                        <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" name="signin" class="btn btn-primary signin">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>