<?php
include "../utils/session.php";
include "../utils/connection.php";
$session = get_session();
$basket = get_session_param('basket');
$user = get_session_param('user');
$user_id = $user['id'];

$conn = get_connection();
		


foreach ($basket as $key => $value) {
	
	$sql = "INSERT INTO orders (user_id) VALUES ('$user_id')";
	mysqli_query($conn, $sql);
	$order_id = mysqli_insert_id($conn);

	foreach ($basket as $key => $value) {
		$product_id = $value;
		$sql3 = "INSERT INTO order_lines (order_id, product_id, quantity) VALUES ($order_id, $key, $value)";
		mysqli_query($conn, $sql3); //Execute sql3
	}

}
set_session_param('basket', array());

mysqli_close($conn);
header('location: ../index.php');
?>