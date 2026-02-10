<?php 
session_start(); 
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM blogs WHERE id = $id";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $date = $row['date'];
        $image = $row['image'];
        $content = $row['content'];
    } else {
        echo "Blog not found";
        exit;
    }
} else {
    echo "Invalid Request";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?> - GOLF KING SPORT CLUB</title>
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
      <h1 class="team-titel">Blog Detail</h1>
      <div class="breadcrumb-button">
       <a href="index.php" style="text-decoration: none;color: #fff;"> Home </a><span>›</span> <a href="blog.php" style="text-decoration: none;color: #fff;"> Blog </a> <span>›</span> Detail
      </div>
    </div>
  </section>

  <!-- blog detail -->

  <section>
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <article class="card card-style4 border-0">
            <img src="<?php echo $image; ?>" class="card-img-top rounded mb-4" alt="<?php echo $title; ?>">
            <div class="card-body px-0">
              <span class="text-muted mb-2 d-block"><?php echo $date; ?></span>
              <h2 class="mb-4"><?php echo $title; ?></h2>
              <div class="blog-content">
                  <p><?php echo $content; ?></p>
                  <!-- Placeholder for more content if needed -->
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                  <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
              
              <div class="mt-5">
                  <a href="blog.php" class="btn btn-secondary">Back to Blogs</a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>


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
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="service.php">Services</a></li>
                <li><a href="membership.php">Membership</a></li>
              </ul>
            </div>
            <div class="col-6">
              <ul>
                <li><a href="#">Gallery</a></li>
                <li><a href="team.php">Our Team</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="contact.php">Contact</a></li>
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
