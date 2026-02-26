<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- UPDATE PROFILE LOGIC ---
    if (isset($_POST['action']) && $_POST['action'] == 'update_profile') {
        $user_id = (int)$_POST['user_id'];
        
        // Ensure the logged-in user is only updating their own account
        if ($user_id !== (int)$_SESSION['user_id']) {
            $_SESSION['msg'] = "Unauthorized action.";
            $_SESSION['msg_type'] = "danger";
            header("Location: profile.php");
            exit;
        }

        $username = $_POST['username'];
        $phone = $_POST['phone'];
        
        // Check if an image was uploaded
        $update_image = false;
        $image_name = '';

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            $file_type = $_FILES['profile_image']['type'];
            
            if (in_array($file_type, $allowed_types)) {
                $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
                $image_name = 'user_' . $user_id . '_' . time() . '.' . $ext;
                $target_dir = "../image/uploads/";
                
                // Create directory if it doesn't exist
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                
                if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_dir . $image_name)) {
                    $update_image = true;
                } else {
                    $_SESSION['msg'] = "Failed to upload image.";
                    $_SESSION['msg_type'] = "danger";
                }
            } else {
                $_SESSION['msg'] = "Invalid image format. Only JPG, PNG, and GIF are allowed.";
                $_SESSION['msg_type'] = "danger";
            }
        }
        
        if ($update_image) {
            $stmt = $con->prepare("UPDATE register SET username = ?, phone = ?, image = ? WHERE id = ?");
            $stmt->bind_param("sssi", $username, $phone, $image_name, $user_id);
        } else {
            $stmt = $con->prepare("UPDATE register SET username = ?, phone = ? WHERE id = ?");
            $stmt->bind_param("ssi", $username, $phone, $user_id);
        }

        if ($stmt->execute()) {
            $_SESSION['username'] = $username; // Update session name
            // Only set success message if there wasn't a prior error (like failed image upload)
            if (!isset($_SESSION['msg']) || $_SESSION['msg_type'] != 'danger') {
                $_SESSION['msg'] = "Profile updated successfully!";
                $_SESSION['msg_type'] = "success";
            }
        } else {
            $_SESSION['msg'] = "Error updating profile: " . $stmt->error;
            $_SESSION['msg_type'] = "danger";
        }
        $stmt->close();
        header("Location: profile.php");
        exit;
    }
    
    // --- CANCEL BOOKING LOGIC ---
    elseif (isset($_POST['action']) && $_POST['action'] == 'cancel_booking') {
        $type = $_POST['type'];
        $id = (int)$_POST['id'];
        $user_id = $_SESSION['user_id'];

        // Fetch user email from DB to ensure accurate linking
        $stmt_user = $con->prepare("SELECT email FROM register WHERE id = ?");
        $stmt_user->bind_param("i", $user_id);
        $stmt_user->execute();
        $user_res = $stmt_user->get_result()->fetch_assoc();
        $user_email = $user_res['email'];
        $stmt_user->close();

        $valid_types = ['membership', 'coaching', 'tee_time', 'team', 'tounament'];
        
        if (in_array($type, $valid_types)) {
            // First verify that the record actually belongs to the user by checking email
            $stmt_verify = $con->prepare("SELECT id FROM `$type` WHERE id = ? AND email = ?");
            $stmt_verify->bind_param("is", $id, $user_email);
            $stmt_verify->execute();
            $result = $stmt_verify->get_result();
            
            if ($result->num_rows > 0) {
                // User owns this record, proceed to delete
                $stmt_del = $con->prepare("DELETE FROM `$type` WHERE id = ?");
                $stmt_del->bind_param("i", $id);
                if ($stmt_del->execute()) {
                    $_SESSION['msg'] = ucfirst(str_replace('_', ' ', $type)) . " booking canceled successfully.";
                    $_SESSION['msg_type'] = "success";
                } else {
                    $_SESSION['msg'] = "Failed to cancel booking.";
                    $_SESSION['msg_type'] = "danger";
                }
                $stmt_del->close();
            } else {
                $_SESSION['msg'] = "Unauthorized access or record not found.";
                $_SESSION['msg_type'] = "danger";
            }
            $stmt_verify->close();
        } else {
            $_SESSION['msg'] = "Invalid booking type.";
            $_SESSION['msg_type'] = "danger";
        }
        
        header("Location: profile.php");
        exit;
    }
}
?>
