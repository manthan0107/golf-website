<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require 'db.php';

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $con->prepare("SELECT * FROM register WHERE id = ?");

if (!$stmt) {
    die("Prepare failed: " . $con->error);
}$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$user_data) {
    die("User not found.");
}

$user_email = $user_data['email'];

// Fallback image
$profile_img = !empty($user_data['image']) ? '../image/uploads/' . htmlspecialchars($user_data['image']) : 'https://ui-avatars.com/api/?name=' . urlencode($user_data['username']) . '&background=D4AF37&color=fff&size=150';

// Fetch memberships
$stmt = $con->prepare("SELECT * FROM membership WHERE email = ? ORDER BY id DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$memberships = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch coaching
$stmt = $con->prepare("SELECT * FROM coaching WHERE email = ? ORDER BY id DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$coachings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch tee times
$stmt = $con->prepare("SELECT * FROM tee_time WHERE email = ? ORDER BY id DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$tee_times = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch teams
$stmt = $con->prepare("SELECT * FROM team WHERE email = ? ORDER BY id DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$teams = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Fetch tournaments
$stmt = $con->prepare("SELECT * FROM tounament WHERE email = ? ORDER BY id DESC");
$stmt->bind_param("s", $user_email);
$stmt->execute();
$tournaments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - Walkwell Golf Club</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        body {
            background-color: #f4f7f6;
        }
        
        .dashboard-header {
            background: linear-gradient(135deg, #15395A 0%, #0a2036 100%);
            color: #fff;
            padding: 40px 0;
            margin-bottom: 30px;
        }

        .profile-header-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 30px;
            text-align: center;
            margin-top: -60px;
            border-bottom: 5px solid #D4AF37;
        }

        .profile-avatar-lg {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #fff;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin: -80px auto 20px;
            background: #D4AF37;
        }

        .nav-pills .nav-link {
            color: #15395A;
            font-weight: 600;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 12px 20px;
            transition: all 0.3s;
        }

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            background-color: #D4AF37;
            color: #fff;
        }

        .nav-pills .nav-link:hover:not(.active) {
            background-color: #e9ecef;
        }

        .tab-content {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 30px;
        }

        .table-custom {
            vertical-align: middle;
        }
        
        .table-custom thead th {
            background-color: #f8f9fa;
            color: #15395A;
            font-weight: 600;
            border-bottom: 2px solid #D4AF37;
        }

        .btn-gold {
            background-color: #D4AF37;
            color: #fff;
            font-weight: 600;
            border: none;
        }
        
        .btn-gold:hover {
            background-color: #b8962c;
            color: #fff;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: #dee2e6;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <div class="dashboard-header">
        <div class="container">
            <h2>Welcome back, <?php echo htmlspecialchars($user_data['username']); ?>!</h2>
            <p>Manage your account, bookings, and memberships from your personal dashboard.</p>
        </div>
    </div>

    <div class="container mb-5 pb-5">
        <?php if(isset($_SESSION['msg'])): ?>
            <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible fade show mb-4" role="alert">
                <?php echo $_SESSION['msg']; unset($_SESSION['msg']); unset($_SESSION['msg_type']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="profile-header-card mb-4">
                    <img src="<?php echo $profile_img; ?>" alt="Profile" class="profile-avatar-lg">
                    <h4><?php echo htmlspecialchars($user_data['username']); ?></h4>
                    <p class="text-muted text-break mb-2"><i class="fa fa-envelope me-2"></i><?php echo htmlspecialchars($user_data['email']); ?></p>
                    <p class="text-muted mb-0"><i class="fa fa-phone me-2"></i><?php echo !empty($user_data['phone']) ? htmlspecialchars($user_data['phone']) : 'Not Provided'; ?></p>
                </div>

                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active text-start" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="true">
                        <i class="fa fa-user me-2"></i> My Profile
                    </button>
                    <button class="nav-link text-start" id="v-pills-membership-tab" data-bs-toggle="pill" data-bs-target="#v-pills-membership" type="button" role="tab" aria-controls="v-pills-membership" aria-selected="false">
                        <i class="fa fa-id-card me-2"></i> My Membership
                    </button>
                    <button class="nav-link text-start" id="v-pills-coaching-tab" data-bs-toggle="pill" data-bs-target="#v-pills-coaching" type="button" role="tab" aria-controls="v-pills-coaching" aria-selected="false">
                        <i class="fa fa-graduation-cap me-2"></i> My Coaching
                    </button>
                    <button class="nav-link text-start" id="v-pills-tee-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tee" type="button" role="tab" aria-controls="v-pills-tee" aria-selected="false">
                        <i class="fa fa-golf-ball-tee me-2"></i> Tee Time Bookings
                    </button>
                    <button class="nav-link text-start" id="v-pills-team-tab" data-bs-toggle="pill" data-bs-target="#v-pills-team" type="button" role="tab" aria-controls="v-pills-team" aria-selected="false">
                        <i class="fa fa-users me-2"></i> My Teams
                    </button>
                    <button class="nav-link text-start" id="v-pills-tournament-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tournament" type="button" role="tab" aria-controls="v-pills-tournament" aria-selected="false">
                        <i class="fa fa-trophy me-2"></i> My Tournaments
                    </button>
                    <a href="logout.php" class="nav-link text-start text-danger mt-3">
                        <i class="fa fa-sign-out me-2"></i> Log Out
                    </a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- Profile Tab -->
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h4 class="mb-4">Update Profile Information</h4>
                        <form action="profile_action.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="update_profile">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($user_data['username']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required readonly title="Email cannot be changed">
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" name="phone"
value="<?php echo htmlspecialchars(isset($user_data['phone']) ? $user_data['phone'] : ''); ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Profile Image (Optional)</label>
                                    <input type="file" class="form-control" name="profile_image" accept="image/*">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-gold px-4">Save Changes</button>
                        </form>
                    </div>

                    <!-- Membership Tab -->
                    <div class="tab-pane fade" id="v-pills-membership" role="tabpanel" aria-labelledby="v-pills-membership-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">My Membership Requests</h4>
                            <a href="membership.php" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> New Request</a>
                        </div>
                        
                        <?php if(empty($memberships)): ?>
                            <div class="empty-state">
                                <i class="fa fa-folder-open"></i>
                                <h5>No Membership Records Found</h5>
                                <p>You haven't applied for any membership yet.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-custom">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Contact</th>
                                            <th>Message</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($memberships as $m): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($m['subject']); ?></td>
                                                <td><?php echo htmlspecialchars($m['contact']); ?></td>
                                                <td><span class="d-inline-block text-truncate" style="max-width: 150px;"><?php echo htmlspecialchars($m['message']); ?></span></td>
                                                <td class="text-end">
                                                    <a href="booking_edit.php?type=membership&id=<?php echo $m['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                    <form action="profile_action.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this request?');">
                                                        <input type="hidden" name="action" value="cancel_booking">
                                                        <input type="hidden" name="type" value="membership">
                                                        <input type="hidden" name="id" value="<?php echo $m['id']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Cancel</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Coaching Tab -->
                    <div class="tab-pane fade" id="v-pills-coaching" role="tabpanel" aria-labelledby="v-pills-coaching-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">My Coaching Bookings</h4>
                            <a href="coaching.php" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> Book Coaching</a>
                        </div>

                        <?php if(empty($coachings)): ?>
                            <div class="empty-state">
                                <i class="fa fa-calendar-times"></i>
                                <h5>No Coaching Records Found</h5>
                                <p>You haven't booked any coaching sessions yet.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-custom">
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Time Slot</th>
                                            <th>Age / Gender</th>
                                            <th>Contact</th>
                                            <th>Message</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($coachings as $c): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($c['level']); ?></td>
                                                <td><?php echo htmlspecialchars($c['timeslot']); ?></td>
                                                <td><?php echo htmlspecialchars($c['age']) . ' / ' . htmlspecialchars($c['gender']); ?></td>
                                                <td><?php echo htmlspecialchars($c['cno']); ?></td>
                                                <td><span class="d-inline-block text-truncate" style="max-width: 150px;"><?php echo htmlspecialchars($c['message']); ?></span></td>
                                                <td class="text-end">
                                                    <a href="booking_edit.php?type=coaching&id=<?php echo $c['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                    <form action="profile_action.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                        <input type="hidden" name="action" value="cancel_booking">
                                                        <input type="hidden" name="type" value="coaching">
                                                        <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Cancel</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Tee Time Tab -->
                    <div class="tab-pane fade" id="v-pills-tee" role="tabpanel" aria-labelledby="v-pills-tee-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">My Tee Time Bookings</h4>
                            <a href="time.php" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> Book Tee Time</a>
                        </div>

                        <?php if(empty($tee_times)): ?>
                            <div class="empty-state">
                                <i class="fa fa-golf-ball-tee"></i>
                                <h5>No Tee Times Found</h5>
                                <p>You haven't booked any tee times yet.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-custom">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Players</th>
                                            <th>Message</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tee_times as $t): ?>
                                            <tr>
                                                <td><?php echo date('d M Y', strtotime($t['date'])); ?></td>
                                                <td><?php echo date('h:i A', strtotime($t['time'])); ?></td>
                                                <td><?php echo htmlspecialchars($t['players']); ?></td>
                                                <td><span class="d-inline-block text-truncate" style="max-width: 150px;"><?php echo htmlspecialchars($t['message']); ?></span></td>
                                                <td class="text-end">
                                                    <a href="booking_edit.php?type=tee_time&id=<?php echo $t['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                    <form action="profile_action.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                                        <input type="hidden" name="action" value="cancel_booking">
                                                        <input type="hidden" name="type" value="tee_time">
                                                        <input type="hidden" name="id" value="<?php echo $t['id']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Cancel</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Teams Tab -->
                    <div class="tab-pane fade" id="v-pills-team" role="tabpanel" aria-labelledby="v-pills-team-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">My Teams</h4>
                            <a href="team.php" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> Register Team</a>
                        </div>

                        <?php if(empty($teams)): ?>
                            <div class="empty-state">
                                <i class="fa fa-users"></i>
                                <h5>No Teams Found</h5>
                                <p>You haven't joined or created any teams matching your email.</p>
                                <a href="team.php" class="btn btn-gold mt-3">Create Your First Team</a>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-custom">
                                    <thead>
                                        <tr>
                                            <th>Team Name</th>
                                            <th>Designation</th>
                                            <th>Gender</th>
                                            <th>Experience</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($teams as $tm): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($tm['name']); ?></td>
                                                <td><?php echo htmlspecialchars($tm['designation']); ?></td>
                                                <td><?php echo htmlspecialchars($tm['gender']); ?></td>
                                                <td><?php echo htmlspecialchars($tm['experience']); ?> Years</td>
                                                <td class="text-end">
                                                    <a href="booking_edit.php?type=team&id=<?php echo $tm['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                    <form action="profile_action.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this team?');">
                                                        <input type="hidden" name="action" value="cancel_booking">
                                                        <input type="hidden" name="type" value="team">
                                                        <input type="hidden" name="id" value="<?php echo $tm['id']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Cancel</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Tournament Tab -->
                    <div class="tab-pane fade" id="v-pills-tournament" role="tabpanel" aria-labelledby="v-pills-tournament-tab">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">My Tournaments</h4>
                            <a href="tounament.php" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> Register Tournament</a>
                        </div>

                        <?php if(empty($tournaments)): ?>
                            <div class="empty-state">
                                <i class="fa fa-trophy"></i>
                                <h5>No Tournaments Found</h5>
                                <p>You haven't registered for any tournaments.</p>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover table-custom">
                                    <thead>
                                        <tr>
                                            <th>Tournament</th>
                                            <th>Organizer</th>
                                            <th>Date</th>
                                            <th>Location</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($tournaments as $tn): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($tn['tname']); ?></td>
                                                <td><?php echo htmlspecialchars($tn['oname']); ?></td>
                                                <td><?php echo date('d M Y', strtotime($tn['date'])); ?></td>
                                                <td><?php echo htmlspecialchars($tn['location']); ?></td>
                                                <td class="text-end">
                                                    <a href="booking_edit.php?type=tounament&id=<?php echo $tn['id']; ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                    <form action="profile_action.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel your participation?');">
                                                        <input type="hidden" name="action" value="cancel_booking">
                                                        <input type="hidden" name="type" value="tounament">
                                                        <input type="hidden" name="id" value="<?php echo $tn['id']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Cancel</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
