<?php
include "../utils/session.php";
//Connection for submit
include "../utils/connection.php";

$product_id = $_GET['id'];
$session = get_session();

$basket = get_session_param('basket');


if (isset($basket[$product_id])){
	unset($basket[$product_id]);

	set_session_param('basket', $basket);
}
header("location: list.php");

?>