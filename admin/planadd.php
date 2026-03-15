<?php
    include "lib/db.php";
    
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

    $errorMsg = "";
    $successMsg = "";

    if(isset($_POST['submit']))
    {
        $title = sanitize($_POST['title']);
        $price = sanitize($_POST['price']);
        $duration = sanitize($_POST['duration']);
        $features = sanitize($_POST['features']);
        
        if(empty($title) || empty($price) || empty($duration) || empty($features)) {
             $errorMsg = "All fields except image are required.";
        } elseif(!preg_match("/^[A-Za-z\s]{3,}$/", $title)) {
             $errorMsg = "Title must be at least 3 characters and contain only letters and spaces.";
        } else {
             // Image validation
            $uploadOk = 1;
            $image = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $path = 'img/'.$image;
            $imageFileType = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'jpeg', 'png'];

            if (!in_array($imageFileType, $allowed_types)) {
                $errorMsg = "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOk = 0;
            } elseif ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
                $errorMsg = "Image size exceeds 2MB limit.";
                $uploadOk = 0;
            }
            
            if($uploadOk == 1) {
                if(move_uploaded_file($tmp_name, $path)) {
                    $stmt = $con->prepare("INSERT INTO `plan`(`title`, `price`, `duration`, `image`, `features`) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $title, $price, $duration, $image, $features);
                    
                    if($stmt->execute()) {
                         $successMsg = "Plan added successfully!";
                    } else {
                         $errorMsg = "Database Error: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    $errorMsg = "Failed to upload image.";
                }
            }
        }
    }
?>
<head>
    <meta charset="utf-8">
    <title>G-Club - Bootstrap 5 Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
        <?php include "sidebar.php"; ?>
        <div class="content">
            <?php include "header.php"; ?>
            <div class="container-fluid pt-4 px-4">
                <?php if($errorMsg != ""): ?>
                    <div class="alert alert-danger px-3 py-2"><?php echo $errorMsg; ?></div>
                <?php endif; ?>
                <?php if($successMsg != ""): ?>
                    <div class="alert alert-success px-3 py-2"><?php echo $successMsg; ?></div>
                <?php endif; ?>
                <div class="bg-secondary text-center rounded p-4">
                    <div class="container py-5">
                        <div class="card shadow p-4 border-0 bg-white">
                            <h3 class="mb-4 text-primary">➕ Add New Plan</h3>
                            <form id="planAddForm" method="post" enctype="multipart/form-data" onsubmit="return validatePlanAdd()">
                                <div class="row g-3">
                                    <!-- Title & Price -->
                                    <div class="col-md-6 text-start position-relative mb-2">
                                        <label class="form-label text-dark">Plan Title</label>
                                        <input type="text" name="title" id="titleid" class="form-control bg-white text-dark border" placeholder="e.g. Silver Plan" required onblur="Validator.validateName(this)">
                                    </div>
                                    <div class="col-md-6 text-start position-relative mb-2">
                                        <label class="form-label text-dark">Price (₹)</label>
                                        <input type="number" name="price" id="priceid" class="form-control bg-white text-dark border" placeholder="e.g. 299" required onblur="Validator.validateRequired(this, 'Price')">
                                    </div>

                                    <!-- Duration -->
                                    <div class="col-md-6 text-start position-relative mb-2">
                                        <label class="form-label text-dark">Duration</label>
                                        <input type="text" name="duration" id="durationid" class="form-control bg-white text-dark border" placeholder="e.g. per month" required onblur="Validator.validateRequired(this, 'Duration')">
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-6 text-start position-relative mb-2">
                                        <label class="form-label text-dark">Plan Icon</label>
                                        <input type="file" name="image" id="imageid" class="form-control bg-white text-dark border" accept="image/*" required onchange="Validator.validateImageUpload(this)">
                                    </div>

                                    <!-- Features -->
                                    <div class="col-12 text-start position-relative mb-2">
                                        <label class="form-label text-dark">Features (one per line)</label>
                                        <textarea name="features" id="featuresid" rows="5" class="form-control bg-white text-dark border" placeholder="e.g. 10 Premium Range Balls" required onblur="Validator.validateRequired(this, 'Features')"></textarea>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="col-12 d-flex gap-2 mt-3 justify-content-center">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Save Plan">
                                        <a href="planshow.php" class="btn btn-secondary">View All Plans</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>
    <script src="../website/js/validation.js"></script>
    <script>
        function validatePlanAdd() {
            let isValid = true;
            isValid = Validator.validateName(document.getElementById('titleid')) && isValid;
            isValid = Validator.validateRequired(document.getElementById('priceid'), 'Price') && isValid;
            isValid = Validator.validateRequired(document.getElementById('durationid'), 'Duration') && isValid;
            isValid = Validator.validateImageUpload(document.getElementById('imageid')) && isValid;
            isValid = Validator.validateRequired(document.getElementById('featuresid'), 'Features') && isValid;
            return isValid;
        }
    </script>
</body>
</html>