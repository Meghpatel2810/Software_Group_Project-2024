<?php
// Include the database connection
require_once "database.php";

// Fetch locations from the database for dropdowns
$query = "SELECT id, name FROM locations";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare Locations</title>
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
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #495057;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
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
            width: 100%;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
            margin: 20px auto;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Compare Locations</h1>
    <a href="add_location.php">Add New Location</a>

    <form method="get" action="compare.php">
        <label for="location_id_1">Location 1:</label>
        <select name="location_id_1" required>
            <option value="">Select Location</option>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?= $row['id']; ?>"><?= htmlspecialchars($row['name']); ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <label for="location_id_2">Location 2:</label>
        <select name="location_id_2" required>
            <option value="">Select Location</option>
            <?php 
            // Reset result pointer for the second dropdown
            mysqli_data_seek($result, 0); 
            while ($row = mysqli_fetch_assoc($result)): ?>
                <option value="<?= $row['id']; ?>"><?= htmlspecialchars($row['name']); ?></option>
            <?php endwhile; ?>
        </select>
        <br>
        <input type="submit" value="Compare">
    </form>

    <a href="index.php">Back to Home</a>
</body>
</html>
