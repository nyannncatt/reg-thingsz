<?php
// Database connection details
$host = 'localhost';  // Usually 'localhost'
$db = 'registration'; // The name of the database you created
$user = 'root';       // Your MySQL username
$pass = '';           // Your MySQL password (leave empty if no password)

// Establishing the connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL query to insert the data into the users table
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the query
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}
?>
