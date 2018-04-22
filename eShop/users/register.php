<?php
include "../utils/session.php";
include "../utils/connection.php";

	if ($_SERVER['REQUEST_METHOD'] == "POST"){ //Check if smt was submitted
		$login = $_POST['login'];
		$plain_passwd = $_POST['passwd'];
		$passwd = hash('whirlpool', $plain_passwd);

		$conn = get_connection();

		$sql = "INSERT INTO users (login, passwd) VALUES ('$login', '$passwd')";
		
		if (mysqli_query($conn, $sql)) {
    		
		} else {
   			 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>