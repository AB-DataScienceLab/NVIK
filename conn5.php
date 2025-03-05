<?php

// Database connection parameters
$host = 'localhost'; // Hostname or IP
$port = 3306;        // Port number
$username = 'raghav'; // Database username
$password = 'ptm2024'; // Database password
$dbname = 'ptm';     // Database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define table name (using backticks for safety)
$table = '`TABLE 1`';

// Your further operations here
// Example: Check if the table exists
$query = "SHOW TABLES LIKE '$table'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "Table exists.";
} else {
    echo "Table does not exist.";
}

// Close the connection
$conn->close();
?>
