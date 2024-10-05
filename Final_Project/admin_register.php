<?php
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: admin_dashboard.php"); // Redirect to admin dashboard if already logged in
    exit();
}

require_once "database.php"; // Include your database connection file

if (isset($_POST["register"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];
    
    $errors = [];

    // Validate input
    if (empty($email) || empty($password) || empty($passwordRepeat)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }

    if ($password !== $passwordRepeat) {
        $errors[] = "Passwords do not match.";
    }

    // Check if email already exists
    $sql = "SELECT * FROM admins WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $errors[] = "Email already exists.";
    }

    // If no errors, register the new admin
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO admins (email, password) VALUES (?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "ss", $email, $hashed_password);
        mysqli_stmt_execute($insert_stmt);

        echo "<div class='alert alert-success'>Admin registered successfully.</div>";
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('futuristic-background-design_23-2148503793.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            /* background-color: #f8f9fa; */
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-btn {
            text-align: center;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register as Admin</h2>
        <form action="admin_register.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" placeholder="Enter password" required>
            </div>
            <div class="form-group">
                <label for="repeat_password">Repeat Password:</label>
                <input type="password" class="form-control" name="repeat_password" placeholder="Repeat password" required>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="register">
            </div>
        </form>
        <div>
            <p>Already registered? <a href="admin_login.php">Login here</a></p>
        </div>
    </div>
</body>
</html>
