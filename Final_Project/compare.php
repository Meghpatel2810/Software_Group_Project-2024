<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

// Include your database connection
require_once "database.php";

if (isset($_GET["location_id_1"]) && isset($_GET["location_id_2"])) {
    $location_id_1 = $_GET["location_id_1"];
    $location_id_2 = $_GET["location_id_2"];

    // Fetch details of the first location
    $sql1 = "SELECT * FROM locations WHERE id = ?";
    $stmt1 = mysqli_prepare($conn, $sql1);
    mysqli_stmt_bind_param($stmt1, "i", $location_id_1);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    $location1 = mysqli_fetch_assoc($result1);

    // Fetch details of the second location
    $sql2 = "SELECT * FROM locations WHERE id = ?";
    $stmt2 = mysqli_prepare($conn, $sql2);
    mysqli_stmt_bind_param($stmt2, "i", $location_id_2);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $location2 = mysqli_fetch_assoc($result2);

    // Check if both locations are found
    if ($location1 && $location2) {
        // Compare the locations (example logic)
        $comparison_result = "Comparison of " . $location1['name'] . " and " . $location2['name'] . ": ";
        $comparison_result .= "Distance: " . $location1['distance'] . " km vs " . $location2['distance'] . " km; ";
        $comparison_result .= "Rating: " . $location1['rating'] . " vs " . $location2['rating'] . "; ";
        $comparison_result .= "Amenities: " . $location1['amenities'] . " vs " . $location2['amenities'];

        echo "<h3>$comparison_result</h3>";

        // Store the comparison result in the database
        $insert_sql = "INSERT INTO comparison_results (location_id_1, location_id_2, comparison_result) VALUES (?, ?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "iis", $location_id_1, $location_id_2, $comparison_result);

        if (mysqli_stmt_execute($insert_stmt)) {
            echo "<div>Comparison result saved successfully!</div>";
        } else {
            echo "<div>Error: Could not save comparison result.</div>";
        }
    } else {
        echo "One or both locations not found.";
    }
} else {
    echo "Location IDs are not set.";
}
?>
