<?php
include "../utils/session.php";
//Connection for submit
include "../utils/connection.php";
	$conn = get_connection();
	if ($_SERVER['REQUEST_METHOD'] == "POST"){ //Check if smt was submitted
		$name = $_POST['name'];
		$products_submitted = $_POST['product'];

		$sql = "INSERT INTO categories (name) VALUES ('$name')";
		
		if (mysqli_query($conn, $sql)) {
			$category_id = mysqli_insert_id($conn);
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
<html>
	<body>
		<form method="POST" action="add.php">
			Name<input type="text" name="name"><br>
			
			<?php
				foreach ($products as $id => $product) {	
			?>
			<input type="checkbox" name="product[]" value="<?php echo $id; ?>"><?php echo $product["name"]; ?><br>
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