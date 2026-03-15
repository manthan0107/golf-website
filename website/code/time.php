<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
    alert('Please do login!');
    window.location.href = 'login.php';
          </script>";
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "golfweb");

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Fetch user email for insertion
$user_id = $_SESSION['user_id'];
$stmt_user = mysqli_prepare($conn, "SELECT email FROM register WHERE id = ?");
mysqli_stmt_bind_param($stmt_user, "i", $user_id);
mysqli_stmt_execute($stmt_user);
$user_res = mysqli_stmt_get_result($stmt_user)->fetch_assoc();
$Email = $user_res['email'];
mysqli_stmt_close($stmt_user);

$aleart = 0;
$errorMsg = "";

if (isset($_POST['submit'])) {
    $Name = sanitize($_POST['tname']);
    $Players = sanitize($_POST['tplayers'] ?? '');
    $Date = sanitize($_POST['tdate']);
    $Time = sanitize($_POST['ttime']);
    $Contact = sanitize($_POST['tcontact']);
    $Message = sanitize($_POST['tmessage']);

    // PHP Validation
    if(empty($Name) || empty($Players) || empty($Date) || empty($Time) || empty($Contact) || empty($Message)) {
         $errorMsg = "All fields are required.";
    } elseif(!preg_match("/^[A-Za-z\s]{3,}$/", $Name)) {
        $errorMsg = "Name must be at least 3 characters and contain only letters and spaces.";
    } elseif(!preg_match("/^\d{10}$/", $Contact)) {
        $errorMsg = "Contact number must be exactly 10 digits.";
    } else {
        $stmt = $conn->prepare("INSERT INTO `tee_time` (`name`, `players`, `date`, `time`, `email`, `contact`, `message`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $Name, $Players, $Date, $Time, $Email, $Contact, $Message);
        
        if ($stmt->execute()) {
            $aleart = 1;
        } else {
             $errorMsg = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tee-Times Page</title>
    <link rel="shortcut icon" href="../About_Page/Img/LogoForTitle.png" />
    <!-- ===============Bootstrap Link====================== -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">


    <!-- ===============Font-Awesome Icon Link====================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <style>
        * {
            margin: 0;
            
            padding: 0;
        }

        /* --------------Styling For Hero Section--------------- */


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
        .text-shadow-black {
            text-shadow: 1px 1px 5px black;
            font-family: 'Times New Roman', Times, serif;
        }

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

        /* ====Styling For Refreshment Section */
        .refresh-txt-div {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .refresh-txt-div>h5 {
            color: #caa850;
            letter-spacing: 1px;
        }

        .hrforrefresh {
            height: 1px;
            width: 50px;
            background-color: #caa850;
        }

        .refresh-extra-txt>h1 {
            color: #0a3a72;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
        }

        /* -Second Row of Refresh container */
        .refresh-card {
            transition: 0.9s;
        }

        .refresh-card>i {
            color: #caa850;
        }

        .refresh-card>h4 {
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .refresh-card:hover {
            transition: 0.9s;
            transform: translateY(-15px);
        }

        /* =======Tee Form Section=========== */
        .tee-form-part-1 {
            background-color: #15395A;
        }

        .reserve_online_txt {
            color: #caa850;
            letter-spacing: 1px;
        }

        .tee-form-part-1_txt>h1 {
            font-family: 'Times New Roman', Times, serif;
        }

        .tee-form-part-1_txt>p {
            line-height: 30px;
        }

        /* ---Form Styling-- */
        .tee-form>.book_tee_txt {
            color: #caa850;
            font-family: 'Times New Roman', Times, serif;
        }

        .tee-form label {
            color: rgb(52, 45, 45);
        }

        .tee-form input {
            border-radius: 0;
        }

        .tee-form select {
            border-radius: 0;
        }

        .teeformbtn {
            color: white;
            font-weight: bold;
            background-color: #caa850;
            border: none;
            height: 3rem;
            transition: 0.5s;
            border-radius: 7px !important;
        }

        .teeformbtn:hover {
            transition: 0.5s;
            background-color: #0a3a72;
        }

        /* ========Available Tee-Times Section Styling============== */
        #available_tee_section {

            background-color: whitesmoke;
        }

        .available_txt_div .tee-times-txt>h5 {
            color: #caa850;
        }

        .available_txt_div>h1 {
            color: #0a3a72;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
            text-align: center;
        }

        /* second row for available times boxes-- */
        .available_tee-time_boxes {
            background-color: rgb(255, 255, 255);
            transition: 0.8s;
        }
        .available_tee-time_boxes:hover
        {
            transition: 0.8s;
            transform: translateY(-15px);
        }

        .available_tee-time_boxes>h3 {
            font-family: 'Times New Roman', Times, serif;
            font-weight: bold;
        }

        .available_tee-time_boxes>.btn_book_tee {
            background-color: #caa850;
            border: none;
            color: white;
            font-weight: bold;
            transition: 0.4s;

        }
        .available_tee-time_boxes>.btn_book_tee:hover
        {
            transition: 0.4s;
            background-color: #0a3a72;
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
  <strong>Success!</strong> Your Tee Time has been booked successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
     }
     ?>
     <?php if($errorMsg != ""): ?>
        <div class="alert alert-danger alert-dismissible fade show container" role="alert">
          <strong>Error!</strong> <?php echo $errorMsg; ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
     <?php endif; ?>

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
                    <h1 class="text-white text-center text-shadow-black fw-bold" style="font-size: 4rem;">Tee Times</h1>
                    <!-- <p class="h1">About us</p> -->
                    <ul class="hero_list  text-center">
                        <li><a href="index.html" class="h6">Home</a></li>
                        <li><a href="#" class="h6 fw-bold">&gt;</a></li>
                        <li><a href="tee-times.html" class="fs-6">TEE TIMES</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- =====Refreshment Section============= -->
    <div id="refreshment_section" class="py-5">
        <div class="refreshment_container container">
            <!-- ---First Row of Refreshment_container -->
            <div class="row  py-5">
                <div class="col-12 text-center">
                    <div class="refresh-txt-div">
                        <h5>EVERYTHING YOU NEED</h5>
                        <div class="hrforrefresh mx-3"></div>
                    </div>
                    <div class="refresh-extra-txt">
                        <h1>Other Refreshment Are Available</h1>
                    </div>
                </div>
            </div>
            <!-- ---Second Row of Refreshment_container -->
            <div class="row text-center pb-5">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 pb-4">
                    <div class="refresh-card shadow p-4 rounded">
                        <i class="fa-solid fa-trophy fs-2 p-3"></i>
                        <h4 class="p-2">Award Winning</h4>
                        <p class="text-muted">The Subsequent shots are comparable to what you experience on the green.
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 col-xxl-4 pb-4">
                    <div class="refresh-card shadow p-4 rounded">
                        <i class="fa-solid fa-truck-pickup fs-2 p-3"></i>
                        <h4 class="p-2">Powered Golf Carts</h4>
                        <p class="text-muted">The Subsequent shots are comparable to what you experience on the green.
                        </p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4 pb-4">
                    <div class="refresh-card shadow p-4 rounded">
                        <i class="fa-solid fa-golf-ball-tee fs-2 p-3"></i>
                        <h4 class="p-2">Premium Golf Balls</h4>
                        <p class="text-muted">The Subsequent shots are comparable to what you experience on the green.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- =====Tee-Time Form Section ============== -->
    <div id="tee-form_section">
        <div class="tee-form_container container pb-5">
            <div class="row">
                <div
                    class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-5 col-xxl-5 tee-form-part-1 text-start d-flex align-items-center justify-content-center height-auto p-5 rounded-start">
                    <div class="tee-form-part-1_txt">
                        <div class="reserve_online_txt d-flex align-items-center p-2">
                            <h5>RESERVE ONLINE</h5>
                            <div class="hrforrefresh mx-3"></div>
                        </div>
                        <h1 class="text-white fw-bold pb-5">
                            Spaces fill quick, book early!
                        </h1>
                        <p class="text-white">There are many variations of passages of Lorem Ipsum available, but the
                            majority have suffered alteration in some form,
                            by injected humour, or randomised words which don't look even slightly believable.</p>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-7 col-xxl-7 p-5 shadow rounded-end">
                    <div class="tee-form-div">
                        <!-- =======PHP Table Name :  -->
                        <form id="timeForm" method="post" class="tee-form" onsubmit="return validateTimeForm()">
                            <div class="book_tee_txt d-flex align-items-center text-start">
                                <h3 class="fw-semibold">BOOK A TEE TIME</h3>
                                <div class="hrforrefresh mx-3"></div>
                            </div>
                            <div class="row">
                                <!-- First Line field -->
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 position-relative mb-3">
                                    <label for="nameid" class="my-2">Your Name</label>
                                    <input type="text" id="nameid" name="tname" class="form-control" placeholder="First Name" required onblur="Validator.validateName(this)">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 position-relative mb-3">
                                    <label for="playerid" class="my-2">Players</label>
                                    <select id="playerid" class="form-select" name="tplayers" required onblur="Validator.validateRequired(this, 'Players')">
                                        <option value="" disabled selected>--Choose Your Player--</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                                <!-- Second again Line field -->
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 position-relative mb-3">
                                    <label for="dateid" class="my-2">Date</label>
                                    <input type="date" id="dateid" name="tdate" class="form-control" required onblur="Validator.validateRequired(this, 'Date')">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 position-relative mb-3">
                                    <label for="timeid" class="my-2">Time</label>
                                    <input type="time" id="timeid" name="ttime" class="form-control" required onblur="Validator.validateRequired(this, 'Time')">
                                </div>
                                <!-- Second Line field -->
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 position-relative mb-3">
                                    <label for="emailid" class="my-2">Your Email</label>
                                    <input type="email"
id="emailid"
name="email"
class="form-control"
placeholder="name@example.com"
value="<?php echo htmlspecialchars(isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''); ?>"
required readonly onblur="Validator.validateEmail(this)">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 position-relative mb-3">
                                    <label for="contactid" class="my-2">Contact Number</label>
                                    <input type="number" id="contactid" min="0" name="tcontact" class="form-control"
                                        placeholder="Your Phone Number" required onblur="Validator.validatePhone(this)">
                                </div>
                                <!-- Third Line field -->
                                <div class="col-12 position-relative mb-3">
                                    <label for="messageid" class="my-2">Message</label>
                                    <input type="text" id="messageid" name="tmessage" placeholder="Specify Any Other Requirement"
                                        class="form-control" required onblur="Validator.validateRequired(this, 'Message')">
                                </div>
                                <!-- Fourth Line field -->
                                <div class="col-12">
                                    <input type="submit" value="Book Now" name="submit" class="w-100 btn btn-primary my-4 teeformbtn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== Available Tee-Times Section============= -->
    <div id="available_tee_section" class="py-5">
        <div class="available_tee_container container py-5">
            <!-- first row for tee-time Text -->
            <div class="row">
                <div class="col-12">
                    <div class="available_txt_div">
                        <div class="tee-times-txt d-flex justify-content-center align-items-center">
                            <h5>TEE TIMES</h5>
                            <div class="hrforrefresh mx-3"></div>
                        </div>
                        <h1>Available Tee Times</h1>
                    </div>
                </div>
            </div>
            <!-- second row for tee-timing  -->
            <div class="row text-center pt-5">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="available_tee-time_boxes p-4 rounded shadow mb-4">
                        <h3 class="p-1">08:00 am</h3>
                        <p class="p-1 text-muted">9 holes <br> 18 holes</p>
                        <a href="#tee-form_section" class="btn_book_tee btn">BOOK A TEE TIME</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="available_tee-time_boxes p-4 rounded shadow mb-4">
                        <h3 class="p-1">09:00 am</h3>
                        <p class="p-1 text-muted">9 holes <br> 18 holes</p>
                        <a href="#tee-form_section" class="btn_book_tee btn">BOOK A TEE TIME</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="available_tee-time_boxes p-4 rounded shadow mb-4">
                        <h3 class="p-1">10:00 am</h3>
                        <p class="p-1 text-muted">9 holes <br> 18 holes</p>
                        <a href="#tee-form_section" class="btn_book_tee btn">BOOK A TEE TIME</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="available_tee-time_boxes p-4 rounded shadow mb-4">
                        <h3 class="p-1">11:00 am</h3>
                        <p class="p-1 text-muted">9 holes <br> 18 holes</p>
                        <a href="#tee-form_section" class="btn_book_tee btn">BOOK A TEE TIME</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="available_tee-time_boxes p-4 rounded shadow mb-4">
                        <h3 class="p-1">12:00 pm</h3>
                        <p class="p-1 text-muted">9 holes <br> 18 holes</p>
                        <a href="#tee-form_section" class="btn_book_tee btn">BOOK A TEE TIME</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="available_tee-time_boxes p-4 rounded shadow mb-4">
                        <h3 class="p-1">01:00 pm</h3>
                        <p class="p-1 text-muted">9 holes <br> 18 holes</p>
                        <a href="#tee-form_section" class="btn_book_tee btn">BOOK A TEE TIME</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="available_tee-time_boxes p-4 rounded shadow mb-4">
                        <h3 class="p-1">02:00 pm</h3>
                        <p class="p-1 text-muted">9 holes <br> 18 holes</p>
                        <a href="#tee-form_section" class="btn_book_tee btn">BOOK A TEE TIME</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                    <div class="available_tee-time_boxes p-4 rounded shadow mb-4">
                        <h3 class="p-1">03:00 pm</h3>
                        <p class="p-1 text-muted">9 holes <br> 18 holes</p>
                        <a href="#tee-form_section" class="btn_book_tee btn">BOOK A TEE TIME</a>
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

    <script src="../js/validation.js"></script>
    <script>
        function validateTimeForm() {
            let isValid = true;
            isValid = Validator.validateName(document.getElementById('nameid')) && isValid;
            isValid = Validator.validateRequired(document.getElementById('playerid'), 'Players') && isValid;
            isValid = Validator.validateRequired(document.getElementById('dateid'), 'Date') && isValid;
            isValid = Validator.validateRequired(document.getElementById('timeid'), 'Time') && isValid;
            isValid = Validator.validateEmail(document.getElementById('emailid')) && isValid;
            isValid = Validator.validatePhone(document.getElementById('contactid')) && isValid;
            isValid = Validator.validateRequired(document.getElementById('messageid'), 'Message') && isValid;
            return isValid;
        }
    </script>
</body>

</html>