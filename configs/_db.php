<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clity";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Succesfully Connected";
}
session_start();
?>