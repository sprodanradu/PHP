<?php
include "../utils/session.php";
include "../utils/connection.php";

$session = get_session();
$user = get_session_param('user');

if(!isset($user)){
	header("location: ../index.php");
}

if($user['type'] != 1){
	header("location: ../index.php");	
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){ //Check if smt was submitted
	$name = $_POST['name'];
	$price = $_POST['price'];
	add_product($name, $price);
}

?>

<html>
	<body>
		<form method="POST" action="add.php">
			Name<input type="text" name="name"><br>
			Price<input type="text" name="price"><br>
			<input type="submit" name="">
		</form>
	</body>
</html>