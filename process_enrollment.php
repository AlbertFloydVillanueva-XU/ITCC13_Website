<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fullName = $_POST['fullName'];
$dob = $_POST['dob'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$course = $_POST['course'];

$sql = "INSERT INTO enrollments (fullName, dob, age, gender, email, phone, address, course)
VALUES ('$fullName', '$dob', '$age', '$gender', '$email', '$phone', '$address', '$course')";

if ($conn->query($sql) === TRUE) {
    echo "Enrollment successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
