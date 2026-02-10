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
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">

  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">

</head>

<body>
  <!-- header -->
<?php include 'header.php'; ?>

  <!-- sliders -->
  <div class="container-fluid">
    <div class="row">
      <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
       
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="5000">
            <img src="../image/slider1.jpg" class="img-fluid w-100" alt="Slide 1" />
            <div class="carousel-caption d-block ">
              <p class="carousel-heading text-white">Play Golf At Your Club</p>
              <p class="carousel-subheading text-white">Since its opening on August 15, 1995, the Golf Club has become a
                well known vacationer location drawing in golf players from all sides of the world.</p>
              <button class="btn carousel-button">READ MORE</button>
            </div>

          </div>

          <div class="carousel-item" data-bs-interval="5000">
            <img src="../image/slider2.jpg" class="img-fluid w-100" alt="Slide 2" />
            <div class="carousel-caption d-block ">
              <p class="carousel-heading text-white">Appreciate The Ultimate Golf</p>
              <p class="carousel-subheading text-white">Golf is one of the zone's most eminent golf clubs with a
                tremendous fairway, which is ideal for the two fledglings and expert players.</p>
              <button class="btn carousel-button">READ MORE</button>
            </div>
          </div>

          <div class="carousel-item">
            <img src="../image/slider3.jpg" class="img-fluid w-100" alt="Slide 3" />
            <div class="carousel-caption d-block ">
              <div class="intext">
                <p class="carousel-heading text-white">Enjoy Advantages Of Golf</p>
                <p class="carousel-subheading text-white">Known as a game of recreation and as a noble man's down, golf
                  is perhaps the most mainstream, generally welcomed sports around the world.</p>
                <button class="btn btn-success carousel-button">READ MORE</button>
              </div>

            </div>
          </div>
        </div>

        <div class="section">
          <div class="main">
            <p class="heading mt-3 ">Call to Information</p>
            <p class="sub-head">Call to our chief and get a guidance or contact us now</p>
          </div>
          <div class="child">
            <a href="contact.php">
            <button class="btnchild">QUICK CONTACT</button></a>
          </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </div>

  <!-- section near top -->
  <section class="features-section py-5 mt-5">
    <div class="container mmm">
      <div class="row g-4">
        <div class="col-sm-6 col-lg-3 ">
          <div class="feature-card text-center h-100  ">
            <div class="card-body">
              <img src="../image/feature-icon-01.png" alt="Training Camps" class="feature-icon mb-3">
              <h3 class="feature-title pt-2">Training Camps</h3>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="feature-card text-center h-100">
            <div class="card-body">
              <img src="../image/feature-icon-02.png" alt="Qualified Instructor" class="feature-icon mb-3">
              <h3 class="feature-title pt-2">Qualified Instructor</h3>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="feature-card text-center h-100">
            <div class="card-body">
              <img src="../image/feature-icon-03.png" alt="Group Lessons" class="feature-icon mb-3">
              <h3 class="feature-title pt-2">Group Lessons</h3>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="feature-card text-center h-100">
            <div class="card-body">
              <img src="../image/feature-icon-04.png" alt="Private Coaching" class="feature-icon mb-3">
              <h3 class="feature-title">Private Coaching</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="container sec-2">
    <div class="row">
      <div class="col-12">
        <h3 class="service-title">OUR SERVICE </h3>
        <h2 class="service-title2">Our Best Services</h2>
      </div>
      <div class="owl-carousel  owl-loaded mt-5 pt-2" id="service">
        <div class="owl-stage-outer">
          <div class="owl-stage">
            <div class="owl-item">
              <img src="../image/service-01.jpg" height="500px" width="360px" class="item-img" alt="">
              <div class="ser-img-tex">
                <h3 class="ser-tex1">Golf Coaching</h3>
                <h5 class="ser-tex2">Best Ground</h5>
              </div>
            </div>
            <div class="owl-item">
              <img src="../image/service-02.jpg" height="500px" width="360px" class="item-img" alt="">
              <div class="ser-img-tex">
                <h3 class="ser-tex1">Special Service</h3>
                <h5 class="ser-tex2">Best Trainers</h5>
              </div>
            </div>
            <div class="owl-item">
              <img src="../image/service-03.jpg" height="500px" width="360px" class="item-img" alt="">
              <div class="ser-img-tex">
                <h3 class="ser-tex1">Private Coaching</h3>
                <h5 class="ser-tex2">Book Excerpt</h5>
              </div>
            </div>
            <div class="owl-item">
              <img src="../image/service-04.jpg" height="500px" width="360px" class="item-img" alt="">
              <div class="ser-img-tex">
                <h3 class="ser-tex1">Become A Member</h3>
                <h5 class="ser-tex2">Best Ground</h5>
              </div>
            </div>
            <div class="owl-item">
              <img src="../image/service-05.jpg" height="500px" width="360px" class="item-img" alt="">
              <div class="ser-img-tex">
                <h3 class="ser-tex1">Host A Tournament</h3>
                <h5 class="ser-tex2">Book Excerpt</h5>
              </div>
            </div>
            <div class="owl-item">
              <img src="../image/service-06.jpg" height="500px" width="360px" class="item-img" alt="">
              <div class="ser-img-tex">
                <h3 class="ser-tex1">Course Gide</h3>
                <h5 class="ser-tex2">Best Trainers</h5>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Stats Section -->
  <section class="counters">
    <div class="counter-box">
      <h2>9525+</h2>
      <p>ACTIVE MEMBERS</p>
    </div>
    <div class="counter-box">
      <h2>690+</h2>
      <p>PLAYED TOURNAMENTS</p>
    </div>
    <div class="counter-box">
      <h2>6913+</h2>
      <p>TEE TIMES</p>
    </div>
    <div class="counter-box">
      <h2>1249+</h2>
      <p>BALLS IN THE LACK</p>
    </div>
  </section>

  <!-- about  -->

  <section class="container py-5">
    <div class="row align-items-center">
      <!-- Left Column: Image -->
      <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="about-image">
          <img src="../image/about-3.jpg" class="img-fluid rounded" alt="Golf Image" />
          <div class="experience-box">
            <span>36+</span>
            Years of <br /> experience
          </div>
        </div>
      </div>

      <!-- Right Column: Text -->
      <div class="col-lg-6 about-text">
        <h6 class="text-uppercase  fw-semibold mb-2 pt-5 pb-3" style="color: #caa850;">About Us</h6>
        <h2 class="mb-4 text-dark pb-4">Improve your golf swing <br /> acquire a serious edge</h2>
        <p class="lead-border text-muted mb-4">
          It is a long established fact that a reader will be distracted by the readable content of a page when looking
          at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal.
        </p>
        <hr class=" mt-5 line">
        <div class="row text-muted mb-4 d-flex align-items-center justify-content-evenly mt-5 ">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-2">

            <div class="ab-icon d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-users-gear fa-2xl pb-2" style="color: #caa850;"></i>
              <h5 class="mb-4 text-dark fw-semibold ms-4">Expert Team<br />Member</h5>
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-2">
            <div class="ab-icon d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-trophy fa-2xl pb-2" style="color: #caa850;"></i>
              <h5 class="mb-4 text-dark fw-semibold ms-4">Regular<br />Competitions</h5>
            </div>
          </div>
        </div>
        <hr class="mt-3 line">
        <div class="row text-muted mb-4 d-flex align-items-center justify-content-evenly mt-5 ">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-2">
            <a href="about.php">
            <button class="about ms-5">READ MORE</button></a>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-2">
            <div class="ab-icon d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-phone fa-2xl pb-2" style="color: #caa850;"></i>
              <div class="icon-con  p-4">
                <div class="text-muted">Call Us Anytime</div>
                <div class="fw-bold fs-5">(+44) 123 456 789</div>
              </div>
            </div>
          </div>
        </div>

      </div>

  </section>

  <!-- team section start -->
  <section class="py-5">
    <div class="container-fluid ">
      <div class="text-center mb-5">
        <span class="section-title">Our Team</span>
        <h2 class="team-heading">Coaches and Instructors</h2>
      </div>

      <div class="row g-4">
        <!-- Left Column -->
        <div class="col-lg-4">
          <div class="team-left-box h-100 d-flex flex-column justify-content-center">
            <h2>Welcome to royal<br>Golf club</h2>
            <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text,
              and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have
              evolved.</p>
          </div>
        </div>

        <!-- Team Members -->
        <div class="col-lg-8">
          <div class="owl-carousel owl-theme" id="team">
            <!-- Card 1 -->
            <div class="item">
              <div class="team-card bg-img1">
                <div class="team-content">
                  <h6 class="team-role">Coach</h6>
                  <h3 class="team-name">Edith Kyzer</h3>
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

            <!-- Card 2 -->
            <div class="item">
              <div class="team-card bg-img2">
                <div class="team-content">
                  <h6 class="team-role">Coach</h6>
                  <h3 class="team-name">Buford Williams</h3>
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

            <!-- Card 3 -->
            <div class="item">
              <div class="team-card bg-img3">
                <div class="team-content">
                  <h6 class="team-role">Coach</h6>
                  <h3 class="team-name">Jorja Finnerty</h3>
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

            <div class="item">
              <div class="team-card bg-img4">
                <div class="team-content">
                  <h6 class="team-role">Coach</h6>
                  <h3 class="team-name">Charlie Carboni</h3>
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

            <div class="item">
              <div class="team-card bg-img5">
                <div class="team-content">
                  <h6 class="team-role">Coach</h6>
                  <h3 class="team-name">Paige Chaffy</h3>
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


            <div class="item">
              <div class="team-card bg-img6">
                <div class="team-content">
                  <h6 class="team-role">Coach</h6>
                  <h3 class="team-name">Jackson Buley</h3>
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
          </div>
        </div>
      </div>
  </section>

  <!-- price -->
  <section class="pricing-section">
    <div class="container">
      <div class="text-center mb-5">
        <span class="section-title">Our Pricing</span>
        <h2 class="h1 mb-0 text-secondary">Choose Best Pricing Plan</h2>
      </div>
      <div class="row gy-4">
        <!-- Silver Plan -->
        <div class="col-md-6 col-lg-4 mt-3">
          <div class="card pricing-card h-100">
            <div class="card-header text-center border-0 bg-white">
              <h6 class="plan-title">Silver Plan</h6>
              <h3 class="price">$299<span class="price-duration">/month</span></h3>
              <div class="price-icon">
                <img src="../image/plan-icon-01.png" alt="Silver Plan Icon" class="img-fluid p-3">
              </div>
            </div>
            <div class="card-body text-center">
              <ul class="list-unstyled mb-4">
                <li>10 Premium Range Balls</li>
                <li>Individual Lesson</li>
                <li>3 Lesson Package</li>
              </ul>
              <a href="membership.php" class="btn btn-gold">Purchase</a>
            </div>
          </div>
        </div>

        <!-- Gold Plan -->
        <div class="col-md-6 col-lg-4 mt-3 ">
          <div class="card pricing-card h-100">
            <div class="card-header text-center border-0 bg-white ">
              <h6 class="plan-title">Gold Plan</h6>
              <h3 class="price">$499<span class="price-duration">/month</span></h3>
              <div class="price-icon">
                <img src="../image/plan-icon-02.png" alt="Gold Plan Icon" class="img-fluid p-3">
              </div>
            </div>
            <div class="card-body text-center">
              <ul class="list-unstyled mb-4">
                <li>20 Premium Range Balls</li>
                <li>Individual Lesson</li>
                <li>7 Lesson Package</li>
              </ul>
              <a href="membership.php" class="btn btn-gold">Purchase</a>
            </div>
          </div>
        </div>

        <!-- Royal Plan -->
        <div class="col-md-6 col-lg-4 mt-3">
          <div class="card pricing-card h-100">
            <div class="card-header text-center border-0 bg-white">
              <h6 class="plan-title">Royal Plan</h6>
              <h3 class="price">$699<span class="price-duration">/month</span></h3>
              <div class="price-icon">
                <img src="../image/plan-icon-03.png" alt="Royal Plan Icon" class="img-fluid p-3">
              </div>
            </div>
            <div class="card-body text-center">
              <ul class="list-unstyled mb-4">
                <li>35 Premium Range Balls</li>
                <li>Individual Lesson</li>
                <li>10 Lesson Package</li>
              </ul>
              <a href="membership.php" class="btn btn-gold">Purchase</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- blog section -->

  <section>
    <div class="container py-5">
      <div class="text-center mb-4">
        <span class="section-title">OUR BLOG</span>
        <h2 class="h1 mb-0">Latest News & Updates</h2>
      </div>
      <div class="row mt-4">
        <?php
        include 'db.php';
        $sql = "SELECT * FROM blogs ORDER BY id DESC LIMIT 3";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                  <article class="card card-style4 h-100 mt-3">
                    <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
                    <div class="card-body position-relative pt-5 px-4 pb-4">
                      <span><?php echo $row['date']; ?></span>
                      <h3>
                        <a href="blog-detail.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                      </h3>
                      <p><?php echo substr($row['content'], 0, 100) . '...'; ?></p>
                      <a href="blog-detail.php?id=<?php echo $row['id']; ?>" class="read-more-link">Read more <i class="ti-arrow-right"></i></a>
                    </div>
                  </article>
                </div>
                <?php
            }
        }
        ?>
      </div>
    </div>
  </section>


  <!-- logo item -->

  <section class="pattern-bg text-center">
    <div class="container-fluid">
      <div class="owl-carousel client-carousel" id="logo-item">
        <div class="item"><img src="../image/client-01.png" alt="Client 1"></div>
        <div class="item"><img src="../image/client-02.png" alt="Client 2"></div>
        <div class="item"><img src="../image/client-03.png" alt="Client 3"></div>
        <div class="item"><img src="../image/client-04.png" alt="Client 4"></div>
        <div class="item"><img src="../image/client-05.png" alt="Client 5"></div>
        <div class="item"><img src="../image/client-06.png" alt="Client 6"></div>
        <div class="item"><img src="../image/client-07.png" alt="Client 7"></div>
        <div class="item"><img src="../image/client-08.png" alt="Client 8"></div>
        <div class="item"><img src="../image/client-09.png" alt="Client 9"></div>
        <div class="item"><img src="../image/client-10.png" alt="Client 10"></div>
      </div>
    </div>
  </section>

  <!-- footer section -->

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