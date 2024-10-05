<?php
session_start();
// Check if user is logged in (optional, depending on your requirements)
if (!isset($_SESSION["user"])) {
    header("Location: login.php"); // Redirect to login if user is not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Review</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Full height of the viewport */
            margin: 0px;
            background-image: url('ss-rating-review-stars.jpg');
            background-size: cover;
            background-position: center;
        }
        .container {
            background-color: #ffffff; 
            border-radius: 8px; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
            padding: 20px; 
            width: 400px; 
            margin: auto; /* Center the container */
            flex-grow: 1; /* Allow the container to grow */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
        }
        footer {
            text-align: center; 
            padding: 10px; 
            background-color: black;
            margin-top: auto; /* Push footer to the bottom */
            width: 100%; /* Full width */
            color: white;
        }
        .social-media img {
            margin: 0 10px; /* Add space between social icons */
        }
        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px; /* Adds space below the heading */
        }
        .form-group {
            margin-bottom: 20px; /* Space between form fields */
        }
        .form-control {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        textarea.form-control {
            height: 150px; /* Adjusts the height of the textarea */
        }
        .form-btn {
            text-align: center;
        }
        .form-btn input {
            width: 100%; /* Makes the button full width */
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            background-color: #007bff;
            border: none;
            color: white;
        }
        .form-btn input:hover {
            background-color: #0056b3; /* Darken the button on hover */
        }
        .back-to-home {
            text-align: center;
            margin-top: 20px;
        }
        .back-to-home a {
            color: #007bff;
            text-decoration: none;
        }
        .back-to-home a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $reviewText = $_POST["review"];
            $errors = array();
            
            // Validation
            if (empty($fullName) || empty($email) || empty($reviewText)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }

            // Display errors
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                // Database insertion
                require_once "database.php";
                $sql = "INSERT INTO reviews (full_name, email, review_text) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $reviewText);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Thank you for your review!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Something went wrong. Please try again later.</div>";
                }
            }
        }
        ?>
        <h2 style="text-align: center; color: #007bff;">Submit Your Review</h2>
        <form action="reviews.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="fullname" placeholder="Full Name:" required>
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="review" placeholder="Your Review:" required></textarea>
            </div>
            <div class="form-btn" style="text-align: center;">
                <input type="submit" class="btn btn-primary" value="Submit Review" name="submit">
            </div>
        </form>
        <div style="text-align: center; margin-top: 20px;">
            <p><a href="index.php">Back to Home</a></p>
        </div>
    </div>


    <footer>
        <p>&copy; 2024 Sports Location Search System. All rights reserved.</p>
        <ul style="list-style: none; padding: 0;">
            <li style="display: inline; margin-right: 15px;"><a href="about.html">About Us</a></li>
            <li style="display: inline; margin-right: 15px;"><a href="privacy.html">Privacy Policy</a></li>
            <li style="display: inline;"><a href="terms.html">Terms of Service</a></li>
        </ul>
        <div class="social-media">
            <a href="#"><img height="30" src="https://pngimg.com/uploads/facebook_logos/facebook_logos_PNG19757.png" alt="Facebook"></a>
            <a href="#"><img height="30" src="https://psfonttk.com/wp-content/uploads/2020/09/Instagram-Logo-PNG.png" alt="Instagram"></a>
            <a href="#"><img height="30" src="https://cdn-icons-png.flaticon.com/512/889/889147.png" alt="Twitter"></a>
        </div>
    </footer>
</body>
</html>
