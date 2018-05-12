<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a href="index.php" class="navbar-brand">Gemforum</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNav" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item px-2">
                    <a href="index.php" class="nav-link active">Home</a>
                </li>
                <li class="nav-item px-2">
                    <a href="posts.html" class="nav-link">Information</a>
                </li>
                <li class="nav-item px-2">
                    <a href="categories.html" class="nav-link">Download</a>
                </li>
                <li class="nav-item px-2">
                    <a href="categories.html" class="nav-link">Official Site</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if(!$session->is_signed_in()) : ?>
                <li class="nav-item mr-3 align-self-center">
                    <button data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-sm">Log In</button>
                </li>
                <li class="nav-item mr-3 align-self-center">
                    <a href="register.php" class="btn btn-danger btn-sm">Register</a>
                </li>
                <?php else : ?>
                <li class="nav-item dropdown mr-3">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> Welcome, Stefan
                    </a>
                    <div class="dropdown-menu">
                        <a href="profile.html" class="dropdown-item">
                            <i class="fa fa-user-circle"></i> Profile
                        </a>
                        <a href="settings.html" class="dropdown-item">
                            <i class="fa fa-gear"></i> Settings
                        </a>
                        <a href="admin/includes/logout.php" class="dropdown-item">
                            <i class="fa fa-user-times"></i> Logout
                        </a>
                    </div>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>