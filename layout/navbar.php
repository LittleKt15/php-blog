<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php" data-aos="fade-right" data-aos-duration="1000">
            <img src="assets/images/cid.jpg" alt="" style="width: 50px;">
            Hornbill Blog
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" data-aos="fade-left" data-aos-duration="1000">
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><?php echo $_SESSION['user']->name  ?></a>
                    </li>
                    <li class="nav-item">
                        <form action="" method="post">
                            <button type="submit" name="logoutBtn" class="btn nav-link active border-0" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
                        </form>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#signIn" data-bs-toggle="offcanvas" aria-controls="staticBackdrop">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#signUp" data-bs-toggle="offcanvas" aria-controls="staticBackdrop">Sign Up</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<?php
if (isset($_POST['logoutBtn'])) {
    session_destroy();
    header('location:index.php');
}
?>