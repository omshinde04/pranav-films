<?php
$servername = "localhost"; // Change if using a remote database
$username = "root"; // Default for XAMPP
$password = "2002"; // Default is empty in XAMPP
$database = "website_db"; // Ensure this matches your DB name

$mysqli = new mysqli($servername, $username, $password, $database);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
    echo "Database connected successfully!";
}
?>
