<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "dbtest");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve image from database
$result = $conn->query("SELECT * FROM images ORDER BY id DESC LIMIT 1");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    header("Content-type: image/png"); // Assuming images are JPEG format
    echo $row['image'];
} else {
    echo "No image found.";
}

// Close connection
$conn->close();
?>
