<?php
session_start();
    $alert = 0;
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        unset($_SESSION['alert']);
    }
    
    $con=mysqli_connect("localhost","root","","golfweb");

    if (isset($_POST['submit'])) {
        if (!isset($_SESSION['user_id'])) {
            echo "<script>alert('Please log in to register a team.'); window.location.href='login.php';</script>";
            exit;
        }

        $name = $_POST['name'];
        $designation = $_POST['designation'];
        $gender = $_POST['gender'];
        $experience = (int)$_POST['experience'];
        $email = trim($_POST['email']);
        
        // Email Validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $alert = 3;
        } else {
            // Image Upload Handling
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = $_FILES['image']['name'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $allowedExts = array('jpg', 'jpeg', 'png');

                if (in_array($fileExtension, $allowedExts)) {
                    $uploadBaseDir = '../../uploads/team/';
                    if (!is_dir($uploadBaseDir)) {
                        mkdir($uploadBaseDir, 0777, true);
                    }
                    
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $destPath = $uploadBaseDir . $newFileName;
                    
                    if (move_uploaded_file($fileTmpPath, $destPath)) {
                        $imagePath = $destPath;

                        $stmt = $con->prepare("INSERT INTO team (name, designation, gender, experience, email, image) VALUES (?, ?, ?, ?, ?, ?)");
                        $stmt->bind_param("sssiss", $name, $designation, $gender, $experience, $email, $imagePath);

                        if ($stmt->execute()) {
                            $_SESSION['alert'] = 1; // success
                            header("Location: team.php");
                            exit;
                        } else {
                            $alert = 2; // error
                        }
                        $stmt->close();
                    } else {
                        $alert = 4; // Upload error
                    }
                } else {
                    $alert = 5; // Invalid file type
                }
            } else {
                $alert = 6; // Image not provided or error
            }
        }
    }

    $sql = "SELECT name, designation, image FROM team";
    
    $result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GOLF KING SPORT CLUB</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<?php include 'header.php'; ?>
