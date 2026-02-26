<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- ===============Bootstrap Link====================== -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <!-- ===============Font-Awesome Icon Link====================== -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link rel="stylesheet" href="../css/style.css">
  

  <title>About Page</title>
  <style>
    /* header style */

    .glass {
      width: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .nav-item,
    ul,
    a {
      font-size: 17px;
      font-weight: 700;
      color: #15395a;
      padding: 5px ;
    }

    .nav-item,
    ul,
    a:hover {
      font-size: 17px;
      font-weight: 700;
      color: #ceaa4d;
    }

    .header-style2 .navbar-brand img {
      max-height: 60px;
    }

    .header-style2 .dropdown-menu {
      border: none;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    
    .header-style2 .position-static .dropdown-menu {
      top: auto;
      left: 0;
    }

    .header-style2 .dropdown-submenu {
      position: relative;
    }

    .header-style2 .dropdown-submenu .dropdown-menu {
      top: 0;
      left: 100%;
      margin-left: 0.1rem;
    }

    .header-style2 .attr-nav .nav-link {
      color: #15395a;
      font-size: 18px;
    }

    .header-style2 .btn-primary {
      background-color: #ceaa4d;
      border-color: #ceaa4d;
      font-weight: 500;
    }

    .header-style2 .btn-primary:hover {
      background-color: #15395a;
      border-color: #0a3a72;
      transition: 1s;
    }

    /* --------------Styling For Hero Section--------------- */
    #hero_section {
      background-image: url(../image/Hero_Background_image.jpg);
      background-repeat: no-repeat;
      background-position: center;
      background-size: cover;
      padding: 130px 0;
      /* filter:brightness(0.7); */
    }

    /* .hero_text
        {
            background-color: red;
        } */
    .hero_list {
      background-color: #ceaa4d;
      padding: 7px 0;
      /* line-height: 1.1; */
      width: 20%;
      margin: auto;
      border-radius: 4px;
    }

    .hero_list li {
      display: inline-block;
      color: white;
    }

    .hero_list li a {
      color: #fff;
      /* font-size: 1rem; */
      font-weight: 700;
      text-decoration: none;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    /* Fixed Icon Styling */

    .add_cart {
      position: fixed;
      z-index: 999;
      top: 10%;
      right: 0;
      padding: 5px;
      background-color: #ceaa4d;
    }

    .add_cart a {
      padding: 2px 10px;
      text-decoration: none;
    }

    .add_cart i {
      font-size: large;
      color: white;
      vertical-align: middle;
    }

    .add_cart span {
      display: none;

      font-size: small;
      font-weight: 400;
      font-family: "Times New Roman", Times, serif;
      vertical-align: middle;
    }

    .add_cart a:hover>span {
      display: inline-block;
    }

    /*  */
    .quick_msg {
      position: fixed;
      z-index: 999;
      top: 17%;
      right: 0;
      padding: 5px;
      background-color: rgb(45, 45, 158);
    }

    .quick_msg a {
      padding: 2px 10px;
      text-decoration: none;
    }

    .quick_msg i {
      font-size: large;
      color: white;
      vertical-align: middle;
    }

    .quick_msg span {
      display: none;
      font-size: small;
      font-weight: 400;
      font-family: "Times New Roman", Times, serif;
      vertical-align: middle;
    }

    .quick_msg a:hover>span {
      display: inline-block;
    }

    /* ========About_section STyling============== */
    #about_section {
      padding: 100px 0;
    }

    /* .about_container
        { 
            background-color: bisque;

        } */

      .about_container .row1 h5 {
        color: #ceaa4d;
      }

      .about_container .row1 h1 {
        color: #15395a;
        /* font-family: 'Times New Roman', Times, serif; */
        font-family: sans-serif;
        font-weight: bolder;
        letter-spacing: 1px;
      }

      .about_container .row1 hr {
        background-color: #d49d10;
        width: 6%;
        height: 3px;
        border: none;
        margin-left: 1rem;
      }

    .about_container .row1 p {
      color: #575a7b;
    }

    /* ========Our Team Section  STyling============== */
    #team_section {
      background-color: #b7953edc;
      /* background-image: url(Img/pattern-bg.jpg); */

      filter: brightness(1.1);

      height: auto;
    }

    .team-text-1 {
      font-weight: bolder;
      letter-spacing: 1px;
      /* font-family: serif; */
    }

    .hrforteam {
      height: 1.2px;
      width: 60px;
      background-color: white;
    }

    .team-text-2 {
      letter-spacing: 1px;
      font-family: serif;
    }

    /* --- */
    /* .team-photo-container {
      background-color: red;
    } */

    .team-photo {
      border-radius: 10px;
      position: relative;

    }

    .team-photo-container #team-1 {
      /* height: 75vh; */
      height: 500px;
      background-image: url(../image/team-01.jpg);
      /* background-attachment: fixed; */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      filter: brightness(0.8);
    }

    .team-photo-container #team-2 {
      height: 500px;
      background-image: url(../image/team-02.jpg);
      /* background-attachment: fixed; */
      filter: brightness(0.8);

      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .team-photo-container #team-3 {
      height: 500px;
      width: 100%;
      filter: brightness(0.8);
      background-image: url(../image/team-03.jpg);
      /* background-attachment: fixed; */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .team-photo-inner {
      filter: contrast(1.4) brightness(1.1);
      position: relative;
      padding-top: 370px;
      padding-left: 10px;
      /* bottom: 10px; */
      /* left: 5%; */
    }

    .team-photo-inner p {
      color: #ceaa4d;
      font-weight: bolder;
    }

    .team-photo-inner h2 {
      color: rgb(255, 252, 252);
      font-family: serif;
    }

    .team-social {
      /* display: none; */
      transition: all 0.2s ease-out;
      visibility: hidden;

      transform: translateY(25px);
    }

    .team-photo:hover .team-social {
      /* position: relative; */
      transition: 0.5s;
      transform: translateY(0);
      /* display: inline-block; */
      visibility: visible;
    }

    .team-photo:hover {
      opacity: 0.9;
    }

    .team-social i {
      color: #d49d10;
      margin: 1px 5px;
    }


    /* FOOTER */

    .footer {
      display: flex;
      flex-wrap: wrap;
    }

    .footer-left {
      background: #fff;
      padding: 50px 40px;
    }

    .footer-left .footer-logo img {
      width: 160px;
    }

    .footer-left p {
      color: #6c757d;
      font-size: 15px;
      line-height: 1.7;
      margin: 20px 0;
    }

    .footer-left .social-icons1 a {
      color: #0f2d4a !important;
      font-size: 16px;
      margin-right: 15px;
    }

    .social-icons1 {
      display: flex;
      align-items: center;
      justify-content: start;
    }

    .footer-left .copyright {
      color: #d4af37;
      font-weight: 600;
      margin-top: 20px;
    }

    .footer-left .copyright a {
      color: #0f2d4a;
      font-weight: 400;
    }

    .footer-right {
      background: #0f2d4a;
      color: #fff;
      padding: 50px 40px;
      flex-grow: 1;
    }

    .footer-right .section-title {
      font-size: 16px;
      font-weight: 700;
      color: #d4af37;
      text-transform: uppercase;
      margin-bottom: 20px;
      position: relative;
      display: inline-block;
    }

    .footer-right .section-title::after {
      content: "";
      position: absolute;
      bottom: -6px;
      left: 0;
      width: 50px;
      height: 2px;
      background-color: #d4af37;
    }

    .footer-right ul {
      list-style: none;
      padding: 0;
      margin: 0 0 15px 0;
    }

    .footer-right ul li {
      margin-bottom: 10px;
      font-size: 15px;
    }

    .footer-right ul li a {
      color: #fff;
      text-decoration: none;
    }

    .footer-right .icon-text {
      display: flex;
      align-items: flex-start;
      margin-bottom: 10px;
    }

    .footer-right .icon-text i {
      font-size: 18px;
      color: #d4af37;
      min-width: 24px;
    }

    .footer-right .icon-text span {
      margin-left: 10px;
      line-height: 1.6;
    }

    .footer-right .newsletter input {
      border: none;
      border-radius: 0;
      padding: 10px 15px;
      width: 100%;
    }

    .footer-right .newsletter button {
      border: none;
      background: #fff;
      color: #d4af37;
      padding: 10px 15px;
    }

    @media (max-width: 991px) {
      .footer {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <!-- header -->

<?php include 'header.php'; ?>

  <!-- ======Hero_Section==================== -->
  <div id="hero_section">
    <!-- ---Fixed Icon  -->
    <div class="add_cart d-none d-lg-inline-block">
      <a href="#" target="_blank">
        <i class="fas fa-cart-plus"></i>
        <span class="text-white">BUY NOW</span>
      </a>
    </div>
    <div class="quick_msg d-none d-lg-inline-block">
      <a href="#" target="_blank">
        <i class="far fa-envelope"></i>
        <span class="text-white">QUICK QUESTION</span>
      </a>
    </div>
    <!--  -->

    <div class="container">
      <div class="row">
        <div class="col-md-12 hero_text">
          <h1 class="text-white text-center">About Us</h1>
          <!-- <p class="h1">About us</p> -->
          <ul class="hero_list text-center">
            <li><a href="index.html" class="h6">Home</a></li>
            <li><a href="#" class="h6">></a></li>
            <li><a href="about.html" class="h6">About Us</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- ========About_us Section=========== -->
  <div id="about_section">
    <div class="container text-center about_container">
      <div class="row row1 mb-5">
        <div class="col-12">
          <div class="d-flex align-items-center justify-content-center">
            <h5>ABOUT US</h5>
            <hr class="about_hr inline-block" />
          </div>
          <h1 class="col-7 mx-auto mb-3">
            Welcome to Royal Golf Club An exquisite 18 opening course
          </h1>
          <p class="fs-5 col-9 m-auto">
            Many desktop publishing packages and web page editors now use
            Lorem Ipsum as their default model text, and a search for 'lorem
            ipsum' will uncover many web sites still in their infancy.
          </p>
        </div>
      </div>
      <!-- ======Second Row For about img and text -->
      <div class="row row2 justify-content-center align-items-center text-start">
        <div class="col-md-12 col-lg-4 col-xl-3 order-2 order-lg-1 px-3">
          <h2>A really top notch golf insight</h2>
          <p>
            It is a long established fact that a reader will be distracted by
            the readable content of a page when looking at its layout. The
            point of using.
          </p>
        </div>
        <div class="col-md-12 col-lg-7 offset-xl-1 order-1 order-lg-2 mb-4 mb-lg-0">
          <img src="../image/about-1.jpg" class="rounded" height="100%" width="100%" />
        </div>
      </div>

      <!-- ======Third Row For about img and text -->
      <div class="row row3 justify-content-center align-items-center text-start">
        <div class="col-md-12 col-lg-7 mb-4 mb-lg-0">
          <img src="../image/about-2.jpg" class="rounded" height="100%" width="100%" />
        </div>
        <div class="col-md-12 col-lg-4 col-xl-3 offset-xl-1 px-3">
          <h2>Extravagance meets diversion</h2>
          <p>
            There are many variations of passages of Lorem Ipsum available,
            but the majority have suffered alteration in some form, by
            injected humour.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- =======Out Team Section============= -->
  <div class="container-fluid py-5" id="team_section">
    <div class="row text-center">
      <div class="team-text-1 col-12 text-white p-1 d-flex justify-content-center align-items-center">
        <div class="">OUR TEAM</div>
        <div class="hrforteam"></div>
      </div>
    </div>
    <div class="row text-center">
      <div class="team-text-2 col-12 text-white p-3">
        <h1>Coaches and Instructors</h1>
      </div>
    </div>

    <div class="container team-photo-container">
      <div class="row height-auto">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
          <div class="team-photo my-3" id="team-1">
            <div class="team-photo-inner">
              <p>Coach</p>
              <h2>Edith Kyzer</h2>
              <div class="team-social">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>

              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
          <div class="team-photo my-3" id="team-2">
            <div class="team-photo-inner">
              <p>Coach</p>
              <h2>Buford Williams</h2>
              <div class="team-social">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>

              </div>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
          <div class="team-photo my-3" id="team-3">
            <div class="team-photo-inner">
              <p>Coach</p>
              <h2>Jorja Finnerty</h2>
              <div class="team-social">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- footer -->

  <footer class="footer">
    <div class="footer-left col-xl-4">
      <div class="footer-logo">
        <img src="../image/footer-light-logo.png" alt="Golf Logo" />
      </div>
      <p>
        Golf club has become a famous vacationer location drawing in golf
        players from all sides of the world.
      </p>
      <div class="social-icons1">
        <i class="fa-brands fa-facebook-f" style="color: #25395b"></i>
        <i class="fa-brands fa-twitter ps-2" style="color: #25395b"></i>
        <i class="fa-brands fa-youtube ps-2" style="color: #25395b"></i>
        <i class="fa-brands fa-linkedin-in ps-2" style="color: #25395b"></i>
      </div>
      <p class="copyright">
        &copy; <span class="current-year"></span> Golf is Powered by
        <a href="#" style="color: #0f2d4a">Rahul & group</a>
      </p>
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
          <p class="mt-3">
            Subscribe to our newsletter for discounts and more.
          </p>
          <form class="newsletter d-flex">
            <input type="email" placeholder="Subscribe with us" />
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
          </form>
        </div>
      </div>
    </div>
  </footer>

  <!-- ===============Bootstrap Script Link======================= -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
</body>

</html>