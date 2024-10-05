<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: admin_dashboard.php");
    exit();
}

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    require_once "database.php";

    $sql = "SELECT * FROM admins WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $admin = mysqli_fetch_assoc($result);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION["admin"] = $admin["id"];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <style>
        body, html {
    height: 100%;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-image: url('futuristic-background-design_23-2148503793.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
}

h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 20px;
}

form {
    max-width: 400px;
    width: 100%;  /* Ensure the form is responsive */
    margin: 0 auto;
    padding: 20px 50px;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

input[type="email"], input[type="password"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

p {
    text-align: center;
    color: red;
}
    </style>
</head>
<body>
    
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="post" action="admin_login.php">
        <h2>Admin Login</h2>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
