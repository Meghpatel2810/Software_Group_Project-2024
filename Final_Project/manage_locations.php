<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}
require_once "database.php";

// Add new location
if (isset($_POST["add_location"])) {
    $name = $_POST["name"];
    $distance = $_POST["distance"];
    $rating = $_POST["rating"];
    $amenities = $_POST["amenities"];

    $sql = "INSERT INTO locations (name, distance, rating, amenities) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sdss", $name, $distance, $rating, $amenities);
    mysqli_stmt_execute($stmt);
}

// Fetch locations to display
$locations = mysqli_query($conn, "SELECT * FROM locations");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Locations</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        h2, h3 {
            text-align: center;
            color: #007bff;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            padding: 20px 50px 20px 30px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
            max-width: 600px;
            margin: 20px auto;
        }

        li {
            background-color: #f1f1f1;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        li:nth-child(odd) {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <h2>Manage Locations</h2>

    <h3>Add New Location</h3>
    <form method="post" action="manage_locations.php">
        <input type="text" name="name" placeholder="Location Name" required><br>
        <input type="number" name="distance" placeholder="Distance (km)" required><br>
        <input type="number" name="rating" placeholder="Rating" required><br>
        <textarea name="amenities" placeholder="Amenities" required></textarea><br>
        <button type="submit" name="add_location">Add Location</button>
    </form>

    <h3>Existing Locations</h3>
    <ul>
        <?php while ($location = mysqli_fetch_assoc($locations)) { ?>
            <li><?php echo $location['name']; ?> - 
                Distance: <?php echo $location['distance']; ?> km - 
                Rating: <?php echo $location['rating']; ?><br>
                Amenities: <?php echo $location['amenities']; ?>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
