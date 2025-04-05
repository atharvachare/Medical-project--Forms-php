<?php
session_start(); // Start a session to store login info

// Connect to the database
$conn = new mysqli("localhost", "root", "", "hospital_db");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, name, password FROM doctors WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a doctor with that email exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['doctor_id'] = $row['id'];
            $_SESSION['doctor_name'] = $row['name'];

            // Show success message for 2 seconds then redirect
            echo "<script>
                alert('✅ Login successful! Welcome, " . addslashes($row['name']) . "');
                setTimeout(function() {
                    window.location.href = 'dashboard.php';
                }, 2000);
            </script>";
            exit();
        } else {
            echo "❌ Invalid password.";
        }
    } else {
        echo "❌ No doctor found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>
