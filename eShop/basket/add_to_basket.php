<?php
include "../utils/session.php";
include "../utils/connection.php";

$session = get_session();

if (!get_session_param('basket')){
	set_session_param('basket', array());
}

$basket = get_session_param('basket');
$id = $_GET['id'];

if (!isset($basket[$id])){
	$basket[$id] = 1;
	set_session_param('basket', $basket);
}
header("location: ../index.php");
?>