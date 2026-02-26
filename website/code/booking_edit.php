<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

$user_email = $_SESSION['user_email'];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $id = (int)$_POST['id'];

    if ($type == 'membership') {
        $name = $_POST['mname'];
        $subject = $_POST['msubject'];
        $contact = $_POST['mcontact'];
        $message = $_POST['mmessage'];
        
        $stmt = $con->prepare("UPDATE membership SET name=?, subject=?, contact=?, message=? WHERE id=? AND email=?");
        $stmt->bind_param("ssisss", $name, $subject, $contact, $message, $id, $user_email);
    } 
    elseif ($type == 'coaching') {
        $name = $_POST['name'];
        $cno = $_POST['cno'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $level = $_POST['level'];
        $timeslot = $_POST['timeslot'];
        $message = $_POST['message'];

        $stmt = $con->prepare("UPDATE coaching SET name=?, cno=?, age=?, gender=?, level=?, timeslot=?, message=? WHERE id=? AND email=?");
        $stmt->bind_param("sisssssis", $name, $cno, $age, $gender, $level, $timeslot, $message, $id, $user_email);
    } 
    elseif ($type == 'tee_time') {
        $name = $_POST['tname'];
        $players = (int)$_POST['tplayers'];
        $date = $_POST['tdate'];
        $time = $_POST['ttime'];
        $contact = (int)$_POST['tcontact'];
        $message = $_POST['tmessage'];

        $stmt = $con->prepare("UPDATE tee_time SET name=?, players=?, date=?, time=?, contact=?, message=? WHERE id=? AND email=?");
        $stmt->bind_param("sissisis", $name, $players, $date, $time, $contact, $message, $id, $user_email);
    }
    elseif ($type == 'team') {
        $name = $_POST['name'];
        $designation = $_POST['designation'];
        $gender = $_POST['gender'];
        $experience = (int)$_POST['experience'];

        // Note: For teams, we only allow updating standard string/int fields, not replacing images in this context 
        // string(name), string(designation), string(gender), int(experience), int(id), string(email) -> "sssii" -> Actually "sssiss" ?
        // name(s), designation(s), gender(s), experience(i), id(i), email(s) -> sssiis
        $stmt = $con->prepare("UPDATE team SET name=?, designation=?, gender=?, experience=? WHERE id=? AND email=?");
        $stmt->bind_param("sssiis", $name, $designation, $gender, $experience, $id, $user_email);
    }
    elseif ($type == 'tounament') {
        $tname = $_POST['tname'];
        $oname = $_POST['oname'];
        $date = $_POST['date'];
        $location = $_POST['location'];
        $otherd = $_POST['otherd'];

        $stmt = $con->prepare("UPDATE tounament SET tname=?, oname=?, date=?, location=?, otherd=? WHERE id=? AND email=?");
        $stmt->bind_param("sssssis", $tname, $oname, $date, $location, $otherd, $id, $user_email);
    }

    if (isset($stmt) && $stmt->execute()) {
        $_SESSION['msg'] = "Booking updated successfully.";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['msg'] = "Error updating booking.";
        $_SESSION['msg_type'] = "danger";
    }
    
    if (isset($stmt)) $stmt->close();
    header("Location: profile.php");
    exit;
}

// Display Form
if (!isset($_GET['type']) || !isset($_GET['id'])) {
    header("Location: profile.php");
    exit;
}

$type = $_GET['type'];
$id = (int)$_GET['id'];
$valid_types = ['membership', 'coaching', 'tee_time', 'team', 'tounament'];

if (!in_array($type, $valid_types)) {
    header("Location: profile.php");
    exit;
}

$stmt = $con->prepare("SELECT * FROM `$type` WHERE id = ? AND email = ?");
$stmt->bind_param("is", $id, $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['msg'] = "Booking not found or unauthorized.";
    $_SESSION['msg_type'] = "danger";
    header("Location: profile.php");
    exit;
}

