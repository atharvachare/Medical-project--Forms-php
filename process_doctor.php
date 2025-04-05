<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "hospital_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $stmt variable
$stmt = null;

// If form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and fetch input
    $name = trim($_POST['name']);
    $specialization = trim($_POST['specialization']);
    $contact = trim($_POST['contact']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // First check if email exists
    $check_stmt = $conn->prepare("SELECT id FROM doctors WHERE email = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if ($check_stmt->num_rows > 0) {
        echo "<h3 style='color:red'>Error: This email is already registered</h3>";
        echo "<p><a href='register_doctor.html'>Try again with different email</a></p>";
    } else {
        // Prepare and execute insert
        $stmt = $conn->prepare("INSERT INTO doctors (name, specialization, contact, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $specialization, $contact, $email, $password);

        if ($stmt->execute()) {
            echo "<h3 style='color:green'>Doctor Registered Successfully!</h3>";
            echo "<p><a href='index.html'>Click here to login</a></p>";
        } else {
            echo "<h3 style='color:red'>Error: " . $stmt->error . "</h3>";
        }
    }
    
    // Close statements if they exist
    if ($check_stmt) $check_stmt->close();
    if ($stmt) $stmt->close();
}

$conn->close();
?>
