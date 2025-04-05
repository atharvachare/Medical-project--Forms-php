<?php
// Connect to database
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get form data
        $patient_name = htmlspecialchars($_POST['patient_name']);
        $doctor_name = htmlspecialchars($_POST['doctor_name']);
        $appointment_date = $_POST['appointment_date'];
        $reason = htmlspecialchars($_POST['reason'] ?? '');

        // Get patient ID
        $patient_stmt = $conn->prepare("SELECT id FROM patients WHERE name = ?");
        $patient_stmt->bind_param("s", $patient_name);
        $patient_stmt->execute();
        $patient_result = $patient_stmt->get_result();
        if ($patient_result->num_rows === 0) {
            throw new Exception("Patient not found");
        }
        $patient_id = $patient_result->fetch_assoc()['id'];

        // Get doctor ID
        $doctor_stmt = $conn->prepare("SELECT id FROM doctors WHERE name = ?");
        $doctor_stmt->bind_param("s", $doctor_name);
        $doctor_stmt->execute();
        $doctor_result = $doctor_stmt->get_result();
        if ($doctor_result->num_rows === 0) {
            throw new Exception("Doctor not found");
        }
        $doctor_id = $doctor_result->fetch_assoc()['id'];

        // Insert appointment
        $stmt = $conn->prepare("INSERT INTO appointments (patient_id, doctor_id, appointment_date, reason) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $patient_id, $doctor_id, $appointment_date, $reason);
        
        if ($stmt->execute()) {
            echo "<script>
                alert('Your appointment booked successfully!');
                window.location.href = 'index.html';
            </script>";
        } else {
            throw new Exception("Error booking appointment: " . $stmt->error);
        }
        
        $stmt->close();
    } catch (Exception $e) {
        echo "<script>
            alert('Error: " . addslashes($e->getMessage()) . "');
            window.history.back();
        </script>";
    }
}

$conn->close();
?>
