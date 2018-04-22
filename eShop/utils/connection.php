<?php

function get_connection(){
	$servername = "localhost";
	$username = "root";
	$password = null;
	$dbname = "eshop";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	return $conn;
}

function close_connection($conn){
	mysqli_close($conn);
}
?>