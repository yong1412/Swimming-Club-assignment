<?php
// Establish the database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'swimming_society';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all records from the 'member' table
$sql = "SELECT * FROM staff";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Name: " . $row["name"] . "<br>";
        echo "Gender: " . $row["gender"] . "<br>";
        echo "Age: " . $row["age"] . "<br>";
        echo "IC: " . $row["ic"] . "<br>";
        echo "Phone: " . $row["phone"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Birthdate: " . $row["birthdate"] . "<br>";
        echo "<hr>"; // Add a horizontal rule between members
    }
} else {
    echo "No members found.";
}

$conn->close(); // Close the database connection
?>
