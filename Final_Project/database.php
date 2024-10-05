<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "sgp-sports_location_search_database";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>