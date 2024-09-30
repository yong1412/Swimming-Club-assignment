<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$conn = new mysqli('localhost', 'root', 'swimming_club new');
if($conn->connect_error) {
    die('Connection Failed : '.$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into signup(username, email, password)
    values(?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    $stmt->execute();
    echo "registration successfull";
    $stmt->close();
    $conn->close();
}

?>
