<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $errors = array();

    if (empty($name) OR empty($email) OR empty($subject) OR empty($message)) {
        array_push($errors, "All fields are required.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid.");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        require_once "database.php"; // Include your database connection file

        $sql = "INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $subject, $message);
            mysqli_stmt_execute($stmt);
            // echo "<div class='alert alert-success'>Message sent successfully and stored in the database.</div>";
        } else {
            echo "<div class='alert alert-danger'>Something went wrong. Please try again later.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        /* Body styling and background image */
        body {
            background: url('240_F_504782581_LHwsDbXlrFiiadWC4i15yV2lhbJnB8g0.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form container */
        .container {
            background: rgba(255, 255, 255, 0.9); /* Transparent background for the form */
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: 0 auto; 
        }

        /* Form heading */
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form input styling */
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Form submit button */
        .form-btn input {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
        }

        .form-btn input:hover {
            background-color: #0056b3;
        }

        /* Style error messages */
        .alert {
            margin-top: 10px;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        /* Style for "Back to Home" link */
        .back-to-home {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-home a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .back-to-home a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>
        <form action="contact.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Your Name:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Your Email:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="subject" placeholder="Subject:">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" rows="5" placeholder="Your Message:"></textarea>
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Send Message" name="submit">
            </div>
        </form>
        <div style="text-align: center; margin-top: 20px;">
            <p><a href="index.php">Back to Home</a></p>
        </div>
    </div>

</body>
</html>
