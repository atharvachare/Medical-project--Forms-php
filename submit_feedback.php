<?php
include 'db_connect.php'; // Ensure this contains a valid database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input data and sanitize
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $rating = intval($_POST['rating']);
    $review = htmlspecialchars($_POST['review']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<h3>Invalid email format!</h3>");
    }

    // Prepare SQL query
    $sql = "INSERT INTO feedback (name, email, rating, comments) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("<h3>SQL Error: " . $conn->error . "</h3>"); // Debug SQL error
    }

    // Bind parameters
    $stmt->bind_param("ssis", $name, $email, $rating, $review);

    // Execute and check success
    if ($stmt->execute()) {
        echo "<h3>Feedback Submitted Successfully!</h3>";
    } else {
        echo "<h3>Error: " . $stmt->error . "</h3>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h3>Invalid request!</h3>";
}
?>
