<?php
$con = mysqli_connect("localhost", "root", "", "golfweb");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$queries = [
    "CREATE TABLE IF NOT EXISTS `signup` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(100) NOT NULL,
      `email` varchar(100) NOT NULL,
      `password` varchar(255) NOT NULL,
      `phone` varchar(20) DEFAULT NULL,
      `image` varchar(255) DEFAULT NULL,
      PRIMARY KEY (`id`)
    )",
    // Insert a default admin if table is empty
    "INSERT INTO `signup` (`username`, `email`, `password`)
     SELECT 'Admin', 'admin@example.com', 'admin123'
     WHERE NOT EXISTS (SELECT 1 FROM `signup`)"
];

foreach ($queries as $q) {
    if (mysqli_query($con, $q)) {
        echo "Successfully executed query.\n";
    } else {
        echo "Error: " . mysqli_error($con) . "\n";
    }
}

mysqli_close($con);
?>
