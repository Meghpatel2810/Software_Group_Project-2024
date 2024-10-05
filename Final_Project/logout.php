<?php
session_start();
session_destroy();
header("Location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your stylesheet -->
</head>
<body>
    <div class="logout-message">
        <h1>Logging out...</h1>
        <p>You will be redirected to the login page shortly.</p>
    </div>

    <!-- Redirect to login page after 2 seconds -->
    <script>
        setTimeout(function() {
            window.location.href = 'login.php';
        }, 2000);
    </script>
</body>
</html>