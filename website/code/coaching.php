<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
    alert('Please do login!');
    window.location.href = 'login.php';
          </script>";
    exit;
}

  $aleart=0;
  $con=mysqli_connect("localhost","root","","golfweb");

  // Fetch user email for insertion
  $user_id = $_SESSION['user_id'];
  $stmt_user = mysqli_prepare($con, "SELECT email FROM register WHERE id = ?");
  mysqli_stmt_bind_param($stmt_user, "i", $user_id);
  mysqli_stmt_execute($stmt_user);
  $user_res = mysqli_stmt_get_result($stmt_user)->fetch_assoc();
  $email = $user_res['email'];
  mysqli_stmt_close($stmt_user);

  if(isset($_POST['submit']))
  {
    $name=$_POST['name'];
    $cno=$_POST['cno'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $level=$_POST['level'];
    $timeslot=$_POST['timeslot'];
    $message=$_POST['message'];

    $qry="INSERT INTO `coaching`(`id`, `name`, `email`, `cno`, `age`, `gender`, `level`, `timeslot`, `message`) VALUES (null,'$name','$email','$cno','$age','$gender','$level','$timeslot','$message')";

    if(mysqli_query($con,$qry))
    {
      $aleart=1;
    }

  }
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
    

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">

  <style>
        .form-section {
        padding: 60px 0;
    }
    .form-title {
        color: #d4a64e;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
    }
    .form-heading {
        font-weight: 700;
        font-size: 32px;
        margin-bottom: 20px;
    }
    .form-description {
        color: #666;
        margin-bottom: 30px;
        line-height: 1.6;
    }
    .form-card {
        background: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .btn-gold {
        background-color: #d4a64e;
        border: none;
        color: white;
        padding: 10px 20px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-gold:hover {
        background-color: #b78b3e;
    }
  </style>

</head>
<body>


<?php include 'header.php'; ?>



  <!-- ===Aleart using PHP -->
     <?php
     
     if($aleart==1)
     {
        echo '<div class="alert alert-success alert-dismissible fade show container" role="alert">
  <strong>Success!</strong> Your Coaching Registration successfully completed.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
     }
     ?>
<!-- hero section -->

 <section class="page-title-section">
  
    <div class="content">
      <h1 class="team-titel">GOlf COACHING</h1>
      <div class="breadcrumb-button">
       <a href="index.php" style="text-decoration: none;color: #fff;"> Home </a><span>›</span> Golf Coathing
      </div>
    </div>
  </section>

<!-- golf coaching from -->
  <section class="form-section">
    <div class="container">
        <div class="row align-items-center g-5">
            
            <!-- Left Content -->
            <div class="col-lg-5">
                <p class="form-title">Get in Touch</p>
                <h2 class="form-heading">Golf Coaching Registration Form</h2>
                <p class="form-description">
                    Improve your golf skills with our expert coaches.  
                    Whether you’re a beginner or a seasoned player,  
                    our tailored coaching sessions will help you excel on the course.  
                    Fill out the form to book your spot today.
                </p>
                <img src="../image/coach.jpeg" class="img-fluid rounded" alt="Golf Coaching">
            </div>

            <!-- Right Form -->
            <div class="col-lg-7">
                <div class="form-card">
                    <form method="post" >
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address <span class="text-danger">*</span></label>
                               <input type="email"
class="form-control"
name="email"
placeholder="Enter your email"
value="<?php echo htmlspecialchars(isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''); ?>"
required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" min="0" name="cno" placeholder="Enter your phone number" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Age <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" min="0" name="age" placeholder="Your age" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender">
                                    <option selected disabled>Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Skill Level</label>
                                <select class="form-select" name="level">
                                    <option selected disabled>Select your skill level</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Advanced">Advanced</option>
                                </select>
                            </div>
                           
                            <div class="col-md-6">
                                <label class="form-label">Preferred Time Slot</label>
                                <select class="form-select" name="timeslot">
                                    <option selected disabled>Select time slot</option>
                                    <option value="Morning">Morning</option>
                                    <option value="Afternoon">Afternoon</option>
                                    <option value="Evening">Evening</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message / Additional Info</label>
                                <textarea class="form-control" rows="4" name="message" placeholder="Tell us more"></textarea>
                            </div>
                         
                            <div class="col-12">
                                <input type="submit" name="submit" class="btn btn-gold mt-3">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
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
