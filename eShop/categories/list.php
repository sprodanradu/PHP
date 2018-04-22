<?php
include "../utils/session.php";
include "../utils/connection.php";

$conn = get_connection();

$sql = "SELECT * FROM categories WHERE active = 1";
$result = mysqli_query($conn, $sql); //resource

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    	//each database line goes in array (key => name, price); id = key
        $categories[$row['id']] = array( 
        	"name" => $row['name']
        	
        );
    }
} else {
    $products = array();
}

mysqli_close($conn);
	
?>
<?php
	foreach ($categories as $id => $category) {	
?>
<?php 
echo $category['name'];
?>
<a href="edit.php?id=<?php echo $id; ?>">View</a>
<a href="remove.php?id=<?php echo $id; ?>">Remove</a><br>

<?php
	}
?>