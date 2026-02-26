<?php
session_start();
$aleart=0;
$conn=mysqli_connect("localhost","root","","golfweb");
if(isset($_POST['submit']))
{
    $Name=$_POST['cname'];
    $Email=$_POST['cemail'];
    $Subject=$_POST['csubject'];
    $Contact=$_POST['ccontact'];
    $Message=$_POST['cmessage'];


    $Insert_query="INSERT INTO `contact`(`id`, `name`, `email`, `subject`, `contact`, `message`) VALUES (null,'$Name','$Email','$Subject','$Contact','$Message')";
    if(mysqli_query($conn,$Insert_query))
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
    <title>Contact Page</title>
    <!-- ===============Bootstrap Link====================== -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">


    <!-- ===============Font-Awesome Icon Link====================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
     
    <link rel="stylesheet" href="../css/style.css">
     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- ===============Styling//==================== -->
    <style>
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
            font-weight: bolder;
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


        /* ---------Styling For Contact Info Section--------------- */
        .contact_container {
            padding: 70px 0;
        }

        .contact_container .row1 h5 {
            color: #ceaa4d;
            letter-spacing: 1px;
        }

        .contact_container .row1 h1 {
            color: #15395a;
            /* font-family: 'Times New Roman', Times, serif; */
            font-family: sans-serif;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .contact_container .row1 .about_hr {
            background-color:#ceaa4d;
            width: 6%;
            vertical-align: middle;
            height: 2px;
            border: none;
            margin-left: 1rem;
        }

        /*  */
        .contact-items {
            border: none;
            transition: 0.5s;
            border-radius: 10px;
            box-shadow: 1px 1px 4px rgb(196, 186, 186), -1px -1px 4px rgb(196, 186, 186);
        }

        .contact-items:hover {
            transition: 0.5s;
            transform: translateY(-10px);
            cursor: pointer;
        }

        .contact-items i {
            color: #d49d10;
        }

        .contact-items h4 {
            letter-spacing: 1px;
            font-weight: 700;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .contact-items p {
            color: gray;
        }

        /* Get In Touch Section ......... */
        #Get_in_section {
            background-color: whitesmoke;
            padding: 100px 0;
        }

        .get-in-form {
            background-color: white;
            min-width: 70%;
            border: none;
            box-shadow: 1px 1px 30px gray;
            margin: auto;
            padding: 30px;
        }

        .get-in-form label {
            color: #6a747b;
        }

        @media(min-width:992px) {
            .get-in-form {
                width: 60%;
                margin: auto;
            }
        }

        .form-txt-div {

            font-family: Georgia, 'Times New Roman', Times, serif;

        }

        .form-txt-div h4 {

            letter-spacing: 1px;
        }

        .get-in-txt {
            color: #d49d10;
        }

        .get-in-txt-hr {
            width: 60px;
            height: 1px;
            background-color: #ceaa4d;
            display: inline-block;
            vertical-align: middle;
            margin-left: 15px;
            /* ============ */
        }

        .formbtn {
            background-color: #d49d10;
            padding: 12px 20px;
            border: none;
            transition: 0.4s;
            font-weight: bolder;
            text-transform: uppercase;
        }

        .formbtn:hover {
            transition: 0.4s;
            background-color: #0a3a72;
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
    <!-- ===Aleart using PHP -->
     <?php
     
     if($aleart==1)
     {
        echo '<div class="alert alert-success alert-dismissible fade show container" role="alert">
  <strong>Success!</strong> Your details submitted successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
     }
     ?>
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
                    <h1 class="text-white text-center fs-1">Contact US</h1>
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

    
    <!-- ======Contact_Section/Container==================== -->
    <div class="contact_container">
        <div class="container py-3" id="contact_info">
            <div class="row row1 mb-5">
                <div class="col-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <h5 class="fs-5">CONTACT INFO</h5>
                        <div class="about_hr inline-block"></div>
                    </div>
                    <h1 class="col-7 text-center mx-auto mb-3">
                        We`re here to help you
                    </h1>

                </div>
            </div>
            <div class="row row2">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4 py-2">
                    <div class="contact-items py-5 shadow-lg">
                        <div class="contact-items-inner">
                            <div class="text-center">
                                <i class="fa-solid fa-location-dot fs-1 p-1"></i>
                                <h4 class="p-1">Location</h4>
                                <p class="w-50 m-auto">66 Guild Street 512B,
                                    Great North Town.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 col-xxl-4 py-2">
                    <div class="contact-items py-5 shadow-lg">
                        <div class="contact-items-inner">
                            <div class="text-center">
                                <i class="fa-solid fa-phone-volume fs-1 p-1"></i>
                                <h4 class="p-1">Call Us</h4>
                                <p class="w-50 m-auto">(+44) 123 456 789
                                    <br>
                                    + (124) 1523-567-9874
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4 py-2">
                    <div class="contact-items py-5 shadow-lg">
                        <div class="contact-items-inner">
                            <div class="text-center">
                                <i class="fa-solid fa-envelope fs-1 p-1"></i>
                                <h4 class="p-1">Email</h4>
                                <p class="w-50 m-auto">info@yourdomain.com
                                    <br>
                                    example@yourdomain.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======Get In Touch ***Form***..-------==================== -->
    <div id="Get_in_section">
        <div class=" container form-container">
            <form  method="post" class="get-in-form rounded-3 shadow-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="form-txt-div">
                            <div class="get-in-txt d-flex  align-items-center">
                                <h4 class="fs-4">GET IN TOUCH</h4>
                                <div class="get-in-txt-hr"></div>
                            </div>
                            <div class="fill-form-txt">
                                <p class="fs-1 fw-bold">Call Us or Fill The Form</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- First Line field -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <label for="nameid" class="my-2">Your Name</label>
                        <input type="text" id="nameid" name="cname" class="form-control">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <label for="emailid" class="my-2">Your Email</label>
                        <input type="email" id="emailid" name="cemail" class="form-control">
                    </div>
                    <!-- Second Line field -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <label for="subjectid" class="my-2">Your Subject</label>
                        <input type="text" id="subjectid" name="csubject" class="form-control">
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                        <label for="contactid" class="my-2">Contact Number</label>
                        <input type="number" id="contactid" min="0" name="ccontact" class="form-control">
                    </div>
                    <!-- Third Line field -->   
                    <div class="col-12">
                        <label for="messageid" class="my-2">Message</label>
                        <input type="text" id="messageid" name="cmessage" class="form-control">
                    </div>
                    <!-- Fourth Line field -->
                    <div class="col-12">
                        <input type="submit" value="Send Message" name="submit" class="btn btn-primary my-4 formbtn">
                    </div>
                </div>
            </form>
        </div>
    </div>

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

</html>