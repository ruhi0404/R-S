<?php
// Database connection
$servername = "localhost";
$username = "root";  // Update with your database username
$password = "";  // Update with your database password
$dbname = "restaurant";  // The database name you created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to check if the user exists
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);  // "s" for string
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // Verify the password (hashing is important for security)
    if (password_verify($password, $row['password'])) {
        // Password is correct, redirect to dashboard
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];
        header("Location: dashboard.html");
        exit();
    } else {
        // Incorrect password
        echo "Invalid email or password.";
    }
} else {
    // User not found
    echo "Invalid email or password.";
}

// Close the connection
$conn->close();
?>
