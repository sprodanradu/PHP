<?php
include "utils/connection.php";
$host = 'localhost';
$user = 'root';
$password = null;
$database = 'rush';
// Create connection
$con = mysqli_connect($host, $user, $password);
$sql = "CREATE DATABASE rush";
    if (mysqli_query($con, $sql)) {
        echo "Database created successfully\n";
    }
    else
        echo "Error creating database: " . mysqli_error($con);
mysqli_close($con);

$mysqli = mysqli_connect($host, $user, $password, $database);

$query = file_get_contents('db.sql');
$sql_array = explode(';', $query);

foreach ($sql_array as $value) {
	mysqli_query($mysqli, $value);
}


?>