<?php
include 'db_connect.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize input
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
    $password = isset($_POST['password']) ? password_hash(trim($_POST['password']), PASSWORD_BCRYPT) : null;
    $role = isset($_POST['role']) ? htmlspecialchars(trim($_POST['role'])) : null;

    // Validate input
    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        die("❌ Error: All fields are required!");
    }

    // Check if the `doctor_staff_login` table exists
    $result = $conn->query("SHOW TABLES LIKE 'doctor_staff_login'");
    if ($result->num_rows == 0) {
        die("❌ Error: Table 'doctor_staff_login' does not exist in the database!");
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO doctor_staff_login (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }

    $stmt->bind_param("ssss", $name, $email, $password, $role);

    // Execute query
    if ($stmt->execute()) {
        echo "✅ Registration successful!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
