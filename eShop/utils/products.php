<?php
include "connection.php";

function get_product($id){
	$conn = get_connection();

	$sql = "SELECT * FROM PRODUCTS WHERE id =" . $id;
	$result = mysqli_query($conn, $sql); //resource

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	        $product['id'] = $row['id'];
	        $product['name'] = $row['name'];
	        $product['price'] = $row['price'];

	        $categs = array();	
			$q_categ = "SELECT c.name from categories c join category_products cp on cp.category_id = c.id  where cp.product_id = ".$row['id'];
			$resultc = mysqli_query($conn, $q_categ); 
			if (mysqli_num_rows($resultc) > 0) {
			    while($rowc = mysqli_fetch_assoc($resultc)) {
			    	$categs[] = $rowc['name']; 
			    }
			}
	    	//each database line goes in array (key => name, price); id = key
	        $product['categories'] = $categs;
	    }
	} else {
	    $product = null; //errrrrorrr
	}

	mysqli_close($conn);

	return $product;
}

function get_products(){
	$conn = get_connection();
	//Connection for select
	$sql_prod = "SELECT p.id, p.name, p.price FROM products p where p.active = 1";
	$result = mysqli_query($conn, $sql_prod); //resource

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($rowp = mysqli_fetch_assoc($result)) {
	    	$categs = array();	
			$q_categ = "SELECT c.name from categories c join category_products cp on cp.category_id = c.id  where cp.product_id = ".$rowp['id'];
			$resultc = mysqli_query($conn, $q_categ); 
			if (mysqli_num_rows($resultc) > 0) {
			    while($row = mysqli_fetch_assoc($resultc)) {
			    	$categs[] = $row['name']; 
			    }
			}
	    	//each database line goes in array (key => name, price); id = key
	        $products[$rowp['id']] = array( 
	        	"name" => $rowp['name'],
	        	"price" => $rowp['price'], 
	        	'categories' => $categs
	        );
	    }
	} else {
	    $products = array();
	}

	mysqli_close($conn);

	return $products;
}

function add_product($name, $pice){
	$conn = get_connection();
	$sql = "INSERT INTO products (name, price) VALUES ('$name', $price)";
	if (mysqli_query($conn, $sql)) {
		$success = true;
	} else {
		$success = false;
	}

	mysqli_close($conn);

	return $success;
}

function update_product($name, $price, $active = 1){

	$sql = "UPDATE products SET name='$name', price=$price, active = $active WHERE id=" . $_GET['id'];
	
	if (mysqli_query($conn, $sql)) {
		$success = true;
	} else {
		$success = false;
	}

	mysqli_close($conn);

	return $success;
}


?>