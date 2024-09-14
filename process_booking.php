<?php
// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sport = htmlspecialchars($_POST['sport']);
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $location = htmlspecialchars($_POST['location']);

    // Basic validation
    if (!empty($sport) && !empty($date) && !empty($time) && !empty($location)) {
        // Processing the booking
        // In a real system, you'd store this information in a database
        echo "<h2>Booking Confirmation</h2>";
        echo "<p>Sport: $sport</p>";
        echo "<p>Date: $date</p>";
        echo "<p>Time: $time</p>";
        echo "<p>Location: $location</p>";
        echo "<p>Your booking has been successfully processed!</p>";
    } else {
        echo "<h2>Error</h2>";
        echo "<p>Please fill out all required fields.</p>";
    }
} else {
    // Redirect to booking page if form is not submitted
    header("Location: booking.html");
    exit();
}
?>
