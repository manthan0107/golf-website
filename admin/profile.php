<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}
include "lib/db.php";

$admin_id = $_SESSION['user_id'];

// Fetch Admin Details
$stmt = $con->prepare("SELECT * FROM signup WHERE id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Fetch counts
$coaching_count = ($res = mysqli_query($con, "SELECT COUNT(id) AS total FROM coaching")) ? mysqli_fetch_assoc($res)['total'] : 0;
$membership_count = ($res = mysqli_query($con, "SELECT COUNT(id) AS total FROM membership")) ? mysqli_fetch_assoc($res)['total'] : 0;
$team_count = ($res = mysqli_query($con, "SELECT COUNT(id) AS total FROM team")) ? mysqli_fetch_assoc($res)['total'] : 0;
// Note: legacy code called the regular table 'register', assuming that meant "Total Members" in old dash. Including tounament too here.
$register_count = ($res = mysqli_query($con, "SELECT COUNT(id) AS total FROM register")) ? mysqli_fetch_assoc($res)['total'] : 0;
$tournament_count = ($res = mysqli_query($con, "SELECT COUNT(id) AS total FROM tounament")) ? mysqli_fetch_assoc($res)['total'] : 0;
$teetime_count = ($res = mysqli_query($con, "SELECT COUNT(id) AS total FROM tee_time")) ? mysqli_fetch_assoc($res)['total'] : 0;

$admin_image = !empty($admin['image']) ? "img/uploads/" . $admin['image'] : "img/user.jpg";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DarkPan - Admin Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        
        <?php include "sidebar.php"; ?>

        <!-- Content Start -->
        <div class="content">
            <?php include "header.php"; ?>

            <div class="container-fluid pt-4 px-4">
                
                <?php if(isset($_SESSION['msg'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible fade show" role="alert">
                        <?php 
                            echo $_SESSION['msg']; 
                            unset($_SESSION['msg']);
                            unset($_SESSION['msg_type']);
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="row g-4">
                    <!-- Profile Card -->
                    <div class="col-sm-12 col-xl-4">
                        <div class="bg-secondary rounded p-4 text-center">
                            <img class="rounded-circle mb-3" src="<?php echo htmlspecialchars($admin_image); ?>" alt="" style="width: 150px; height: 150px; object-fit: cover;">
                            <h4 class="mb-1">
<?php 
echo htmlspecialchars(
    isset($admin['username']) ? $admin['username'] : 'Admin Name'
); 
?>
</h4>
                            <p class="text-primary mb-3">Administrator</p>
                            
                            <ul class="list-unstyled text-start mt-4 mb-0">
                                <li class="mb-2"><i class="fa fa-envelope text-primary me-2"></i> <?php echo htmlspecialchars($admin['email']); ?></li>
                                <li>
<i class="fa fa-phone text-primary me-2"></i>
<?php 
echo htmlspecialchars(
    isset($admin['phone']) ? $admin['phone'] : 'Not set'
); 
?>
</li>
                            </ul>
                        </div>

                        <!-- Activity Overview  -->
                         <div class="bg-secondary rounded p-4 mt-4">
                            <h6 class="mb-4">Activity Overview</h6>
                            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                <span><i class="fa fa-users text-primary me-2"></i>Total Users</span>
                                <strong><?php echo $register_count; ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                <span><i class="fa fa-id-card text-primary me-2"></i>Memberships</span>
                                <strong><?php echo $membership_count; ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                <span><i class="fa fa-golf-ball text-primary me-2"></i>Tee Times</span>
                                <strong><?php echo $teetime_count; ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                <span><i class="fa fa-users-cog text-primary me-2"></i>Teams</span>
                                <strong><?php echo $team_count; ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                                <span><i class="fa fa-trophy text-primary me-2"></i>Tournaments</span>
                                <strong><?php echo $tournament_count; ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-0">
                                <span><i class="fa fa-chalkboard-teacher text-primary me-2"></i>Coaching</span>
                                <strong><?php echo $coaching_count; ?></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Forms -->
                    <div class="col-sm-12 col-xl-8">
                        <div class="bg-secondary rounded p-4 mb-4">
                            <h6 class="mb-4">Edit Profile</h6>
                            <form action="profile_action.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="update_profile">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="username" class="form-label">Name</label>
                                        <input type="text" class="form-control" style="background-color:#000;" id="username" name="username" value="<?php echo htmlspecialchars($admin['username']); ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" 
class="form-control" 
style="background-color:#000;" 
id="phone" 
name="phone" 
value="<?php echo htmlspecialchars(isset($admin['phone']) ? $admin['phone'] : ''); ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" style="background-color:#000;" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="image" class="form-label">Profile Image</label>
                                        <input class="form-control bg-dark" type="file" id="image" name="image">
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save me-2"></i>Update Details</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="bg-secondary rounded p-4">
                            <h6 class="mb-4">Change Password</h6>
                            <form action="profile_action.php" method="POST">
                                <input type="hidden" name="action" value="change_password">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input type="password" class="form-control" style="background-color:#000;" id="current_password" name="current_password" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="password" class="form-control" style="background-color:#000;" id="new_password" name="new_password" required minlength="6">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                                        <input type="password" class="form-control" style="background-color:#000;" id="confirm_password" name="confirm_password" required minlength="6">
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-warning"><i class="fa fa-key me-2"></i>Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
