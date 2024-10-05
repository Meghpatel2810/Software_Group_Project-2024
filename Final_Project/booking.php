<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php"); // Redirect to login if user is not logged in
    exit();
}

require_once "database.php"; // Include database connection

if (isset($_POST['book'])) {
    $sport = $_POST['sport'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $user_id = $_SESSION['user']; // Get the logged-in user ID from session

    // Insert booking data into the database
    $sql = "INSERT INTO bookings (user_id, sport, date, time, location) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "issss", $user_id, $sport, $date, $time, $location);
        mysqli_stmt_execute($stmt);
        // echo "<div class='alert alert-success'></div>";
    } else {
        echo "<div class='alert alert-danger'>Something went wrong. Please try again later.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Sport</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Full height of the viewport */
            margin: 0;
            background-image: url('landing-page-template-appointment-bookings_52683-38832.jpg');
            background-size: cover;
            background-position: center;
            font-family: 'Arial', sans-serif;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95); /* Slightly transparent white background */
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            margin: auto;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }
        .form-btn input {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }
        .form-btn input:hover {
            background-color: #0056b3;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        footer {
            text-align: center;
            padding: 15px;
            background-color: #222;
            color: white;
            margin-top: auto;
            width: 100%;
        }
        footer ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }
        footer ul li {
            display: inline;
            margin: 0 15px;
        }
        footer ul li a {
            color: #ddd;
            text-decoration: none;
        }
        footer ul li a:hover {
            text-decoration: underline;
        }
        .social-media {
            margin-top: 15px;
        }
        .social-media img {
            margin: 0 10px;
            transition: transform 0.3s ease;
        }
        .social-media img:hover {
            transform: scale(1.2);
        }
    </style>

</head>

<body>

    <div class="container">
        <h2 style="text-align: center; margin-bottom: 20px;">Book a Sport</h2>
        <form action="booking.php" method="post">
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="sport">Select Sport:</label>
                <select name="sport" class="form-control" id="sport" required>
                    <option value="Football">Football</option>
                    <option value="Basketball">Basketball</option>
                    <option value="Tennis">Tennis</option>
                    <option value="Cricket">Cricket</option>
                    <option value="Badminton">Badminton</option>
                    <option value="Swimming">Swimming</option>
                    <option value="Vollet Ball">Vollet Ball</option>
                    <option value="Archery">Archery</option>
                    <option value="Boxing">Boxing</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="date">Select Date:</label>
                <input type="date" name="date" class="form-control" id="date" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="time">Select Time:</label>
                <input type="time" name="time" class="form-control" id="time" required>
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="location">Select Location:</label>
                <select name="location" class="form-control" id="location" required>
                    <option value="Vadodara">Vadodara</option>
                    <option value="Ahmedabad">Ahmedabad</option>
                    <option value="Nadiad">Nadiad</option>
                    <option value="Anand">Anand</option>
                    <option value="Surat">Surat</option>
                    <option value="Rajkot">Rajkot</option>
                </select>
            </div>
            <div class="form-btn" style="text-align: center;">
                <input type="submit" value="Book Now" name="book" class="btn btn-primary">
            </div>
        </form>
        <div style="text-align: center; margin-top: 20px;">
            <p><a href="index.php">Back to Home</a></p>
        </div>
    </div>


    <footer>
        <p>&copy; 2024 Sports Location Search System. All rights reserved.</p>
        <ul style="list-style: none; padding: 0;">
            <li style="display: inline; margin-right: 15px;"><a href="about.html">About Us</a></li>
            <li style="display: inline; margin-right: 15px;"><a href="privacy.html">Privacy Policy</a></li>
            <li style="display: inline;"><a href="terms.html">Terms of Service</a></li>
        </ul>
        <div class="social-media">
            <a href="#"><img height="30" src="https://pngimg.com/uploads/facebook_logos/facebook_logos_PNG19757.png" alt="Facebook"></a>
            <a href="#"><img height="30" src="https://psfonttk.com/wp-content/uploads/2020/09/Instagram-Logo-PNG.png" alt="Instagram"></a>
            <a href="#"><img height="30" src="https://cdn-icons-png.flaticon.com/512/889/889147.png" alt="Twitter"></a>
        </div>
    </footer>
</body>
</html>
