<nav class="site-header py-1">
    <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2" href="#" aria-label="Product">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
                 stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mx-auto" role="img"
                 viewBox="0 0 24 24" focusable="false"><title>Product</title>
                <circle cx="12" cy="12" r="10"/>
                <path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94"/>
            </svg>
        </a>
        <a class="py-2 d-none d-md-inline-block" href="<?php echo ROOT; ?>">Home</a>
        <a class="py-2 d-none d-md-inline-block" href="<?php echo ROOT; ?>/home/about">About us</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Features</a>
        <?php if (isLoggedIn()): ?>
            <a class="py-2 d-none d-md-inline-block" href="<?php echo ROOT;?>/users/posts">Posts</a>
            <a class="py-2 d-none d-md-inline-block" href="<?php echo ROOT;?>/users/post">Sale Car</a>
            <a class="py-2 d-none d-md-inline-block" href="<?php echo ROOT; ?>/users/logout">Logout</a>
            <span class="py-2 d-none d-md-inline-block" href="#">Hello <?php echo $_SESSION['user_email']; ?></span>
        <?php else : ?>
            <a class="py-2 d-none d-md-inline-block" href="#">Enterprise</a>
            <a class="py-2 d-none d-md-inline-block" href="<?php echo ROOT; ?>/users/register">Register</a>
            <a class="py-2 d-none d-md-inline-block" href="<?php echo ROOT; ?>/users/login">Login</a>
        <?php endif; ?>
    </div>
</nav>
<hr>