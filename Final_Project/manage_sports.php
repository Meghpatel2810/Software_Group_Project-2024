<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

require_once "database.php";

// Add new sport
if (isset($_POST["add_sport"])) {
    $sport_name = $_POST["sport_name"];
    $sql = "INSERT INTO sports (name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $sport_name);
    mysqli_stmt_execute($stmt);
}

// Fetch sports to display
$sports = mysqli_query($conn, "SELECT * FROM sports");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Sports</title>
</head>
<body>
    <h2>Manage Sports</h2>

    <h3>Add New Sport</h3>
    <form method="post" action="manage_sports.php">
        <input type="text" name="sport_name" placeholder="Sport Name" required><br>
        <button type="submit" name="add_sport">Add Sport</button>
    </form>

    <h3>Existing Sports</h3>
    <ul>
        <?php while ($sport = mysqli_fetch_assoc($sports)) { ?>
            <li><?php echo $sport['name']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>