$record = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking - Walkwell</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        body { background-color: #f4f7f6; }
        .edit-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 40px;
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .btn-gold {
            background-color: #D4AF37;
            color: #fff;
            font-weight: 600;
            border: none;
        }
        .btn-gold:hover { background-color: #b8962c; color: #fff; }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 edit-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0">Edit <?php echo ucwords(str_replace('_', ' ', $type)); ?> Booking</h3>
                    <a href="profile.php" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                </div>

                <form action="booking_edit.php" method="POST">
                    <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <?php if ($type == 'membership'): ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="mname" value="<?php echo htmlspecialchars($record['name']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control" name="msubject" value="<?php echo htmlspecialchars($record['subject']); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Contact Number</label>
                                <input type="number" class="form-control" name="mcontact" value="<?php echo htmlspecialchars($record['contact']); ?>" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="mmessage" rows="4" required><?php echo htmlspecialchars($record['message']); ?></textarea>
                        </div>
                        
                    <?php elseif ($type == 'coaching'): ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($record['name']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Number</label>
                                <input type="number" class="form-control" name="cno" value="<?php echo htmlspecialchars($record['cno']); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Age</label>
                                <input type="number" class="form-control" name="age" value="<?php echo htmlspecialchars($record['age']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender">
                                    <option value="male" <?php if($record['gender']=='male') echo 'selected'; ?>>Male</option>
                                    <option value="female" <?php if($record['gender']=='female') echo 'selected'; ?>>Female</option>
                                    <option value="other" <?php if($record['gender']=='other') echo 'selected'; ?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Skill Level</label>
                                <select class="form-select" name="level">
                                    <option value="Beginner" <?php if($record['level']=='Beginner') echo 'selected'; ?>>Beginner</option>
                                    <option value="Intermediate" <?php if($record['level']=='Intermediate') echo 'selected'; ?>>Intermediate</option>
                                    <option value="Advanced" <?php if($record['level']=='Advanced') echo 'selected'; ?>>Advanced</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Time Slot</label>
                                <select class="form-select" name="timeslot">
                                    <option value="Morning" <?php if($record['timeslot']=='Morning') echo 'selected'; ?>>Morning</option>
                                    <option value="Afternoon" <?php if($record['timeslot']=='Afternoon') echo 'selected'; ?>>Afternoon</option>
                                    <option value="Evening" <?php if($record['timeslot']=='Evening') echo 'selected'; ?>>Evening</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="4"><?php echo htmlspecialchars($record['message']); ?></textarea>
                        </div>
                        
                    <?php elseif ($type == 'tee_time'): ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="tname" value="<?php echo htmlspecialchars($record['name']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Players</label>
                                <select class="form-select" name="tplayers" required>
                                    <?php for($i=1; $i<=4; $i++): ?>
                                        <option value="<?php echo $i; ?>" <?php if($record['players']==$i) echo 'selected'; ?>><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" name="tdate" value="<?php echo htmlspecialchars($record['date']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" name="ttime" value="<?php echo htmlspecialchars($record['time']); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Contact Number</label>
                                <input type="number" class="form-control" name="tcontact" value="<?php echo htmlspecialchars($record['contact']); ?>" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="tmessage" rows="4"><?php echo htmlspecialchars($record['message']); ?></textarea>
                        </div>

                    <?php elseif ($type == 'team'): ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Team Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($record['name']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Designation / Role</label>
                                <input type="text" class="form-control" name="designation" value="<?php echo htmlspecialchars($record['designation']); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender">
                                    <option value="Male" <?php if(strtolower($record['gender'])=='male') echo 'selected'; ?>>Male</option>
                                    <option value="Female" <?php if(strtolower($record['gender'])=='female') echo 'selected'; ?>>Female</option>
                                    <option value="Other" <?php if(strtolower($record['gender'])=='other') echo 'selected'; ?>>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Experience (Years)</label>
                                <input type="number" min="0" class="form-control" name="experience" value="<?php echo htmlspecialchars($record['experience']); ?>" required>
                            </div>
                        </div>
                        
                    <?php elseif ($type == 'tounament'): ?>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tournament Name</label>
                                <input type="text" class="form-control" name="tname" value="<?php echo htmlspecialchars($record['tname']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Organizer Name</label>
                                <input type="text" class="form-control" name="oname" value="<?php echo htmlspecialchars($record['oname']); ?>" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" name="date" value="<?php echo htmlspecialchars($record['date']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Location</label>
                                <input type="text" class="form-control" name="location" value="<?php echo htmlspecialchars($record['location']); ?>" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Additional Details</label>
                            <textarea class="form-control" name="otherd" rows="4"><?php echo htmlspecialchars($record['otherd']); ?></textarea>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-gold w-100">Update <?php echo ucwords(str_replace('_', ' ', $type)); ?></button>
                </form>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
