<?php session_start(); ?>
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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<?php include 'header.php'; ?>

    <section class="page-title-section">

        <div class="content">
            <h1 class="team-titel">Host Tounament</h1>
            <div class="breadcrumb-button">
                <a href="index.php" style="text-decoration: none;color: #fff;"> Home </a><span>›</span> Host Tounament
            </div>
        </div>
    </section>




<!-- Tournament Form -->
<section class="py-5">
  <div class="container">
    <h2 class="fw-bold text-center mb-4">Host a Golf Tournament</h2>
    <form class="p-4 shadow rounded bg-light">
      <div class="mb-3">
        <label class="form-label">Tournament Name</label>
        <input type="text" class="form-control" placeholder="Enter Tournament Name" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Organizer Name</label>
        <input type="text" class="form-control" placeholder="Organizer Full Name" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Location</label>
        <input type="text" class="form-control" placeholder="Tournament Location" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contact Email</label>
        <input type="email" class="form-control" placeholder="Enter Email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Additional Details</label>
        <textarea class="form-control" rows="4" placeholder="Provide details (optional)"></textarea>
      </div>
      <button type="submit" class="btn w-100" style="background-color: #25395b; color: #fff;">Submit Tournament</button>
    </form>
  </div>
</section>





    <!-- footer section -->

    <footer class="footer">
        <div class="footer-left col-xl-4">
            <div class="footer-logo">
                <img src="../image/footer-light-logo.png" alt="Golf Logo" />
            </div>
            <p>Golf club has become a famous vacationer location drawing in golf players from all sides of the world.
            </p>
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

</html>