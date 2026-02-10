<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
    alert('Please do login!');
    window.location.href = 'login.php';
          </script>";
  // header('Location: login.php');

    exit;
}
?>




<!-- ..--.---------- -->
<?php
$aleart=0;
$conn=mysqli_connect("localhost","root","","golfweb");
if(isset($_POST['submit']))
{
   
    
    $Name=$_POST['mname'];
    $Email=$_POST['memail'];
    $Subject=$_POST['msubject'];
    $Contact=$_POST['mcontact'];
    $Message=$_POST['mmessage'];
    

    $Insert_query="INSERT INTO `membership`(`id`, `name`, `email`, `subject`, `contact`, `message`) VALUES (null,'$Name','$Email','$Subject','$Contact','$Message')";
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
    <title>MemberShip Page</title>
        <!-- ===============Bootstrap Link====================== -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous" />


        <!-- ===============Font-Awesome Icon Link====================== -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

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
            color: black;
            padding: 0 7px;
        }

        .nav-item,
        ul,
        a:hover {
            font-weight: 700;
            color: #282b2d;
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
            color: #333;
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
            font-weight: bolder;
            /* line-height: 1.1; */
            min-width: 20%;
            max-width: 42%;
            margin: auto;
            border-radius: 4px;
        }

        @media(min-width:770px) {
            .hero_list {
                width: 20%;
            }
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

        /* ======About Section Styling.============ */

        .experience-box {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background-color: #caa850;
            color: #fff;
            padding: 20px;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            border-radius: 5px;
            z-index: 1;
        }

        .experience-box span {
            font-size: 2rem;
            display: block;
        }

        .about-image {
            position: relative;
        }

        .about-icon {
            width: 150px;
            height: 150px;
        }

        .about-text h2 {
            font-weight: bold;
        }


        .about-text p.lead-border {
            border-left: 3px solid #caa850;
            padding-left: 15px;
        }

        .feature-icon {
            font-size: 1.5rem;
            color: #caa850;
        }

        .read-more-btn {
            background-color: #caa850;
            color: #fff;
            font-weight: bold;
        }

        .call-icon {
            background-color: #f7f7f7;
            padding: 12px;
            border-radius: 50%;
            font-size: 1.2rem;
            color: #caa850;
        }

        .about:hover {
            background-color: #0f3a5c;
            transition: 1s;
        }

        .about {
            width: 60%;
            padding: 10px;
            background-color: #caa850;
            color: white;
            border-radius: 2%;
            border: none;
            font-weight: 700;
        }

        .line {
            height: 2px;
            margin-left: 20px;
        }

        /* ================ Join Us Section Styling..=================== */
        #join_us_section {
            background-color: #caa850;
        }

        .join_us_container {
            padding-bottom: 10rem !important;
            background-color: #0a3a72;
        }

        #join_us_section .join-txt {
            color: #caa850;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
        }

        .join-txt .hrofjoin {
            height: 1px;
            width: 50px;
            background-color: #caa850;
            /* vertical-align: middle; */
        }

        .join-extra-txt>h1 {
            font-family: 'Times New Roman', Times, serif;
        }

        .btnjoin_us {
            background-color: #d4af37;
            border: none;
            transition: 0.7s;
        }

        .btnjoin_us:hover {
            transition: 0.7s;
            background-color: white;
            color: #d4af37 !important;
        }

        /* ---Second Row for form and img */
        .join_us_container2 {
            position: relative;
            margin-top: -100px;
        }

        .member-form-img {
            background-image: url(../image/membership-1.jpg);
            /* height: 90vh; */
            height: auto;
            /* width: 50%; */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;


        }

        .member-form-col {
            background-color: whitesmoke;
            padding: 0;
        }
        .get-in-form
        {
            height: 100%;
            width: 100%;

        }
        .get-in-form input
        {
            border-radius: 0px;
            
        }

        .get-in-form label {
            color: #6a747b;
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

        /* ========Our Team Section  STyling============== */
        #team_section {

            background-color: #F8F9FA;
            /* background-color: white; */
            /* background-image: url(Img/pattern-bg.jpg); */

            filter: brightness(1);

            height: auto;
        }

        .team-text-1 {
            font-weight: bolder;
            letter-spacing: 1px;
            color: #d49d10;
            /* font-family: serif; */
        }

        .hrforteam {
            height: 1.2px;
            width: 60px;
            background-color: #d49d10;
        }

        .team-text-2 {
            letter-spacing: 1px;
            font-family: serif;
            color: #0a3a72;

        }

        .team-text-2 h1 {
            font-weight: bolder;
        }

        /* --- */
        /* .team-photo-container {
      background-color: red;
    */

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


        /* ===Footer Styling........======== */
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
    <!-- -====Header========== -->
