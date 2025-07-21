<?php
include 'db_connect.php';

// Generate a hash for password "password123"
$password = "password123";
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

echo "Generated hash for password '$password':<br>";
echo $hashed_password . "<br><br>";

// Insert a test user
$username = "testuser";
$role = "student";
$full_name = "Test User";
$email = "test@example.com";

$sql = "INSERT INTO users (username, password, role, full_name, email) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $hashed_password, $role, $full_name, $email);

if ($stmt->execute()) {
    echo "Test user created successfully!<br>";
    echo "Username: $username<br>";
    echo "Password: $password<br>";
    echo "Role: $role<br>";
    echo "<br>You can now login with these credentials.";
} else {
    echo "Error creating user: " . $stmt->error;
}

$stmt->close();
$conn->close();
?> 