<?php
include "../utils/session.php";
include "../utils/products.php";
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

	update_product($name, $price);

	header('location: /products/edit.php?id='.$_GET['id']);
}

$product = get_product($_GET['id']);

?>
<html>
	<body>
		<form method="POST" action="edit.php?id=<?php echo $_GET['id'] ?>">
			Name<input type="text" name="name" value="<?php echo $product['name']; ?>"><br>
			Price<input type="text" name="price" value="<?php echo $product['price']; ?>"><br>
			<input type="submit" name="">
		</form>
	</body>
</html>

