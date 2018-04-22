<?php
include "../utils/session.php";
//Connection for submit
include "../utils/connection.php";


$conn = get_connection();

$category_id = $_GET['id'];

	if ($_SERVER['REQUEST_METHOD'] == "POST"){ //Check if smt was submitted
		
		$name = $_POST['name'];

		if(isset($_POST['product'])){
			$products_submitted = $_POST['product'];
		}else{
			$products_submitted = array();
		}

		$sql = "UPDATE categories SET name='$name' WHERE id=" . $_GET['id'];		

		if (mysqli_query($conn, $sql)) {

			$sqldeleteproductsfromcateg = "delete from  category_products where category_id = " . $_GET['id'];
			mysqli_query($conn, $sqldeleteproductsfromcateg);


			foreach ($products_submitted as $key => $value) {
				$product_id = $value;
				$sql3 = "INSERT INTO category_products (category_id, product_id) VALUES ($category_id, $product_id)";
				mysqli_query($conn, $sql3); //Execute sql3
			}
			
		} else {
   			 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
	}
?>
<?php
//Connection for select
	$sql2 = "SELECT * FROM PRODUCTS WHERE active = 1";
	$result = mysqli_query($conn, $sql2); //resource

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	    	//each database line goes in array (key => name, price); id = key
	        $products[$row['id']] = array( 
	        	"name" => $row['name'],
	        	"price" => $row['price']
	        );
	    }
	} else {
	    echo "0 results";
	}

?>
<?php
//Connection for select
	$sql2 = "SELECT * FROM categories WHERE id = ".$category_id;
	$result = mysqli_query($conn, $sql2); //resource

	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	    	//each database line goes in array (key => name, price); id = key
	        $category['name'] = $row['name'];
	    }
	} else {
	    echo "0 results";
	}

?>
<?php

//Connection for select
	$sql2 = "SELECT p.id, p.name 
		FROM categories c 
		join category_products cp on cp.category_id = c.id 
		join products p on p.id = cp.product_id 
		WHERE c.id =".$category_id.' and p.active = 1';


	$result = mysqli_query($conn, $sql2); //resource
	
	$category_products = array();
	if (mysqli_num_rows($result) > 0) {
	    // output data of each row
	    while($row = mysqli_fetch_assoc($result)) {
	    	//each database line goes in array (key => name, price); id = key
	        $category_products[] = $row['id'];
	    }
	} else {
	    	
	}

?>
<html>
	<body>
		<form method="POST" action="edit.php?id=<?php echo $category_id; ?>">
			Name <input type="text" name="name" value="<?php echo $category['name']; ?>"><br>
			
			<?php
				foreach ($products as $id => $product) {	
			?>
				<input 
					type="checkbox"  
					name="product[]" 
					<?php if(in_array($id, $category_products)){ echo 'checked'; } ?> 
					value="<?php echo $id; ?>">
					<?php echo $product["name"]; ?><br>
			<?php
				}
			?>
			<input type="submit" name=""><br>
		</form>
	</body>
</html>

<?php
mysqli_close($conn);
?>