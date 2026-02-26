<header class="header-style2">
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom p-0">
    <div class="container-fluid px-1">
      <!-- Logo (Left) -->
      <a class="navbar-brand py-0 me-2" href="index.php">
        <img id="logo" src="../image/logo.png" style="max-width: 110px; height: auto;" alt="logo">
      </a>

      <!-- Right-side icons (Profile, Search, Membership) - Mobile & Desktop -->
      <!-- Order: Brand, Icons, Toggler (Mobile) || Brand, Menu, Icons (Desktop) -->
      <div class="attr-nav order-lg-last ms-auto d-flex align-items-center">
        
        <!-- Search Icon (Visible on all screens) -->
        <a href="#!" class="nav-link p-2"><i class="fas fa-search"></i></a>
        
        <!-- Membership Button (Visible on Large Screens Only) -->
        <a href="membership.php" class="btn btn-primary btn-sm ms-1 d-none d-lg-inline-block">
          <i class="fa fa-gem"></i> <span>Membership</span>
        </a>

        <?php if (isset($_SESSION['user_id']) || isset($_SESSION['username'])): ?>
            <!-- Logged In: Profile Dropdown -->
            <div class="dropdown ms-1">
              <a href="#" class="btn btn-outline-dark btn-sm dropdown-toggle d-flex align-items-center" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius:20px; font-weight:600;">
                 <i class="fa fa-user me-1"></i> <span>Profile</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="logout.php"><i class="fa fa-sign-out me-1"></i> Logout</a></li>
              </ul>
            </div>
        <?php else: ?>
            <!-- Guest: Show Login & Sign Up (Visible on all screens, collapse to icons on mobile if needed, but buttons fit okay usually) -->
             <a href="login.php#login" class="btn btn-outline-dark btn-sm ms-2" style="border-radius:20px; font-weight:600;">
                Log In
             </a>
             <a href="login.php#signup" class="btn btn-dark btn-sm ms-2" style="border-radius:20px; font-weight:600;">
                Sign Up
             </a>
        <?php endif; ?>
      </div>

      <!-- Toggler (Mobile) -->
      <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse"
        data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu Items (Center) -->
      <div class="collapse navbar-collapse order-lg-2" id="mainNav">
        <ul class="navbar-nav mx-auto">
          <?php 
            $current_page = basename($_SERVER['PHP_SELF']); 
            function isActive($page) {
                global $current_page;
                return ($current_page == $page) ? 'active' : '';
            }
          ?>
          <!-- Home -->
          <li class="nav-item <?php echo isActive('index.php'); ?>"><a class="nav-link" href="index.php">HOME</a></li>

          <!-- Pages dropdown -->
          <li class="nav-item dropdown <?php echo (in_array($current_page, ['about.php', 'team.php', 'time.php', 'error.php'])) ? 'active' : ''; ?>">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              PAGES
            </a>
            <ul class="dropdown-menu" aria-labelledby="pagesDropdown">
              <li><a class="dropdown-item" href="about.php">About</a></li>
              <li><a class="dropdown-item" href="team.php">Team</a></li>
              <li><a class="dropdown-item" href="time.php">Tee-Time</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="error.php">404 Page</a></li>
            </ul>
          </li>

          <!-- Course dropdown -->
          <li class="nav-item dropdown <?php echo (in_array($current_page, ['coaching.php', 'tounament.php'])) ? 'active' : ''; ?>">
            <a class="nav-link dropdown-toggle" href="#" id="courseDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              COURSE
            </a>
            <ul class="dropdown-menu" aria-labelledby="courseDropdown">
              <li><a class="dropdown-item" href="coaching.php">Golf Coaching</a></li>
              <li><a class="dropdown-item" href="tounament.php">Host Tournament</a></li>
            </ul>
          </li>

          <!-- Other Links -->
          <li class="nav-item <?php echo isActive('service.php'); ?>"><a class="nav-link" href="service.php">SERVICE</a></li>
          <li class="nav-item <?php echo isActive('blog.php'); ?>"><a class="nav-link" href="blog.php">BLOG</a></li>
          <li class="nav-item <?php echo isActive('contact.php'); ?>"><a class="nav-link" href="contact.php">CONTACT</a></li>
        </ul>
      </div>

    </div>
  </nav>
</header>


