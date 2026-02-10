<?php
include 'db.php';

// Fix email column length
$sql1 = "ALTER TABLE register MODIFY email VARCHAR(255)";
if ($con->query($sql1) === TRUE) {
    echo "Column 'email' updated to VARCHAR(255) successfully.\n";
} else {
    echo "Error updating 'email': " . $con->error . "\n";
}

// Fix username column length just in case
$sql2 = "ALTER TABLE register MODIFY username VARCHAR(255)";
if ($con->query($sql2) === TRUE) {
    echo "Column 'username' updated to VARCHAR(255) successfully.\n";
} else {
    echo "Error updating 'username': " . $con->error . "\n";
}

// Optional: Fix signup table too if they decide to use it, but we are using register.

echo "Database schema fixed. Please try registering again.\n";
?>
