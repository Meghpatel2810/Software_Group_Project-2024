<?php
session_start();
// Include your database connection
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $distance = $_POST['distance'];
    $rating = $_POST['rating'];
    $amenities = $_POST['amenities'];

    // Insert location into the database
    $sql = "INSERT INTO locations (name, distance, rating, amenities) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sdss", $name, $distance, $rating, $amenities);

    if (mysqli_stmt_execute($stmt)) {
        echo "<div>Location added successfully!</div>";
    } else {
        echo "<div>Error: Could not add location.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #343a40;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px 70px ;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #495057;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .success, .error {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <h1>Add New Location</h1>
    <form method="post" action="add_location.php">
        <div>
            <label for="name">Location Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label for="distance">Distance (in km):</label>
            <input type="number" name="distance" step="0.1" required>
        </div>
        <div>
            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" min="1" max="5" required>
        </div>
        <div>
            <label for="amenities">Amenities:</label>
            <textarea name="amenities" required></textarea>
        </div>
        <input type="submit" value="Add Location">
    </form>
    <a href="home.php">Back to Home</a>
</body>
</html>
