<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}

require_once "database.php"; // Include your database connection file

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Fetch the booking details
    $sql = "SELECT * FROM bookings WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $booking_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 0) {
        die("Booking not found.");
    }

    $booking = mysqli_fetch_assoc($result);
} else {
    die("Invalid request.");
}

if (isset($_POST['update'])) {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $status = $_POST['status'];

    // Update the booking details
    $sql = "UPDATE bookings SET date = ?, time = ?, location = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $date, $time, $location, $status, $booking_id);
    mysqli_stmt_execute($stmt);

    // Redirect back to manage bookings
    header("Location: manage_bookings.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Light background color for contrast */
            color: #333; /* Dark text for readability */
            padding: 20px; /* Space around the content */
        }
        
        .container {
            max-width: 600px; /* Set a max width for the form */
            margin: auto; /* Center the container */
            background-color: white; /* White background for form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for depth */
            padding: 20px; /* Padding inside the container */
        }

        h1 {
            text-align: center; /* Centered heading */
            color: #007bff; /* Bootstrap primary color */
            margin-bottom: 20px; /* Space below the heading */
        }

        .form-label {
            font-weight: bold; /* Bold labels for better visibility */
        }

        button {
            width: 100%; /* Full-width buttons for consistency */
        }

        .btn-secondary {
            margin-top: 10px; /* Space above the cancel button */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Booking</h1>
        <form method="post" action="edit_booking.php?id=<?php echo $booking_id; ?>">
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo htmlspecialchars($booking['date']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="time" class="form-label">Time</label>
                <input type="time" class="form-control" id="time" name="time" value="<?php echo htmlspecialchars($booking['time']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($booking['location']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="confirmed" <?php if ($booking['status'] == 'confirmed') echo 'selected'; ?>>Confirmed</option>
                    <option value="canceled" <?php if ($booking['status'] == 'canceled') echo 'selected'; ?>>Canceled</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Booking</button>
            <a href="manage_bookings.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
