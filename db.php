<?php
session_start();
// Database configuration 
$host = "localhost";
$db_name = "code-practice";
$db_user = "root";
$db_password = "admin@12345";

// For Global Date Format
$date_format = "m-d-Y H:i:s";

// For Notification message
$msg = "";
if(isset($_REQUEST['msg'])){
    $msg = $_REQUEST['msg'];
}

// For Debugging purpose
$debug = false;

// Create connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if($debug) {
    echo "<br/>" . "Database connect successfully"; 
}

?>