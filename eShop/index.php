<?php
include "utils/session.php";
include "utils/products.php";

$session = get_session();

$products = get_products();
$basket_count = count(get_session_param('basket'));

// die();

?>
<!-- <html>
	<body>

		<?php if (!get_session_param('user')){ ?>
			<a href="/users/login.html">Login</a>
			<a href="/users/register.html">Register</a>
		<?php 
			} else { 
				echo $_SESSION['user']['login'];
		?>
			<a href="users/logout.php">Logout</a>
			<br>
		<?php } ?>
		<?php foreach ($products as $id => $product) { ?>
			<div>
				<?php echo $product['name'];  ?><br>
				<?php
					foreach ($product['categories'] as $categ) {
						echo $categ . ' ';
					}
				 ?>
				 <br>
				<?php echo $product['price'];  ?><br>

				<a href="../basket/add_to_basket.php?id=<?php echo $id; ?>">Add to basket</a><br>
			</div>

		<?php } ?>

	</body>
</html> -->

<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
	<style>
	h1 {
		text-align:center;
		padding-top: 30px;
		color: #192a42;
	}
	button {
		background-color: white;
		border: none;
	}
	button.modify {
		background-color: white;
		border-style: solid;
		border-width: thin;
		border-color: green;
		font-size: 15px;
	}
	button:hover {
		background-color: #c7d4e8;
	}

	img:hover {
		opacity: 0.9;
		background-color: #c7d4e8;
	}

	div.buttons{
		text-align: right;
	}
	span.badge {
		border-style: solid;
		border-color: red;
		border-width: thin;
		border-radius: 50%;
	}
	td.product {
		padding: 60px;
	}
</style>
<title>Minishop</title>
<link />
</head>
<body>
	<div>
		<header>
			<div class="buttons"> 
				<?php if (!get_session_param('user')){ ?>
				<button onclick="window.location.href='/users/login.html'" style="width:auto; font-size: 20px"><sup>Login</sup></button> 
				<button onclick="window.location.href='/users/register.html'" style="width:auto; font-size: 20px"><sup>Register</sup></button> 
				<?php } else { 
				echo "<sup>".$_SESSION['user']['login']."</sup>";
				?>
				<button onclick="window.location.href='users/logout.php'" style="width:auto; font-size: 20px"><sup>Logout</sup></button> 
				<?php } ?>
				<button alt="Cart" onclick="window.location.href='basket/list.php'"><img src="img/cart.png"  width="30" height="30"/><span class="badge"><?php echo $basket_count; ?></span></button>
				<?php if (get_session_param('user')){ ?>
					<?php if ($_SESSION['user']['type'] == 1) { ?>
						<button alt="Orders placed" onclick="window.location.href='users/list.php'"><img src="img/box.png"  width="30" height="30"/></button>
					<?php } ?>
				<?php } ?>
			</div>
			<h1>Rush</h1>
		</header>
	</div>

	<!-- <div class="dropdown" >
		<button class="dropbtn"; style=" 
		padding: 16px;
		font-size: 16px;
		border: none;
		cursor: pointer;" 
		>Categories</button>
		<div class="dropdown-content">
			<a href="#">A</a>
			<a href="#">B</a>
			<a href="#">C</a>
		</div>
	</div> -->
	<table align="center">
		
		<tr>
			<?php foreach ($products as $id => $product) { ?>
			<td class="product"><p><img src="img/p1.jpeg"/></p>
				<div style="text-align: center;">
					<a><?php echo $product['name'];  ?></a></br>
					<a class="product"><?php echo $product['price'];  ?> lei</a>
					<p>
						<button class="modify" onclick="window.location.href='basket/add_to_basket.php?id=<?php echo $id;  ?>'">
							Add to cart
						</button>
					</p>
				</div>	
			</td>
			<?php } ?>
		</tr>
		
	</table>
</body>
</html>

