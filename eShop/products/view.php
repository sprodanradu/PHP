<?php
include "../utils/session.php";
include "../utils/products.php";

$product = get_product($_GET['id']);

					foreach ($product['categories'] as $categ) {
						echo $categ . ' ';
					}
				 
		
echo $product['name']."<br>";
echo $product['price']."<br>";
?>