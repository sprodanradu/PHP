<?php
include "../utils/session.php";
include "../utils/connection.php";

$session = get_session();

if(!get_session_param('user')){
	header('location: /users/login.html');
}

	if ($_SERVER['REQUEST_METHOD'] == "POST"){ //Check if smt was submitted
		$basket = get_session_param('basket');
		$quantities = $_POST['quantity'];

		set_session_param('basket', $quantities);

		header("location: list.php");
	}



?>