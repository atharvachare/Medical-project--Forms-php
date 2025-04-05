<?php
session_start();

// Verify staff is logged in
if (!isset($_SESSION['staff_id'])) {
    header("Location: staff_login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .welcome {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .menu {
            margin-top: 20px;
        }
        .menu a {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .role-badge {
            background: #2196F3;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Staff Dashboard</h1>
        <div class="welcome">
            Welcome, <?php echo htmlspecialchars($_SESSION['staff_name']); ?>
            <span class="role-badge"><?php echo htmlspecialchars($_SESSION['staff_role']); ?></span>
        </div>
        
        <div class="menu">
            <a href="manage_patients.php">Manage Patients</a>
            <a href="view_appointments.php">View Appointments</a>
            <a href="staff_profile.php">My Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
