<?php
session_start();
// Include your database connection
require_once "database.php";

// Predefined list of sports complexes
$sports_complexes = [
    "Vadodara Sports Complex",
    "Akota Sports Complex [Vadodara]",
    "Manjalpur Sports Complex [Vadodara]",
    "Sardar Vallabhbhai Patel Sports Enclave [Ahmedabad]",
    "Sport Complex Sabarmati Riverfront [Ahmedabad]",
    "EKA Arena [Ahmedabad]",
    "Sports Complex [Nadiad]",
    "Infinity Sports [Nadiad]",
    "Delux Sports Club [Nadiad]",
    "Sardar Patel SAG Sports Complex [Anand]",
    "Lal Bahadur Shastri Stadium [Anand]",
    "L.P. Savani Sports Complex [Surat]",
    "SMC Sports Complex [Surat]",
    "Veer Savarkar Indoor Stadium [Rajkot]",
    "TGES Sports Centre [Rajkot]"
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_location = $_POST['location'];
    $rating = $_POST['rating'];
    $amenities = $_POST['amenities'];

    // Insert location into the database
    $sql = "INSERT INTO locations (name, rating, amenities) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sis", $selected_location, $rating, $amenities);

    if (mysqli_stmt_execute($stmt)) {
        echo "<div class='success'>Location added successfully!</div>";
    } else {
        echo "<div class='error'>Error: Could not add location.</div>";
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
            background-color:  lightgray;
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
            padding: 20px 70px;
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
        input[type="number"],
        select {
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
            <label for="location">Select Location:</label>
            <select name="location" required>
                <option value="" disabled selected>Select a location</option>
                <?php foreach ($sports_complexes as $complex): ?>
                    <option value="<?php echo htmlspecialchars($complex); ?>"><?php echo htmlspecialchars($complex); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="rating">Rating (1-5):</label>
            <input type="number" name="rating" min="1" max="5" required>
        </div>
        <div>
            <label for="amenities">Select Sport:</label>
            <select name="amenities" required>
                <option value="" disabled selected>Select a sport</option>
                <option value="Football">Football</option>
                <option value="Basketball">Basketball</option>
                <option value="Tennis">Tennis</option>
                <option value="Cricket">Cricket</option>
                <option value="Badminton">Badminton</option>
                <option value="Swimming">Swimming</option>
                <option value="Volleyball">Volleyball</option>
                <option value="Archery">Archery</option>
                <option value="Boxing">Boxing</option>
            </select>
        </div>
        <input type="submit" value="Add Location">
    </form>
    <a href="home.php">Back to Home</a>
</body>
</html>
