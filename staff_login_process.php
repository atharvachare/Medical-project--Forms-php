<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "hospital_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT id, name, role, password FROM staff WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row['password'])) {
            $_SESSION['staff_id'] = $row['id'];
            $_SESSION['staff_name'] = $row['name'];
            $_SESSION['staff_role'] = $row['role'];
            
            echo "<script>
                alert('✅ Login successful! Welcome, " . addslashes($row['name']) . "');
            </script>";
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No staff found with that email";
    }

    $stmt->close();
}

$conn->close();
?>
