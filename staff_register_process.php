<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "hospital_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and fetch input
    $name = trim($_POST['name']);
    $role = trim($_POST['role']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // First check if email exists
    $check_stmt = $conn->prepare("SELECT id FROM staff WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if ($check_stmt->num_rows > 0) {
        echo "<h3 style='color:red'>Error: This email is already registered</h3>";
        echo "<p><a href='staff_registration.html'>Try again with different email</a></p>";
    } else {
        // Prepare and bind SQL insert
        $stmt = $conn->prepare("INSERT INTO staff (name, role, email, contact, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $role, $email, $contact, $password);

        // Execute and handle result
        if ($stmt->execute()) {
            echo "<h3 style='color:green'>Staff Registered Successfully!</h3>";
            echo "<p><a href='staff_login.html'>Click here to login</a></p>";
        } else {
            echo "<h3 style='color:red'>Error: " . $stmt->error . "</h3>";
        }
        $stmt->close();
    }
    $check_stmt->close();
}

$conn->close();
?>
