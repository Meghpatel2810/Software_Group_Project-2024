<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Sports Location Booking - Current Bookings</h1>
    </header>

    <!-- Booking Display Section -->
    <section class="booking-display">
        <h2>All Reservations</h2>
        <div class="booking-list">
            <?php
            // Read booking data from file
            $file = 'bookings.txt';
            if (file_exists($file)) {
                $bookings = file($file);

                // Display each booking
                foreach ($bookings as $booking) {
                    echo "<p>$booking</p>";
                }
            } else {
                echo "<p>No bookings found.</p>";
            }
            ?>
        </div>
    </section>

</body>
</html>
