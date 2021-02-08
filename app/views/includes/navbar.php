<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo URLROOT ?>"><?php echo SITENAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link <?php echo (isset($data['currentPage']) && $data['currentPage'] === 'home') ? 'active' : ''; ?>"
                   href="<?php echo URLROOT ?>">Home </a>
                <a class="nav-link <?php echo (isset($data['currentPage']) && $data['currentPage'] === 'about') ? 'active' : ''; ?>"
                   href="<?php echo URLROOT ?>/pages/about">About</a>
            </div>
            <div class="navbar-nav ms-auto">

                <!--                show when not logged in-->
<!--                --><?php //if (!isLoggedIn()): ?>
                    <a class="nav-link <?php echo (isset($data['currentPage']) && $data['currentPage'] === 'register') ? 'active' : ''; ?> "
                       aria-current="page" href="<?php echo URLROOT ?>/users/register">Register</a>
                    <a class="nav-link <?php echo (isset($data['currentPage']) && $data['currentPage'] === 'login') ? 'active' : ''; ?>"
                       href="<?php echo URLROOT ?>/users/login">Login</a>

                    <!--sita linka pasikeisti priklausomai nuo to kur kursiu-->
                    <a class="nav-link <?php echo (isset($data['currentPage']) && $data['currentPage'] === 'allPixels') ? 'active' : ''; ?>"
                       href="<?php echo URLROOT ?>/users/allPixels">All Pixels</a>

<!--                --><?php //else: ?>

                    <!--                show when logged in-->
<!--                    <a disabled class=" nav-link text-white" href="#">Welcom : --><?php //echo $_SESSION['userName'] ?><!--</a>-->

                    <!--pasikeisti linkus nuo to kursiu-->

<!--                    <a class="nav-link --><?php //echo (isset($data['currentPage']) && $data['currentPage'] === 'allPixels') ? 'active' : ''; ?><!--"-->
<!--                       href="--><?php //echo URLROOT ?><!--/users/allPixels">All Pixels</a>-->
<!---->
<!--                    <a class="nav-link --><?php //echo (isset($data['currentPage']) && $data['currentPage'] === 'allPixels') ? 'active' : ''; ?><!--"-->
<!--                       href="--><?php //echo URLROOT ?><!--/users/allPixels">My Pixels</a>-->
<!---->
<!--                    <a class="nav-link --><?php //echo (isset($data['currentPage']) && $data['currentPage'] === 'allPixels') ? 'active' : ''; ?><!--"-->
<!--                       href="--><?php //echo URLROOT ?><!--/users/allPixels">Add New Pixel</a>-->
<!---->
<!--                    <a class="nav-link --><?php //echo (isset($data['currentPage']) && $data['currentPage'] === 'allPixels') ? 'active' : ''; ?><!--"-->
<!--                       href="--><?php //echo URLROOT ?><!--/users/allPixels">Activity Log</a>-->
<!---->
<!--                    <a class="nav-link" href="--><?php //echo URLROOT ?><!--/users/logout">Logout</a>-->
<!--                --><?php //endif; ?>

            </div>
        </div>
    </div>
</nav>