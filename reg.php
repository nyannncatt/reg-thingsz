<?php

$host = 'localhost';  
$db = 'registration'; 
$user = 'root';       
$pass = '';           


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

  
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

  
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);


    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

 
    $stmt->close();
    $conn->close();
}
?>
