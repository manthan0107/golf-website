<?php
    include "lib/db.php";

    $id=$_GET['id'];

    if(isset($_POST['submit']))
    {
        $title=$_POST['title'];
        $price=$_POST['price'];
        $duration=$_POST['duration'];
        $features=$_POST['features'];
        
        $image=$_FILES['image']['name'];
        if($image) {
            $tmp_name=$_FILES['image']['tmp_name'];
            $path='img/'.$image;
            move_uploaded_file($tmp_name,$path);
            $stmt = $con->prepare("UPDATE `plan` SET `title`=?, `price`=?, `duration`=?, `image`=?, `features`=? WHERE id=?");
            $stmt->bind_param("sssssi", $title, $price, $duration, $image, $features, $id);
        } else {
            $stmt = $con->prepare("UPDATE `plan` SET `title`=?, `price`=?, `duration`=?, `features`=? WHERE id=?");
            $stmt->bind_param("ssssi", $title, $price, $duration, $features, $id);
        }
        
        $stmt->execute();
        header("location:planshow.php");
    }

    // Fetch existing data
    $stmt = $con->prepare("SELECT * FROM `plan` WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
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
                <div class="bg-secondary text-center rounded p-4">
                    <div class="container py-5">
                        <div class="card shadow p-4 border-0 bg-white">
                            <h3 class="mb-4 text-primary">✏️ Update Plan</h3>
                            <form method="post" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <div class="col-md-6 text-start">
                                        <label class="form-label text-dark">Plan Title</label>
                                        <input type="text" name="title" class="form-control bg-white text-dark border" value="<?php echo $row['title']?>" required>
                                    </div>
                                    <div class="col-md-6 text-start">
                                        <label class="form-label text-dark">Price ($)</label>
                                        <input type="number" min="0" name="price" class="form-control bg-white text-dark border" value="<?php echo $row['price']?>" required>
                                    </div>
                                    <div class="col-md-6 text-start">
                                        <label class="form-label text-dark">Duration</label>
                                        <input type="text" name="duration" class="form-control bg-white text-dark border" value="<?php echo $row['duration']?>" required>
                                    </div>
                                    <div class="col-md-6 text-start">
                                        <label class="form-label text-dark">Plan Icon</label>
                                        <input type="file" name="image" class="form-control bg-white text-dark border" accept="image/*">
                                        <small class="text-muted">Current: <?php echo $row['image']; ?></small>
                                    </div>
                                    <div class="col-12 text-start">
                                        <label class="form-label text-dark">Features (one per line)</label>
                                        <textarea name="features" rows="5" class="form-control bg-white text-dark border" required><?php echo $row['features']?></textarea>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center gap-2 mt-3">
                                        <input type="submit" name="submit" class="btn btn-primary" value="Update Plan">
                                        <a href="planshow.php" class="btn btn-secondary">Cancel</a>
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
</body>
</html>