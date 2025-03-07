<?php
$servername = "localhost";
$username = "root";  // Change if needed
$password = "2002";  // Change if needed
$database = "website_db";  // Replace with your actual database name

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Validate form data
if (empty($name) || empty($email) || empty($phone) || empty($message)) {
    die("All fields are required!");
}

// Prepare SQL statement
$stmt = $mysqli->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $phone, $message);

// Execute query
if ($stmt->execute()) {
    // Close statement immediately after execution
    $stmt->close();

    // Securely pass form data to Python script
    $command = escapeshellcmd("python send-email.py " . 
        escapeshellarg($name) . " " . 
        escapeshellarg($email) . " " . 
        escapeshellarg($phone) . " " . 
        escapeshellarg($message)
    );

    $output = shell_exec($command);

    // Close database connection after email execution
    $mysqli->close();

    if (trim($output) === "success") {
        // Redirect only if email is successfully sent
        header("Location: index.html");
        exit();
    } else {
        error_log("Email Error: " . $output); // Log the error for debugging
        echo "Message saved, but email notification failed.";
    }
} else {
    echo "Error: " . $stmt->error;
}

// Ensure the connection is closed
$mysqli->close();
?>






