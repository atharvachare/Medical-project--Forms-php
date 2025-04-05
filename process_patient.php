<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hospital_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
    $age = isset($_POST['age']) ? intval($_POST['age']) : 0;
    $gender = isset($_POST['gender']) ? $conn->real_escape_string($_POST['gender']) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $contact = isset($_POST['contact']) ? $conn->real_escape_string($_POST['contact']) : '';
    $address = isset($_POST['address']) ? $conn->real_escape_string($_POST['address']) : '';
    $password = isset($_POST['password']) ? password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT) : '';

    // Insert into database
    $sql = "INSERT INTO patients (name, age, gender, email, contact, address, password) 
            VALUES ('$name', $age, '$gender', '$email', '$contact', '$address', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Patient Registered Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid Request!";
}
?>
