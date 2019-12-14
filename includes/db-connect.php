<?php
//Cloud Database
$servername = "remotemysql.com";
$username = "kU6ajKdO3G";
$password = "o9Tacx9tYh";
$dbname="kU6ajKdO3G";
//Localhost
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname="iot";


// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
