<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <style>
        body, html {
    height: 100%;
    margin: 0;
    padding: 0;
}
        body {
            font-family: Arial, sans-serif;
            background-image: url('gradient-style-abstract-wireframe-background_23-2148993321.jpg'); /* Replace with your image path */
            background-size: cover; /* Ensure the background image covers the entire page */
            background-position: center; /* Center the image */
            background-repeat: no-repeat;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            color: black;
            margin-bottom: 20px; /* Add some space below the heading */
        }
        
        nav {
            background-color: rgba(255, 255, 255, 0.8); /* White background with transparency */
            border-radius: 10px;
            padding: 20px; /* Add padding for aesthetics */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
            text-align: center; /* Center the text in the nav */
        }
        
        ul {
            list-style-type: none;
            padding: 0;
            display: flex; /* Use flexbox to arrange items horizontally */
            justify-content: center; /* Center the items */
        }
        
        li {
            margin: 0 15px; /* Add horizontal space between items */
        }
        
        a {
            text-decoration: none;
            color: #007bff;
            padding: 10px 20px;
            border: 1px solid #007bff;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        
        a:hover {
            background-color: #007bff;
            color: white;
        }

        .logout {
            display: block;
            text-align: center;
            margin-top: 30px;
            font-weight: bold;
            color: red;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <nav>
    <ul>
        <li><a href="manage_locations.php">Manage Locations</a></li>
        <li><a href="manage_users.php">Manage Users</a></li>
        <li><a href="comparison_results.php">View Comparison Results</a></li>
        <li><a href="manage_bookings.php">Manage Bookings</a></li>
        <li><a href="view_reviews.php">View Reviews</a></li>
        <li><a href="admin_logout.php">Logout</a></li>
    </ul>
    </nav>
    
</body>
</html>
