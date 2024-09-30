<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'swimming_society';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ic = $_POST["ic"];

    // Check if the IC already exists in the database
    $check_sql = "SELECT * FROM member WHERE ic = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("s", $ic);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // IC already exists, handle this case (e.g., return an error message)
        echo "A record with this IC already exists. Please check the information provided.";
    } else {
        // IC does not exist, safe to insert
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $age = intval($_POST["age"]);
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $birthdate = $_POST["birthdate"];

        $insert_sql = "INSERT INTO member (name, gender, age, ic, phone, birthdate, email) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($insert_sql);
        $stmt_insert->bind_param("ssissss", $name, $gender, $age, $ic, $phone, $birthdate, $email);

        if ($stmt_insert->execute()) {
            echo "New member record created successfully.";
        } else {
            echo "Error: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
}

$conn->close();
?>