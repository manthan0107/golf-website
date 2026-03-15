<?php
    include "lib/db.php";
    
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

    $errorMsg = "";
    $successMsg = "";

    if(isset($_POST['submit']))
    {
        $name = sanitize($_POST['name']);
        $designation = sanitize($_POST['designation']);
        $gender = sanitize($_POST['gender']);
        $experience = sanitize($_POST['experience']);
        
        // PHP validation
        if(empty($name) || empty($designation) || empty($gender) || empty($experience)) {
             $errorMsg = "All fields except image are required.";
        } elseif(!preg_match("/^[A-Za-z\s]{3,}$/", $name)) {
             $errorMsg = "Name must be at least 3 characters and contain only letters and spaces.";
        } else {
            // Image validation
            $uploadOk = 1;
            $image = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $path = 'img/'.$image;
            $imageFileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png'];

            if (!in_array($imageFileType, $allowed_types)) {
                $errorMsg = "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOk = 0;
            } elseif ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
                $errorMsg = "Image size exceeds 2MB limit.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                if(move_uploaded_file($tmp_name, $path)) {
                    $stmt = $con->prepare("INSERT INTO `team`(`name`, `designation`, `gender`, `experience`,`image`) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $name, $designation, $gender, $experience, $image);
                    
                    if($stmt->execute()) {
                        $successMsg = "Member added successfully!";
                    } else {
                        $errorMsg = "Database Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $errorMsg = "Failed to upload image.";
                }
            }
        }
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
       
        <?php include "sidebar.php"; ?>

        <!-- Content Start -->
        <div class="content">
            <?php include "header.php"; ?>

            <div class="container-fluid pt-4 px-4">
                <?php if($errorMsg != ""): ?>
                    <div class="alert alert-danger px-3 py-2"><?php echo $errorMsg; ?></div>
                <?php endif; ?>
                <?php if($successMsg != ""): ?>
                    <div class="alert alert-success px-3 py-2"><?php echo $successMsg; ?></div>
                <?php endif; ?>
                <div class="bg-secondary text-center rounded p-4">
                    
                    <div class="container py-5 w-50">
                         <div class="card shadow p-4 border-0 bg-white">
                            <h3 class="mb-4 text-primary">➕ Add Team Member</h3>
                            <form id="memberAddForm" method="post" enctype="multipart/form-data" onsubmit="return validateMemberAdd()">
                              <div class="row g-3">
                                <!-- Name & Designation -->
                                <div class="col-md-12 text-start position-relative mb-2">
                                  <label class="form-label text-dark">Full Name</label>
                                  <input type="text" name="name" id="nameid" class="form-control bg-white text-dark border" required onblur="Validator.validateName(this)">
                                </div>
                                <div class="col-md-12 text-start position-relative mb-2">
                                  <label class="form-label text-dark">Designation</label>
                                  <input type="text" name="designation" id="designationid" class="form-control bg-white text-dark border" required onblur="Validator.validateRequired(this, 'Designation')">
                                </div>

                                <!-- Gender -->
                                <div class="col-md-12 text-start position-relative mb-2">
                                  <label class="form-label text-dark">Gender</label>
                                  <select name="gender" id="genderid" class="form-select bg-white text-dark border" required onblur="Validator.validateRequired(this, 'Gender')">
                                    <option value="">-- Select Gender --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                  </select>
                                </div>

                                <div class="col-md-12 text-start position-relative mb-2">
                                  <label class="form-label text-dark">Experience</label>
                                  <input type="text" name="experience" id="experienceid" class="form-control bg-white text-dark border" required onblur="Validator.validateRequired(this, 'Experience')">
                                </div>

                                <!-- Profile Image -->
                                <div class="col-md-12 text-start position-relative mb-2">
                                  <label class="form-label text-dark">Profile Image</label>
                                  <input type="file" name="image" id="imageid" class="form-control bg-white text-dark border" accept="image/*" required onchange="Validator.validateImageUpload(this)">
                                </div>

                                <!-- Buttons -->
                                <div class="col-12 d-flex justify-content-center gap-2 mt-3">
                                  <input type="submit" name="submit" class="btn btn-primary">
                                  <a href="membershow.php" class="btn btn-secondary">View All</a>
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
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
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
        function validateMemberAdd() {
            let isValid = true;
            isValid = Validator.validateName(document.getElementById('nameid')) && isValid;
            isValid = Validator.validateRequired(document.getElementById('designationid'), 'Designation') && isValid;
            isValid = Validator.validateRequired(document.getElementById('genderid'), 'Gender') && isValid;
            isValid = Validator.validateRequired(document.getElementById('experienceid'), 'Experience') && isValid;
            isValid = Validator.validateImageUpload(document.getElementById('imageid')) && isValid;
            return isValid;
        }
    </script>
</body>
</html>