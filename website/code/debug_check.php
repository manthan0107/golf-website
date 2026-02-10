<?php
$con = mysqli_connect("localhost", "root", "", "golfweb");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully to database: golfweb\n";

// List Tables
echo "--- TABLES ---\n";
$tables = mysqli_query($con, "SHOW TABLES");
while ($row = mysqli_fetch_array($tables)) {
    echo $row[0] . "\n";
}

// Check 'register' table
echo "\n--- REGISTER TABLE STRUCTURE ---\n";
if ($result = mysqli_query($con, "DESCRIBE register")) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['Field'] . " - " . $row['Type'] . "\n";
    }
} else {
    echo "Table 'register' does not exist.\n";
}

echo "\n--- REGISTER TABLE DATA (Last 5 users) ---\n";
if ($result = mysqli_query($con, "SELECT * FROM register ORDER BY id DESC LIMIT 5")) {
    while ($row = mysqli_fetch_assoc($result)) {
        print_r($row);
    }
}

// Check 'signup' table
echo "\n--- SIGNUP TABLE STRUCTURE ---\n";
if ($result = mysqli_query($con, "DESCRIBE signup")) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['Field'] . " - " . $row['Type'] . "\n";
    }
} else {
    echo "Table 'signup' does not exist.\n";
}

echo "\n--- SIGNUP TABLE DATA (Last 5 users) ---\n";
if ($result = mysqli_query($con, "SELECT * FROM signup ORDER BY id DESC LIMIT 5")) {
    while ($row = mysqli_fetch_assoc($result)) {
        print_r($row);
    }
}
?>
