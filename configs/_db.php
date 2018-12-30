<?php
session_start();
error_reporting(0);
// DECLARATION OF SESSIONS
$_SESSION['not_logged'];
$_SESSION['logged'];
$_SESSION['admin'];
// DATABASE CONF
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

?>