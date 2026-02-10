<header class="header-style2">
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img id="logo" src="../image/logo.png" width="200px" alt="logo">
      </a>
      <button class="navbar-toggler  ms-lg-auto ms-auto me-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-5 ps-5">
          <!-- Home -->
          <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>

          <!-- Pages dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              PAGES
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="about.php">About</a></li>
              <li><a class="dropdown-item" href="team.php">TEAM</a></li>
              <li><a class="dropdown-item" href="time.php">Tee-Time</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="error.php">404 Page</a></li>
            </ul>
          </li>

          <!-- Course dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              COURSE
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="coaching.php">Golf Coaching</a></li>
              <li><a class="dropdown-item" href="tounament.php">Host Tounament</a></li>
            </ul>
          </li>

          <!-- service-menu -->
          <li class="nav-item"><a class="nav-link" href="service.php">SERVICE</a></li>

          <li class="nav-item"><a class="nav-link" href="blog.php">BLOG</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">CONTACT</a></li>
        </ul>
      </div>

      <!-- Right-side icons -->
      <div class="attr-nav ms-lg-3 d-flex align-items-center justify-content-end ">
        <a href="#!" class="nav-link p-2 d-none d-xl-inline-block"><i class="fas fa-search"></i></a>
        <!-- Membership button (keep it?) User didn't say remove. But maybe Profile replaces it? I'll keep it. -->
        <a href="membership.php" class="btn btn-primary ms-2 d-none d-xl-inline-block">Membership</a>

        <?php if (isset($_SESSION['user_id']) || isset($_SESSION['username'])): ?>
            <!-- Logged In: Show Profile & Logout -->
             <a href="profile.php" class="btn btn-outline-dark ms-2" style="border-radius:20px; font-weight:600;">
                <i class="fa fa-user me-1"></i> Profile
             </a>
             <a href="logout.php" class="btn btn-danger ms-2" style="border-radius:20px; font-weight:600;">
                <i class="fa fa-sign-out me-1"></i> Logout
             </a>
        <?php else: ?>
            <!-- Guest: Show Login & Sign Up -->
             <a href="login.php#login" class="btn btn-outline-dark ms-2" style="border-radius:20px; font-weight:600;" onclick="window.location.href='login.php#login'; location.reload();">
                Log In
             </a>
             <a href="login.php#signup" class="btn btn-dark ms-2" style="border-radius:20px; font-weight:600;" onclick="window.location.href='login.php#signup'; location.reload();">
                Sign Up
             </a>
        <?php endif; ?>
      </div>

    </div>
  </nav>
</header>
