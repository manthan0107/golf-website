<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>
    alert('Please do login!');
    window.location.href = 'login.php';
          </script>";
    exit;
}

$con=mysqli_connect("localhost","root","","golfweb");

// Fetch user email for insertion
$user_id = $_SESSION['user_id'];
$stmt_user = mysqli_prepare($con, "SELECT email FROM register WHERE id = ?");
mysqli_stmt_bind_param($stmt_user, "i", $user_id);
mysqli_stmt_execute($stmt_user);
$user_res = mysqli_stmt_get_result($stmt_user)->fetch_assoc();
$email = $user_res['email'];
mysqli_stmt_close($stmt_user);

$aleart=0;
$errorMsg="";

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if(isset($_POST['submit']))
{
    $tname = sanitize($_POST['tname']);
    $oname = sanitize($_POST['oname']);
    $date = sanitize($_POST['date']);
    $location = sanitize($_POST['location']);
    $otherd = sanitize($_POST['otherd']);

    if(empty($tname) || empty($oname) || empty($date) || empty($location)) {
        $errorMsg = "All fields except details are required.";
    } elseif(!preg_match("/^[A-Za-z\s]{3,}$/", $oname)) {
        $errorMsg = "Organizer Name must be at least 3 characters and contain only letters and spaces.";
    } else {
        $stmt = $con->prepare("INSERT INTO `tounament`(`tname`, `oname`, `date`, `location`, `email`, `otherd`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $tname, $oname, $date, $location, $email, $otherd);

        if($stmt->execute()) {
            $aleart=1;
        } else {
            $errorMsg = "Database error: " . $stmt->error;
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>


<?php include 'header.php'; ?>

    <!-- ===Aleart using PHP -->
     <?php
     
     if($aleart==1)
     {
        echo '<div class="alert alert-success alert-dismissible fade show container" role="alert">
  <strong>Success!</strong> Your Tournament added successfully.
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
    <form id="tournamentForm" class="p-4 shadow rounded bg-light" method="post" onsubmit="return validateTournamentForm()">
      <div class="mb-3 position-relative">
        <label class="form-label">Tournament Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="tname" id="tnameid" placeholder="Enter Tournament Name" required onblur="Validator.validateRequired(this, 'Tournament Name')">
      </div>
      <div class="mb-3 position-relative">
        <label class="form-label">Organizer Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="oname" id="onameid" placeholder="Organizer Full Name" required onblur="Validator.validateName(this)">
      </div>
      <div class="mb-3 position-relative">
        <label class="form-label">Date <span class="text-danger">*</span></label>
        <input type="date" name="date" id="dateid" class="form-control" required onblur="Validator.validateRequired(this, 'Date')">
      </div>
      <div class="mb-3 position-relative">
        <label class="form-label">Location <span class="text-danger">*</span></label>
        <input type="text" name="location" id="locationid" class="form-control" placeholder="Tournament Location" required onblur="Validator.validateRequired(this, 'Location')">
      </div>
      <div class="mb-3 position-relative">
        <label class="form-label">Contact Email</label>
       <input type="email"
name="email"
id="emailid"
class="form-control"
placeholder="Enter Email"
value="<?php echo htmlspecialchars(isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''); ?>"
required readonly onblur="Validator.validateEmail(this)">
      </div>
      <div class="mb-3 position-relative">
        <label class="form-label">Additional Details</label>
        <textarea class="form-control" name="otherd" rows="4" placeholder="Provide details (optional)"></textarea>
      </div>
      <input type="submit" class="btn w-100" name="submit" style="background-color: #25395b; color: #fff;"/>
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

    <script src="../js/validation.js"></script>
    <script>
        function validateTournamentForm() {
            let isValid = true;
            isValid = Validator.validateRequired(document.getElementById('tnameid'), 'Tournament Name') && isValid;
            isValid = Validator.validateName(document.getElementById('onameid')) && isValid;
            isValid = Validator.validateRequired(document.getElementById('dateid'), 'Date') && isValid;
            isValid = Validator.validateRequired(document.getElementById('locationid'), 'Location') && isValid;
            isValid = Validator.validateEmail(document.getElementById('emailid')) && isValid;
            return isValid;
        }
    </script>
</body>

</html>