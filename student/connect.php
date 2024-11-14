<?php
$db = mysqli_connect("localhost", "root", "lordkrishna", "library");

if (!$db) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
    echo "Connected successfully to the MySQL database.";
}
?>