<?php include 'header.php'; ?>

    <!-- ===Aleart using PHP -->
     <?php
     
     if($aleart==1)
     {
        echo '<div class="alert alert-success alert-dismissible fade show container" role="alert">
  <strong>Success!</strong> Your membership added successfully.
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
                    <h1 class="text-white text-center">MemberShip</h1>
                    <!-- <p class="h1">About us</p> -->
                    <ul class="hero_list  text-center">
                        <li><a href="index.php" class="h6">Home</a></li>
                        <li><a href="#" class="h6">></a></li>
                        <li><a href="membership.php" class="fs-6">MemberShip</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!---------- about section----------------------  -->

    <section class="container py-5" id="about_section">
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
                    It is a long established fact that a reader will be distracted by the readable content of a page
                    when
                    looking
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
                        <button class="about ms-5">READ MORE</button>
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

    <!-- ============== Join Us Section ================== -->
    <div id="join_us_section" class="">
        <div class="join_us_container py-5 container">
            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                    <div class="join-txt mt-5 p-2">
                        <div class="fs-5">JOIN WITH US</div>
                        <div class="hrofjoin mx-3"></div>
                    </div>
                    <div class="join-extra-txt p-2">
                        <h1 class="fw-bold text-white">Local area is the opportunity to participate in a club</h1>
                    </div>
                </div>
                <div
                    class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 d-flex justify-content-start justify-content-lg-end justify-content-xl-end justify-content-xxl-end">
                    <a href="#" class="btnjoin_us mt-5 btn btn-warning text-white fw-bold px-5 py-3">JOIN OUR CLUB</a>
                </div>
            </div>

        </div>
    </div>
    <div class="join_us_container2 container pb-5">
        <div class="row member-row2 px-1">
            <div class="member-form-img col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 rounded-1  d-xxs-none d-xs-none d-sm-none d-md-none d-lg-block d-xl-block d-xxl-block">

            </div>
            <div class="member-form-col col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 rounded-1 ">
                <form method="post" class="get-in-form rounded-3 p-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-txt-div">
                                <div class="get-in-txt d-flex  align-items-center">
                                    <h4 class="fs-4">Membership</h4>
                                    <div class="get-in-txt-hr"></div>
                                </div>
                                <div class="fill-form-txt">
                                    <p class="fs-1 fw-bold">Join Our Golf Club</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- First Line field -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label for="nameid" class="my-2">Your Name</label>
                            <input type="text" id="nameid" name="mname" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label for="emailid" class="my-2">Your Email</label>
                            <input type="email" id="emailid" name="memail" class="form-control">
                        </div>
                        <!-- Second Line field -->
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label for="subjectid" class="my-2">Your Subject</label>
                            <input type="text" id="subjectid" name="msubject" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                            <label for="contactid" class="my-2">Contact Number</label>
                            <input type="number" id="contactid" min="0" name="mcontact" class="form-control">
                        </div>
                        <!-- Third Line field -->
                        <div class="col-12">
                            <label for="messageid" class="my-2">Message</label>
                            <input type="text" id="messageid" name="mmessage" class="form-control">
                        </div>
                        <!-- Fourth Line field -->
                        <div class="col-12">
                            <input type="submit" value="Send Message" name="submit" class="btn btn-primary my-4 formbtn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- =======Out Team Section============= -->
    <div class="container-fluid py-5" id="team_section">
        <div class="row text-center">
            <div class="team-text-1 col-12 p-1 d-flex justify-content-center align-items-center">
                <div class="">OUR TEAM</div>
                <div class="hrforteam mx-2"></div>
            </div>
        </div>
        <div class="row text-center">
            <div class="team-text-2 col-12  p-3">
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
    <!-- =====Footer============= -->
    
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