<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Walkwell</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            margin-top: 50px;
            text-align: center;
        }
        .profile-avatar {
            width: 100px;
            height: 100px;
            background: #D4AF37;
            color: #fff;
            font-size: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="profile-card">
                    <div class="profile-avatar">
                        <i class="fa fa-user"></i>
                    </div>
                    <h2 class="mb-3">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                    
                    <?php if(isset($_SESSION['user_email'])): ?>
                        <p class="text-muted mb-4"><i class="fa fa-envelope me-2"></i> <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
                    <?php endif; ?>

                    <div class="d-grid gap-2">
                        <a href="membership.php" class="btn btn-outline-primary"><i class="fa fa-id-card me-2"></i> Membership Details</a>
                        <a href="logout.php" class="btn btn-danger"><i class="fa fa-sign-out me-2"></i> Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
