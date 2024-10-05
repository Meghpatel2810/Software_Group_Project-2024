<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Location Search System</title>
    <link rel="stylesheet" href="styles.css">
</head>

<style>
    html, body {
        height: 100%; /* Ensure the body has full height */
    }
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-image: url('845d0a64bb540464866f85eb64dbf6cd.jpg') !important;; /* Update with your image path */
        background-size: cover; /* Cover the entire page */
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Prevent the image from repeating */
        min-height: 100vh;
        
    }
    header {
        background-color: #333;
        padding: 20px;
        color: white;
    }
    header h1 {
        margin: 0;
        font-size: 24px;
    }
    nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        justify-content: flex-end;
    }
    nav ul li {
        margin-left: 20px;
    }
    nav ul li a {
        color: white;
        text-decoration: none;
    }
    .hero {
        background-color: #4CAF50; 
        color: black;
        padding: 50px;
        text-align: center;
    }
    .hero h2 {
        margin-bottom: 10px;
        font-size: 36px;
    }
    .search-bar {
        margin-top: 20px;
    }
    .search-bar input {
        padding: 10px;
        width: 300px;
        font-size: 16px;
    }
    .search-bar a {
        background-color: #FF5733;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        font-size: 16px;
        margin-left: 10px;
    }
    .featured {
        padding: 50px;
        background-color: white;
    }
    .featured h3 {
        text-align: center;
        font-size: 28px;
    }
    .facility-cards {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }
    .facility-card {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px;
        width: 450px;
        text-align: center;
    }
    .facility-card img {
        width: 100%;
        height: auto;
    }
    .how-it-works {
        padding: 50px;
        background-color: #eee;
        text-align: center;
    }
    .steps {
        display: flex;
        justify-content: space-around;
    }
    .step {
        text-align: center;
        padding: 20px;
    }
    .testimonial-slider {
        text-align: center;
        padding: 50px;
    }
    .testimonial {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 10px auto;
        width: 70%;
    }
    footer {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 20px;
        margin-top: 50px;
    }
    footer ul {
        list-style: none;
        padding: 0;
    }
    footer ul li {
        display: inline;
        margin: 0 10px;
    }
    footer ul li a {
        color: white;
        text-decoration: none;
    }
    .social-media img {
        height: 30px;
        margin: 10px;
    }
</style>

<body>

    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>Sports Location Search</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="search.html">Search</a></li>
                <li><a href="favorites.html">Favorites</a></li>
                <li><a href="reviews.php">Reviews</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="booking.php">Booking</a></li>
                <li><a href="logout.php" class="btn btn-warning">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Find the Perfect Sports Facility Near You!</h2>
            <p>Search from hundreds of locations and venues for your favorite sports.</p>
            <div class="search-bar">
                <input type="text" placeholder="Enter sport or location...">
                <a href="search.html">Find Now</a>
            </div>
        </div>
    </section>

    <!-- Featured Facilities Section -->
    <section class="featured">
        <h3>Popular Sports Facilities</h3>
        <div class="facility-cards">
            <div class="facility-card">
                <img src="WhatsApp Image 2024-09-12 at 20.26.21_a371dad8.jpg" alt="Tennis Court Downtown" width="250" height="250px">
                <h4>Tennis Court Downtown</h4>
                <p>Best tennis courts in downtown area.</p>
                <p>Rating: ★★★★☆</p>
                <a href="https://www.bookmyplayer.com/table-tennis/bal-bhavan-tennis-academy-vadodara-aid-26538">View Details</a>
            </div>
            <div class="facility-card">
                <img src="WhatsApp Image 2024-09-12 at 20.27.39_934e1354.jpg" alt="Olympic Swimming Pool" width="250" height="250px">
                <h4>Olympic Swimming Pool</h4>
                <p>State-of-the-art swimming facility.</p>
                <p>Rating: ★★★★★</p>
                <a href="https://vmc.gov.in/SwimmingPool.aspx">View Details</a>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <h3>How It Works</h3>
        <div class="steps">
            <div class="step">
                <img src="3435091.png" alt="Search" width="450" height="450px">
                <h4>Search</h4>
                <p>Find sports facilities by location or activity.</p>
                <a href="search.html">Search</a>
            </div>
            <div class="step">
                <img src="16108391.png" alt="Filter" width="450" height="450px">
                <h4>Filter & Compare</h4>
                <p>Narrow down based on amenities, distance, and reviews.</p>
                <a href="filter.php">Filter Locations</a>
                <br>
                <br>
                <a href="home.php">Get Locations</a>
            </div>
            <div class="step">
                <img src="WhatsApp Image 2024-09-12 at 20.40.19_8f0f53a2.png" alt="Visit" width="450" height="450px">
                <h4>Visit</h4>
                <p>Get directions and go play!</p>
                <a href="visit.html">Visit Locations</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <p style="text-align: center;  font-weight:bold;">What Users Are Saying</p>
        <div class="testimonial-slider">
            <div class="testimonial">
                <p>"This platform made it so easy to find great basketball courts near me!" - Nisarg Patel</p>
            </div>
            <div class="testimonial">
                <p>"I love the reviews and easy-to-use search. It’s my go-to for finding sports venues." - Megh Patel</p>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 Sports Location Search System. All rights reserved.</p>
        <ul>
            <li><a href="about.html">About Us</a></li>
            <li><a href="privacy.html">Privacy Policy</a></li>
            <li><a href="terms.html">Terms of Service</a></li>
        </ul>
        <div class="social-media">
            <a href="#"><img height="30" src="https://pngimg.com/uploads/facebook_logos/facebook_logos_PNG19757.png"></a>
            <a href="#"><img height="30" src="https://psfonttk.com/wp-content/uploads/2020/09/Instagram-Logo-PNG.png"></a>
            <a href="#"><img height="30" src="https://cdn-icons-png.flaticon.com/512/889/889147.png"></a>
        </div>
    </footer>

</body>
</html>
