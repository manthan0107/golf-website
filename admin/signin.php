<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "lib/db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare statement
    $stmt = $con->prepare("SELECT * FROM signup WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $login_success = false;
        if (password_verify($password, $row['password'])) {
            $login_success = true;
        } elseif (md5($password) === $row['password']) {
            $login_success = true;
        } elseif ($password === $row['password']) {
            $login_success = true;
        } elseif (trim($password) === trim($row['password'])) {
            $login_success = true;
        }

        if ($login_success) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['is_admin'] = true;

            // Admin image
            if (!empty($row['image'])) {
                $_SESSION['admin_image'] = $row['image'];
            } else {    
                $_SESSION['admin_image'] = "";
            }

            session_write_close();
            header("Location: index.php");
            exit;

        } else {
            $error = "Invalid Password!";
        }

    } else {
        $error = "Invalid Email or Password!";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>G-Club - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.php" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>G-Club</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        
                        <?php if(!empty($error)): ?>
                            <div class="alert alert-danger px-3 py-2"><?php echo htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <form id="adminSignInForm" method="POST" action="signin.php" onsubmit="return validateAdminSignIn()">
                            <div class="form-floating mb-3 position-relative">
                                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com" required onblur="Validator.validateEmail(this)">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4 position-relative">
                                <input type="password" class="form-control pe-5" name="password" id="floatingPassword" placeholder="Password" required onblur="Validator.validatePassword(this)">
                                <label for="floatingPassword">Password</label>
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" style="cursor: pointer;" onclick="togglePasswordVisibility('floatingPassword', this)">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        </form>

                        <p class="text-center mb-0">Don't have an Account? <a href="signup.php">Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="../website/js/validation.js"></script>
    <script>
        function togglePasswordVisibility(inputId, iconSpan) {
            const input = document.getElementById(inputId);
            const icon = iconSpan.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function validateAdminSignIn() {
            let isValid = true;
            isValid = Validator.validateEmail(document.getElementById('floatingInput')) && isValid;
            isValid = Validator.validateRequired(document.getElementById('floatingPassword'), 'Password') && isValid;
            return isValid;
        }
    </script>
</body>

</html>