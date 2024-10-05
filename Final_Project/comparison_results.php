<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}
require_once "database.php";

// Fetch comparison results
$results = mysqli_query($conn, "SELECT * FROM comparison_results");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comparison Results</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        ul {
            list-style-type: none;
            padding: 0;
            max-width: 800px;
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

        .comparison-id {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .location-info, .result-info, .date-info {
            font-size: 14px;
            color: #555;
        }

    </style>
</head>
<body>
    <h2>Comparison Results</h2>

    <ul>
        <?php while ($result = mysqli_fetch_assoc($results)) { ?>
            <li>Comparison ID: <?php echo $result['id']; ?> - 
                Location 1 ID: <?php echo $result['location_id_1']; ?> - 
                Location 2 ID: <?php echo $result['location_id_2']; ?> -
                Result: <?php echo $result['comparison_result']; ?> -
                Date: <?php echo $result['comparison_date']; ?> 
            </li>
        <?php } ?>
    </ul>
</body>
</html>
