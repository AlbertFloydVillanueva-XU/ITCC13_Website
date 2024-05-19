<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "college"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO contact_submissions (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        // Execute the statement
        if ($stmt->execute()) {
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
                              <h1 class="display-4">Message has been sent!</h1>
                              <p class="lead">Thank you for sending a message! We will respond to your request as soon as possible.</p>
                              <div class="spinner-border" role="status">
                                  <span class="sr-only">Loading...</span>
                              </div>
                          </div>
                      </div>
                  </body>
                  </html>';
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        echo "Invalid email address.";
    }
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>
