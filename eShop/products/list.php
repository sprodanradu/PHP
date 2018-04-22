<?php
include "../utils/session.php";
include "../utils/connection.php";

$conn = get_connection();

$sql = "SELECT * FROM PRODUCTS WHERE active = 1";
$result = mysqli_query($conn, $sql); //resource

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
    $products = array();
}

mysqli_close($conn);
	
?>
<?php
	foreach ($products as $id => $product) {	
?>
<?php 
echo $product['name'];
?>
<a href="view.php?id=<?php echo $id; ?>">View</a>
<a href="edit.php?id=<?php echo $id; ?>">Edit</a>
<a href="../basket/add_to_basket.php?id=<?php echo $id; ?>">Add to basket</a><br>
<?php
	}
?>