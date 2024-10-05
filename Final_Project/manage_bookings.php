<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}

require_once "database.php"; // Include your database connection file

// Fetch bookings from the database
$sql = "SELECT b.id, b.user_id, b.date, b.time, b.location, b.status, u.full_name, u.email 
        FROM bookings b 
        JOIN users u ON b.user_id = u.id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching bookings: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn {
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-warning {
            background-color: #ffc107;
            color: white;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            text-align: center;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Bookings</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['date']); ?></td>
                    <td><?php echo htmlspecialchars($row['time']); ?></td>
                    <td><?php echo htmlspecialchars($row['location']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <a href="edit_booking.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete_booking.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
</body>
</html>
