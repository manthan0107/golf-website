<!-- Sidebar Start -->
<?php
// Get current page name for active state
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-light">
        <a href="index.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>G-Club</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="<?php echo (!empty($_SESSION['admin_image'])) ? 'img/uploads/' . $_SESSION['admin_image'] : 'img/user.jpg'; ?>" alt="" style="width: 40px; height: 40px; object-fit: cover;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; ?></h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="index.php" class="nav-item nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <!--Coach  -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php echo (strpos($current_page, 'coach') !== false) ? 'active' : ''; ?>" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Coaching</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="show_coach.php" class="dropdown-item">Show Coach</a>                            
                </div>
            </div>
            <!-- Tournament=== -->
                <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php echo (strpos($current_page, 'tournament') !== false) ? 'active' : ''; ?>" data-bs-toggle="dropdown"><i class="fa fa-trophy me-2"></i> Tournament</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="show_tournament.php" class="dropdown-item">Show Tournament</a>                            
                </div>     
                </div>
            <!-- Membership=== -->
                <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php echo (strpos($current_page, 'membership') !== false) ? 'active' : ''; ?>" data-bs-toggle="dropdown"><i class="fa fa-id-card me-2"></i> Membership</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="show_membership.php" class="dropdown-item">Show Membership</a>                            
                </div>                      
            </div>
                <!-- Plan=== -->
                <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php echo (strpos($current_page, 'plan') !== false) ? 'active' : ''; ?>" data-bs-toggle="dropdown"><i class="fa fa-list-alt me-2"></i>Plan</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="planadd.php" class="dropdown-item">Add Plan</a>                            
                    <a href="planshow.php" class="dropdown-item">Show Plan</a>                            
                </div>                      
            </div>
                <!-- ADD member -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php echo (strpos($current_page, 'member') !== false && strpos($current_page, 'membership') === false) ? 'active' : ''; ?>" data-bs-toggle="dropdown"><i class="fa fa-users me-2"></i>Team-Member</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="memberadd.php" class="dropdown-item">Add Member</a>          
                    <a href="membershow.php" class="dropdown-item">Show Member</a>                  
                </div>                       
                </div>
            <!-- tee-time -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php echo (strpos($current_page, 'teetime') !== false) ? 'active' : ''; ?>" data-bs-toggle="dropdown"><i class="fa fa-clock me-2"></i>Tee-Time</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="show_teetime.php" class="dropdown-item">Show Tee-Time</a>                            
                </div>                       
                </div>
                <!-- contact us -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?php echo (strpos($current_page, 'contact') !== false) ? 'active' : ''; ?>" data-bs-toggle="dropdown"><i class="fa fa-address-book me-2"></i>Contact</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="show_contact.php" class="dropdown-item">Contact page</a>                            
                </div>                       
                </div>
            

        </div>
    </nav>
</div>
<!-- Sidebar End -->
