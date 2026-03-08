<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "lib/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit;
}

$admin_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update_profile') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        
        // Basic Validation
        if(empty($username) || empty($email)) {
             $_SESSION['msg'] = "Name and Email are required!";
             $_SESSION['msg_type'] = "danger";
             header("Location: profile.php");
             exit;
        }

        // Handle Image Upload
        $img_name = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $base_name = basename($_FILES['image']['name']);
            $ext = strtolower(pathinfo($base_name, PATHINFO_EXTENSION));
            $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($ext, $allowed_exts)) {
                // Ensure directory exists
                if (!is_dir('img/uploads')) {
                    mkdir('img/uploads', 0777, true);
                }

                $new_img_name = uniqid("admin_") . "." . $ext;
                $target_path = "img/uploads/" . $new_img_name;
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                    $img_name = $new_img_name;
                    $_SESSION['admin_image'] = $img_name; // update header image live
                } else {
                    $_SESSION['msg'] = "Failed to upload image.";
                    $_SESSION['msg_type'] = "danger";
                    header("Location: profile.php");
                    exit;
                }
            } else {
                $_SESSION['msg'] = "Invalid image format. Only JPG, PNG, and GIF allowed.";
                $_SESSION['msg_type'] = "danger";
                header("Location: profile.php");
                exit;
            }
        }

        // Prepare SQL based on whether an image was uploaded
        if ($img_name) {
            $stmt = $con->prepare("UPDATE signup SET username=?, email=?, phone=?, image=? WHERE id=?");
            $stmt->bind_param("ssssi", $username, $email, $phone, $img_name, $admin_id);
        } else {
            $stmt = $con->prepare("UPDATE signup SET username=?, email=?, phone=? WHERE id=?");
            $stmt->bind_param("sssi", $username, $email, $phone, $admin_id);
        }

        if ($stmt->execute()) {
            // Update session vars so UI updates live without logout
            $_SESSION['username'] = $username;
            $_SESSION['msg'] = "Profile updated successfully!";
            $_SESSION['msg_type'] = "success";
        } else {
             $_SESSION['msg'] = "Failed to update profile.";
             $_SESSION['msg_type'] = "danger";
        }
        $stmt->close();

    } elseif ($_POST['action'] === 'change_password') {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if ($new_password !== $confirm_password) {
            $_SESSION['msg'] = "New passwords do not match!";
            $_SESSION['msg_type'] = "danger";
            header("Location: profile.php");
            exit;
        }

        // Verify current password first
        $stmt = $con->prepare("SELECT password FROM signup WHERE id=?");
        $stmt->bind_param("i", $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();
        
        $valid_old_pass = false;
        if (password_verify($current_password, $admin['password']) || $current_password === $admin['password']) {
            $valid_old_pass = true;
        }

        if (!$valid_old_pass) {
            $_SESSION['msg'] = "Current password is incorrect.";
            $_SESSION['msg_type'] = "danger";
            header("Location: profile.php");
            exit;
        }
        $stmt->close();

        // Hash and Update New Password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $con->prepare("UPDATE signup SET password=? WHERE id=?");
        $stmt->bind_param("si", $hashed_password, $admin_id);

        if ($stmt->execute()) {

    $_SESSION['username'] = $username;
    $_SESSION['admin_image'] = $img_name;

    $_SESSION['msg'] = "Profile updated successfully!";
    $_SESSION['msg_type'] = "success";

    header("Location: profile.php");
    exit;
}
        $stmt->close();
    }
}

header("Location: profile.php");
exit;
?>
