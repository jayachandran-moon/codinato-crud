<?php
// Create connection
$conn = new mysqli('localhost','root','','indexfirstdatabase');

// Check connection
if ($conn->connect_error) {
    die("Connection error: " . mysqli_connect_error());
}
$conn->close();
?>