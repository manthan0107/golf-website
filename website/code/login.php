<?php
session_start();
include 'db.php';

$error = "";
$success = "";

// Helper to sanitize inputs
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handle Form Submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- SIGNUP LOGIC ---
    if (isset($_POST['action']) && $_POST['action'] == 'signup') {
        $username = sanitize($_POST['username']);
        $email    = sanitize($_POST['email']);
        $password = $_POST['password']; // Don't sanitize password, but do validate

        // Validation Rules
        if (!preg_match("/^[A-Za-z\s]{3,}$/", $username)) {
            $error = "Name must be at least 3 characters and contain only letters and spaces.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Please enter a valid email address.";
        } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{6,}$/", $password)) {
            $error = "Password must be at least 6 characters and contain at least one letter and one number.";
        } else {
            // Hash the password securely
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
    }
    
    // --- LOGIN LOGIC ---
    elseif (isset($_POST['action']) && $_POST['action'] == 'login') {

        $email = sanitize($_POST['email']);
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Please enter a valid email address.";
        } elseif (empty($password)) {
            $error = "Password is required.";
        } else {
            // 1️⃣ Fetch admin by email
            $stmt_admin = $con->prepare("SELECT * FROM signup WHERE email=?");
            $stmt_admin->bind_param("s", $email);
            $stmt_admin->execute();
            $result_admin = $stmt_admin->get_result();

            if ($result_admin->num_rows > 0) {
                $row_admin = $result_admin->fetch_assoc();

                // 2️⃣ Verify password in PHP
                if (
                    password_verify($password, $row_admin['password']) ||
                    md5($password) == $row_admin['password'] ||
                    $password == $row_admin['password']
                ) {
                    $_SESSION['user_id'] = $row_admin['id'];
                    $_SESSION['username'] = $row_admin['username'];
                    $_SESSION['user_email'] = $row_admin['email'];
                    $_SESSION['phone'] = $row_admin['phone'];
                    $_SESSION['is_admin'] = true;

                    if (!empty($row_admin['image'])) {
                        $_SESSION['admin_image'] = $row_admin['image'];
                    } else {
                        $_SESSION['admin_image'] = "user.jpg";
                    }

                    header("Location: ../../admin/index.php");
                    exit;
                }
            }
            $stmt_admin->close();

            // 2️⃣ Check Normal User
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

                    header("Location: index.php");
                    exit;
                }
            }
            $stmt->close();
            $error = "Invalid Email or Password!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Golf Club - Login & Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #2e7d32;
            --bg-gradient: linear-gradient(135deg, #a8cf45, #4caf50);
            --error-bg: #f8d7da;
            --error-text: #721c24;
            --input-border: #ced4da;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-gradient);
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
            width: 240px;
            height: 45px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 5px;
            margin-bottom: 25px;
            cursor: pointer;
            user-select: none;
            backdrop-filter: blur(5px);
        }

        .toggle-btn {
            position: absolute;
            top: 4px;
            left: 5px;
            width: 115px;
            height: 37px;
            background-color: #1e2124;
            border-radius: 25px;
            transition: transform var(--transition-speed) ease-in-out;
            z-index: 1;
        }

        .toggle-container.active-login .toggle-btn {
            transform: translateX(115px);
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
            font-size: 0.9rem;
            color: #fff;
            transition: color var(--transition-speed);
            line-height: 37px;
        }
        
        .active-text {
            color: #FFD700 !important; /* Gold for active toggle text */
        }

        /* --- Main Card --- */
        .auth-card {
            background-color: #ffffff;
            width: 90%;
            max-width: 400px;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            position: relative;
            min-height: 450px;
            display: flex;
            flex-direction: column;
        }

        .card-header-icon {
            text-align: center;
            font-size: 2.5rem;
            color: var(--primary-green);
            margin-bottom: 10px;
        }

        h2 {
            color: var(--primary-green);
            text-align: center;
            font-weight: 700;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }

        /* --- Forms Toggle Logic --- */
        .form-section {
            display: none;
        }
        
        .form-section.active {
            display: block;
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* --- Form Elements --- */
        .form-label {
            font-weight: 500;
            color: #444;
            margin-bottom: 5px;
        }

        .form-control {
            border: 1px solid var(--input-border);
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .form-control:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 0.2rem rgba(46, 125, 50, 0.25);
        }

        .btn-green {
            background-color: var(--primary-green);
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            margin-top: 15px;
            transition: background 0.3s;
        }

        .btn-green:hover {
            background-color: #1b5e20;
            color: #fff;
        }

        .alert-pink {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            font-size: 0.9rem;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .auth-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
        }

        .auth-footer a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-footer a:hover {
            text-decoration: underline;
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
        <div class="card-header-icon">
            <i class="fas fa-lightbulb"></i>
        </div>
        
        <div id="loginHeader">
            <h2>Golf Club Login</h2>
        </div>
        <div id="signupHeader" style="display: none;">
            <h2>Create Account</h2>
        </div>

        <!-- Messages -->
        <?php if ($error): ?>
            <div class="alert-pink"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success text-center" style="font-size: 0.9rem; border-radius: 8px;"><?= $success ?></div>
        <?php endif; ?>

        <!-- LOGIN FORM -->
        <div class="form-section" id="formLogin">
            <form id="loginForm" method="POST" action="" onsubmit="return validateLogin()">
                <input type="hidden" name="action" value="login">
                
                <div class="mb-3">
                    <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Email address" required onblur="Validator.validateEmail(this)">
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required onblur="Validator.validateRequired(this, 'Password')">
                </div>

                <button type="submit" class="btn btn-green">Login</button>
                
                <div class="auth-footer">
                    <a href="#">Forgot Password?</a><br>
                    Don't have an account? <a href="javascript:void(0)" onclick="toggleAuth(false)">Sign Up</a>
                </div>
            </form>
        </div>

        <!-- SIGN UP FORM -->
        <div class="form-section" id="formSignUp">
            <form id="signupForm" method="POST" action="" onsubmit="return validateSignup()">
                <input type="hidden" name="action" value="signup">
                
                <div class="mb-3">
                    <input type="text" class="form-control" id="signupUsername" name="username" placeholder="Full Name" required onblur="Validator.validateName(this)">
                </div>

                <div class="mb-3">
                    <input type="email" class="form-control" id="signupEmail" name="email" placeholder="Email address" required onblur="Validator.validateEmail(this)">
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control" id="signupPassword" name="password" placeholder="Password" required onblur="Validator.validatePassword(this)">
                </div>

                <button type="submit" class="btn btn-green">Sign Up</button>
                
                <div class="auth-footer">
                    Already have an account? <a href="javascript:void(0)" onclick="toggleAuth(true)">Login</a>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/validation.js"></script>
    <script>
        function validateLogin() {
            let isValid = true;
            isValid = Validator.validateEmail(document.getElementById('loginEmail')) && isValid;
            isValid = Validator.validateRequired(document.getElementById('loginPassword'), 'Password') && isValid;
            return isValid;
        }

        function validateSignup() {
            let isValid = true;
            isValid = Validator.validateName(document.getElementById('signupUsername')) && isValid;
            isValid = Validator.validateEmail(document.getElementById('signupEmail')) && isValid;
            isValid = Validator.validatePassword(document.getElementById('signupPassword')) && isValid;
            return isValid;
        }

        const container = document.getElementById('toggleContainer');
        const labelSignUp = document.getElementById('labelSignUp');
        const labelSignIn = document.getElementById('labelSignIn');
        const formSignUp = document.getElementById('formSignUp');
        const formLogin = document.getElementById('formLogin');
        const loginHeader = document.getElementById('loginHeader');
        const signupHeader = document.getElementById('signupHeader');

        let isLogin = true; // Default is Login for the green theme

        function updateUI() {
            if (isLogin) {
                container.classList.add('active-login');
                labelSignIn.classList.add('active-text');
                labelSignUp.classList.remove('active-text');

                formLogin.classList.add('active');
                formSignUp.classList.remove('active');
                
                loginHeader.style.display = 'block';
                signupHeader.style.display = 'none';
            } else {
                container.classList.remove('active-login');
                labelSignUp.classList.add('active-text');
                labelSignIn.classList.remove('active-text');

                formSignUp.classList.add('active');
                formLogin.classList.remove('active');
                
                loginHeader.style.display = 'none';
                signupHeader.style.display = 'block';
            }
        }

        function toggleAuth(forceLogin) {
            if (typeof forceLogin !== 'undefined') {
                isLogin = forceLogin;
            } else {
                isLogin = !isLogin;
            }
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

        // Initialize
        if (window.location.hash) {
            checkHash();
        } else {
            updateUI();
        }

        window.addEventListener('hashchange', checkHash);

        // PHP logic to auto-switch
        <?php if ($success || (isset($_POST['action']) && $_POST['action'] == 'login' && $error)): ?>
            isLogin = true;
            updateUI();
        <?php elseif (isset($_POST['action']) && $_POST['action'] == 'signup' && $error): ?>
            isLogin = false;
            updateUI();
        <?php endif; ?>
        
    </script>
</body>
</html>


