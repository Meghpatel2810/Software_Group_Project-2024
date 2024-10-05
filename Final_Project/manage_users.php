<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit();
}
require_once "database.php";

// Fetch users to display
$users = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2, h3 {
            text-align: center;
            color: #007bff;
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

        .user-info {
            font-size: 18px;
            font-weight: bold;
        }

        .email-info {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <h2>Manage Users</h2>

    <h3>Existing Users</h3>
    <ul>
        <?php while ($user = mysqli_fetch_assoc($users)) { ?>
            <li><?php echo $user['full_name']; ?> - <?php echo $user['email']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>
