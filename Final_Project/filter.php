<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

require_once "database.php"; // Include your database connection

$amenities = isset($_GET['amenities']) ? $_GET['amenities'] : [];
$distance = isset($_GET['distance']) ? floatval($_GET['distance']) : null;
$min_rating = isset($_GET['min_rating']) ? floatval($_GET['min_rating']) : null;

// Initialize base query
$query = "SELECT * FROM locations WHERE 1=1";
$conditions = [];
$values = [];

// Amenities filter
if (!empty($amenities)) {
    $amenityConditions = [];
    foreach ($amenities as $amenity) {
        $amenityConditions[] = "amenities LIKE ?";
        $values[] = "%$amenity%";
    }
    $query .= " AND (" . implode(" OR ", $amenityConditions) . ")";
}

// Distance filter
if ($distance !== null) {
    $query .= " AND distance <= ?";
    $values[] = $distance;
}

// Minimum rating filter
if ($min_rating !== null) {
    $query .= " AND rating >= ?";
    $values[] = $min_rating;
}

// Prepare and execute the query
$stmt = mysqli_prepare($conn, $query);
if (!empty($values)) {
    $types = str_repeat('s', count($values)); // Assuming all params are strings
    mysqli_stmt_bind_param($stmt, $types, ...$values);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Display filtered locations
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Filtered Locations</title>

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
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin: 10px 0;
            padding: 15px;
            transition: transform 0.2s;
        }
        li:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        a {
            display: block;
            margin: 20px auto;
            text-align: center;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Filtered Locations</h1>
    <ul>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>{$row['name']} - Distance: {$row['distance']} km - Rating: {$row['rating']}</li>";
    }
    ?>
    </ul>
    <a href="index.php">Back to Home</a>
</body>
</html>
