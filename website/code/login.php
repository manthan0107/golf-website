<?php
session_start();
include 'db.php';

$error = "";
$success = "";

// Handle Form Submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- SIGNUP LOGIC ---
    if (isset($_POST['action']) && $_POST['action'] == 'signup') {
        $username = $_POST['username'];
        $email    = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $stmt = $con->prepare("SELECT email FROM register WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Email already registered. Please login.";
            $stmt->close();
        } else {
            $stmt->close();
            // Insert new user
            $stmt = $con->prepare("INSERT INTO `register`(`username`, `email`, `password`) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $success = "Account created successfully! Please Sign In.";
            } else {
                $error = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    }
    
    // --- LOGIN LOGIC ---
    elseif (isset($_POST['action']) && $_POST['action'] == 'login') {
        $email    = $_POST['email'];
        $password = $_POST['password'];
        $login_successful = false;

        // 1. Check User in 'register' table
        $stmt = $con->prepare("SELECT * FROM register WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_email'] = $row['email'];
                $login_successful = true;
                header("Location: index.php");
                exit;
            }
        }
        $stmt->close();

        // 2. Check Admin in 'signup' table (if user login failed)
        if (!$login_successful) {
            $stmt_admin = $con->prepare("SELECT * FROM signup WHERE email=? AND password=?");
            $stmt_admin->bind_param("ss", $email, $password);
            $stmt_admin->execute();
            $result_admin = $stmt_admin->get_result();

            if ($result_admin->num_rows > 0) {
                $row_admin = $result_admin->fetch_assoc();
                $_SESSION['user_id'] = $row_admin['id'];
                $_SESSION['username'] = $row_admin['username'];
                $_SESSION['is_admin'] = true; // Mark as admin
                header("Location: ../../admin/index.php");
                exit;
            } else {
                $error = "Invalid Email or Password!";
            }
            $stmt_admin->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Walkwell - Login & Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-color: #f4f4f4;
            --card-bg: #1e2124;
            --text-color: #ffffff;
            --accent-gold: #D4AF37;
            --accent-cream: #F5E6CA;
            --input-bg: #2b2e33;
            --transition-speed: 0.4s;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        /* --- Toggle Switch Container --- */
        .toggle-container {
            position: relative;
            width: 280px;
            height: 50px;
            background-color: #ddd;
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            cursor: pointer;
            user-select: none;
        }

        .toggle-btn {
            position: absolute;
            top: 5px;
            left: 5px;
            width: 135px;
            height: 40px;
            background-color: #1e2124;
            border-radius: 25px;
            transition: transform var(--transition-speed) ease-in-out;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 1;
        }

        /* Classes to move the button */
        .toggle-container.active-login .toggle-btn {
            transform: translateX(135px);
        }

        .toggle-labels {
            width: 100%;
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 2;
        }

        .toggle-option {
            width: 50%;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
            color: #555;
            transition: color var(--transition-speed);
            line-height: 40px; /* Vertically center text */
        }
        
        .active-text {
            color: var(--accent-gold) !important;
        }


        /* --- Main Card --- */
        .auth-card {
            background-color: var(--card-bg);
            color: var(--text-color);
            width: 90%;
            max-width: 420px;
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            min-height: 520px; /* Ensure enough height for transitions */
            display: flex;
            align-items: flex-start; /* Align top so forms don't jump weirdly */
        }

        /* --- Forms Slider --- */
        .forms-slider {
            display: flex;
            width: 200%; /* Holds two forms side by side */
            transition: transform var(--transition-speed) ease-in-out;
        }

        .form-section {
            width: 50%;
            padding: 0 10px;
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            pointer-events: none; /* Prevent interaction when hidden */
        }
        
        /* Visible state managed by class */
        .form-section.active {
            opacity: 1;
            pointer-events: auto;
        }

        /* Slide positions */
        .active-login .forms-slider {
            transform: translateX(-50%);
        }
        
        /* --- Form Elements --- */
        h3 {
            color: var(--accent-cream);
            text-align: center;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .input-group-text {
            background-color: var(--input-bg);
            border: 1px solid #444;
            border-right: none;
            color: var(--accent-gold);
        }
        
        .form-control {
            background-color: var(--input-bg);
            border: 1px solid #444;
            border-left: none;
            color: #fff;
        }
        
        .form-control:focus {
            background-color: #333;
            color: #fff;
            border-color: var(--accent-gold);
            box-shadow: none;
        }

        .form-control::placeholder {
            color: #888;
        }

        .btn-gold {
            background: linear-gradient(135deg, var(--accent-gold), #b38f2d);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            margin-top: 10px;
            transition: opacity 0.3s;
        }

        .btn-gold:hover {
            opacity: 0.9;
        }

        .alert-custom {
            font-size: 0.9rem;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>

    <!-- Toggle Switch -->
    <div class="toggle-container" id="toggleContainer" onclick="toggleAuth()">
        <div class="toggle-btn"></div>
        <div class="toggle-labels">
            <div class="toggle-option" id="labelSignUp">SIGN UP</div>
            <div class="toggle-option" id="labelSignIn">LOG IN</div>
        </div>
    </div>

    <div class="auth-card">
        
        <div class="forms-slider">
            
            <!-- SIGN UP FORM (Left) -->
            <div class="form-section" id="formSignUp">
                <h3>Create Account</h3>
                
                <?php if ($success): ?>
                    <div class="alert alert-success alert-custom text-center"><?= $success ?></div>
                <?php endif; ?>
                <?php if ($error && isset($_POST['action']) && $_POST['action'] == 'signup'): ?>
                    <div class="alert alert-danger alert-custom text-center"><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <input type="hidden" name="action" value="signup">
                    
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="username" placeholder="Full Name" required>
                    </div>

                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>

                    <div class="mb-4 input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn btn-gold">SIGN UP</button>
                </form>
            </div>

            <!-- LOGIN FORM (Right) -->
            <div class="form-section" id="formLogin">
                <h3>Welcome Back</h3>

                <?php if ($error && isset($_POST['action']) && $_POST['action'] == 'login'): ?>
                    <div class="alert alert-danger alert-custom text-center"><?= $error ?></div>
                <?php endif; ?>
                <!-- Success message from signup can also be shown here if needed, but handled above -->
                
                <form method="POST" action="">
                    <input type="hidden" name="action" value="login">
                    
                    <div class="mb-3 input-group">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" required>
                    </div>

                    <div class="mb-4 input-group">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label text-white-50" style="font-size:0.9rem" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-white-50" style="font-size:0.9rem; text-decoration:none;">Forgot?</a>
                    </div>

                    <button type="submit" class="btn btn-gold">LOG IN</button>
                </form>
            </div>
        
        </div>
    </div>

    <script>
        const container = document.getElementById('toggleContainer');
        const card = document.querySelector('.auth-card');
        const labelSignUp = document.getElementById('labelSignUp');
        const labelSignIn = document.getElementById('labelSignIn');
        const formSignUp = document.getElementById('formSignUp');
        const formLogin = document.getElementById('formLogin');

        let isLogin = false; // Default is Sign Up (Left)

        function updateUI() {
            if (isLogin) {
                // Switch to Login (Right)
                container.classList.add('active-login');
                card.classList.add('active-login');
                
                labelSignIn.classList.add('active-text');
                labelSignUp.classList.remove('active-text');

                formLogin.classList.add('active');
                formSignUp.classList.remove('active');
            } else {
                // Switch to Sign Up (Left)
                container.classList.remove('active-login');
                card.classList.remove('active-login');
                
                labelSignUp.classList.add('active-text');
                labelSignIn.classList.remove('active-text');

                formSignUp.classList.add('active');
                formLogin.classList.remove('active');
            }
        }

        function toggleAuth() {
            isLogin = !isLogin;
            updateUI();
        }

        // Handle URL hash for default view
        function checkHash() {
            if (window.location.hash === '#signup') {
                isLogin = false;
                updateUI();
            } else if (window.location.hash === '#login') {
                isLogin = true;
                updateUI();
            }
        }

        // Initialize based on hash or default
        if (window.location.hash) {
            checkHash();
        } else {
             // Default is Sign Up as per user request "Left side -> Show SIGN UP form"
             // But usually users expect Login. Let's see. 
             // "Left side -> Show SIGN UP form". "If toggle LEFT -> Sign Up form".
             // The code initializes isLogin=false (Signup).
             updateUI();
        }

        window.addEventListener('hashchange', checkHash);

        // Check if we need to auto-switch based on PHP state
        <?php if ($success || (isset($_POST['action']) && $_POST['action'] == 'login')): ?>
            // If success (signup done) OR we tried to login (and failed), show Login tab
            isLogin = true;
            updateUI();
        <?php endif; ?>
        
    </script>
</body>
</html>


