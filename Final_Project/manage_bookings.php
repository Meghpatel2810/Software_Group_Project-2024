<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
require_once "database.php";

// Fetch bookings
$bookings = [];
$sql = "SELECT b.id, b.sport, b.time, b.location, b.date 
        FROM bookings b 
        JOIN users u ON b.id = u.id 
        ORDER BY b.date, b.time"; // Order by date and time
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-image: url('gradient-style-abstract-wireframe-background_23-2148993321.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            color: black;
            margin-bottom: 20px;
        }
        
        .bookings-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .bookings-table th, .bookings-table td {
            border: 1px solid #007bff;
            padding: 10px;
            text-align: left;
        }

        .bookings-table th {
            background-color: #007bff;
            color: white;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #007bff;
            padding: 10px 20px;
            border: 1px solid #007bff;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .back-link a:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Manage Bookings</h1>
    <table class="bookings-table">
        <thead>
            <tr>
                <!-- <th>User Name</th> -->
                <th>Sport Name</th>
                <th>Sport Time</th>
                <th>Sport Date</th>
                <th>Sport Place</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($bookings) > 0): ?>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <!-- <td><?php echo htmlspecialchars($booking['full_name']); ?></td> -->
                        <td><?php echo htmlspecialchars($booking['sport']); ?></td>
                        <td><?php echo htmlspecialchars($booking['time']); ?></td>
                        <td><?php echo htmlspecialchars($booking['date']); ?></td>
                        <td><?php echo htmlspecialchars($booking['location']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No bookings found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="back-link">
        <a href="admin_dashboard.php">Back to Admin Dashboard</a>
    </div>
</body>
</html>
