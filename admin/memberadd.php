<?php
    include "lib/db.php";

    if(isset($_POST['submit']))
    {
        $name=$_POST['name'];
        $designation=$_POST['designation'];
        $gender=$_POST['gender'];
        $experience=$_POST['experience'];
        $image=$_FILES['image']['name'];
        $tmp_name=$_FILES['image']['tmp_name'];
        $path='img/'.$image;
        move_uploaded_file($tmp_name,$path);

        // Ideally use prepared statements here too for security
        $stmt = $con->prepare("INSERT INTO `team`(`id`, `name`, `designation`, `gender`, `experience`,`image`) VALUES (null, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $designation, $gender, $experience, $image);
        $stmt->execute();
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
       
        <?php include "sidebar.php"; ?>

        <!-- Content Start -->
        <div class="content">
            <?php include "header.php"; ?>

            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    
                    <div class="container py-5 w-50">
                         <div class="card shadow p-4 border-0 bg-white">
                            <h3 class="mb-4 text-primary">➕ Add Team Member</h3>
                            <form method="post" enctype="multipart/form-data">
                              <div class="row g-3">
                                <!-- Name & Designation -->
                                <div class="col-md-12 text-start">
                                  <label class="form-label text-dark">Full Name</label>
                                  <input type="text" name="name" class="form-control bg-white text-dark border" required>
                                </div>
                                <div class="col-md-12 text-start">
                                  <label class="form-label text-dark">Designation</label>
                                  <input type="text" name="designation" class="form-control bg-white text-dark border" required>
                                </div>

                                <!-- Gender -->
                                <div class="col-md-12 text-start">
                                  <label class="form-label text-dark">Gender</label>
                                  <select name="gender" class="form-select bg-white text-dark border" required>
                                    <option value="">-- Select Gender --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                  </select>
                                </div>

                                <div class="col-md-12 text-start">
                                  <label class="form-label text-dark">Experience</label>
                                  <input type="text" name="experience" class="form-control bg-white text-dark border" required>
                                </div>

                                <!-- Profile Image -->
                                <div class="col-md-12 text-start">
                                  <label class="form-label text-dark">Profile Image</label>
                                  <input type="file" name="image" class="form-control bg-white text-dark border" accept="image/*" required>
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
</body>
</html>