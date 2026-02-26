<?php
$con = mysqli_connect("localhost", "root", "", "golfweb");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$queries = [
    "ALTER TABLE team ADD COLUMN IF NOT EXISTS email VARCHAR(255) DEFAULT NULL"
];

foreach ($queries as $q) {
    if (mysqli_query($con, $q)) {
        echo "Successfully executed: $q\n";
    } else {
        echo "Error executing $q: " . mysqli_error($con) . "\n";
    }
}

mysqli_close($con);
?>
