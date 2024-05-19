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
            echo '<!DOCTYPE html>
                  <html lang="en">
                  <head>
                      <meta charset="UTF-8">
                      <meta name="viewport" content="width=device-width, initial-scale=1.0">
                      <title>Redirecting...</title>
                      <meta http-equiv="refresh" content="5;url=index.html">
                      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                      <style>
                          .redirect-container {
                              display: flex;
                              justify-content: center;
                              align-items: center;
                              height: 100vh;
                              text-align: center;
                          }
                          .redirect-message {
                              max-width: 600px;
                          }
                      </style>
                  </head>
                  <body>
                      <div class="container redirect-container">
                          <div class="redirect-message">
                              <h1 class="display-4">Enrollment Successful!</h1>
                              <p class="lead">Thank you for enrolling! You will be redirected to the homepage in a few seconds.</p>
                              <div class="spinner-border" role="status">
                                  <span class="sr-only">Loading...</span>
                              </div>
                          </div>
                      </div>
                  </body>
                  </html>';
            exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
