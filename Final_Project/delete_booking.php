<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}

require_once "database.php"; // Include your database connection file

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Delete the booking
    $sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $booking_id);
    mysqli_stmt_execute($stmt);
}

// Redirect back to manage bookings
header("Location: manage_bookings.php");
exit();
?>