<!-- hero section -->

 <section class="page-title-section">
  
    <div class="content">
      <h1 class="team-titel">Our Team</h1>
      <div class="breadcrumb-button">
       <a href="index.php" style="text-decoration: none;color: #fff;"> Home </a><span>›</span> Our Team
      </div>
    </div>
  </section>

    <!-- ===Aleart using PHP -->
     <?php
     if($alert==1) {
        echo '<div class="alert alert-success alert-dismissible fade show container mt-4" role="alert">
  <strong>Success!</strong> Your Team added successfully. It is now visible in your Profile.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
     } elseif ($alert==2) {
        echo '<div class="alert alert-danger alert-dismissible fade show container mt-4" role="alert">
  <strong>Error!</strong> Failed to add team.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
     } elseif ($alert==3) {
        echo '<div class="alert alert-danger alert-dismissible fade show container mt-4" role="alert">
  <strong>Error!</strong> Invalid email format.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
     } elseif ($alert==4) {
        echo '<div class="alert alert-danger alert-dismissible fade show container mt-4" role="alert">
  <strong>Error!</strong> Failed to upload image.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
     } elseif ($alert==5) {
        echo '<div class="alert alert-danger alert-dismissible fade show container mt-4" role="alert">
  <strong>Error!</strong> Invalid file type. Only JPG, JPEG, and PNG are allowed.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
     } elseif ($alert==6) {
        echo '<div class="alert alert-danger alert-dismissible fade show container mt-4" role="alert">
  <strong>Error!</strong> Please select an image to upload.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
     }
     ?>

  <!-- team member -->
  <section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-title">Our Team</span>
            <h2 class="team-heading">Coaches and Instructors</h2>
        </div>

        <div class="row">
            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $name = $row['name'];
                    $designation = $row['designation'];
                    $image = $row['image'];   // image file name saved in admin
                    
                    if (strpos($image, '/') !== false) {
                        $displayImage = $image;
                    } else {
                        $displayImage = '../../admin/img/' . $image;
                    }
            ?>

            <div class="col-sm-12 col-xs-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4 mt-4">
                <div class="team-mem" style="background-image: url('<?php echo htmlspecialchars($displayImage); ?>'); background-size: cover; background-position: center;">
                    <div class="team-content">
                        <h6 class="team-role" style="color: rgb(255, 186, 101);">
                            <?php echo $designation; ?>
                        </h6>

                        <h3 class="team-name">
                            <?php echo $name; ?>
                        </h3>

                        <div class="social-icons">
                            <ul>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                }
            } else {
                echo "<h3 class='text-center'>No Team Members Found</h3>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Team Registration Form -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="fw-bold text-center mb-4">Register Your Team</h2>
    <form class="p-4 shadow rounded bg-white" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Team Name</label>
          <input type="text" class="form-control" name="name" placeholder="Enter Team Name" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Role / Designation</label>
          <input type="text" class="form-control" name="designation" placeholder="e.g. Captain, Player" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Gender</label>
          <select class="form-select" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Experience (Years)</label>
          <input type="number" min="0" class="form-control" name="experience" placeholder="0" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
        </div>
        <div class="col-md-6 mb-3">
          <label class="form-label">Team Member Image</label>
          <input type="file" class="form-control" name="image" accept=".jpg, .jpeg, .png" required>
        </div>
      </div>
      
      <?php if (!isset($_SESSION['user_id'])): ?>
          <p class="text-danger text-center">You must be logged in to register a team.</p>
          <a href="login.php" class="btn w-100" style="background-color: #25395b; color: #fff;">Log In to Register</a>
      <?php else: ?>
          <input type="submit" class="btn w-100" name="submit" value="Register Team" style="background-color: #25395b; color: #fff;"/>
      <?php endif; ?>
    </form>
  </div>
</section>


  <!-- footer -->

    <footer class="footer">
    <div class="footer-left col-xl-4">
      <div class="footer-logo">
        <img src="../image/footer-light-logo.png" alt="Golf Logo" />
      </div>
      <p>Golf club has become a famous vacationer location drawing in golf players from all sides of the world.</p>
      <div class="social-icons1">
        <i class="fa-brands fa-facebook-f" style="color: #25395b;"></i>
        <i class="fa-brands fa-twitter ps-2" style="color: #25395b;"></i>
        <i class="fa-brands fa-youtube ps-2" style="color: #25395b;"></i>
        <i class="fa-brands fa-linkedin-in ps-2" style="color: #25395b;"></i>

      </div>
      <p class="copyright">&copy; <span class="current-year"></span> Golf is Powered by <a href="#"
          style="color:  #0f2d4a;">Rahul & group</a></p>
    </div>

    <div class="footer-right col-xl-8">
      <div class="row">
        <div class="col-md-4">
          <div class="section-title">Quick Link</div>
          <div class="row mt-3">
            <div class="col-6">
              <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Membership</a></li>
              </ul>
            </div>
            <div class="col-6">
              <ul>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Our Team</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="section-title">Contact Us</div>
          <div class="mt-3">
            <div class="icon-text">
              <i class="fas fa-map-marker-alt pt-1"></i>
              <span>66 Guild Street 512B, Great North Town.</span>
            </div>
            <div class="icon-text">
              <i class="fa-solid fa-phone pt-1"></i>
              <span>(+44) 123 456 789</span>
            </div>
            <div class="icon-text">
              <i class="far fa-envelope pt-1"></i>
              <span>info@yourdomain.com</span>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="section-title">Get News</div>
          <p class="mt-3">Subscribe to our newsletter for discounts and more.</p>
          <form class="newsletter d-flex">
            <input type="email" placeholder="Subscribe with us" />
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
          </form>
        </div>
      </div>
    </div>
  </footer>
  
</body>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
  integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../js/slide.js"></script>
</html>