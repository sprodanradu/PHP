<?php
include "../utils/session.php";
include "../utils/products.php";

$session = get_session();

if (!get_session_param('basket')){
	set_session_param('basket', array());
}
$basket_products = array();
$total = 0;
$basket = get_session_param('basket');
	foreach ($basket as $key => $value) {
		$product['product'] = get_product($key);
		$product['quantity'] = $value;
		$basket_products[$key] = $product;
		$total = $total + $value * $product['product']['price'];
	}

$basket_count = count(get_session_param('basket'));
?>




<html>
<head>
  <style >
  h1 {
    text-align:center;
    padding-top: 30px;
    color: #192a42;
  }
  div.buttons{
    text-align: right;
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
     a.modify {
    background-color: white;
    border-style: solid;
    border-width: thin;
    border-color: green;
    font-size: 15px;
  }
     input.modify {
    background-color: white;
    border-style: solid;
    border-width: thin;
    border-color: green;
    font-size: 15px;
  }
  button:hover {
    opacity: 0.9;
    background-color: #c7d4e8;
  }
  img:hover {
    opacity: 0.9;
    background-color: #c7d4e8;
  }
  div.products {
    text-align: center;
    
  }
  div.container {
    text-align: center;
    padding: 20px;
  }
  table {
    padding: 40px;
  }
  hr {
    width: 50%;
  }
  </style>
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
				<button alt="Cart" onclick="window.location.href='list.php'"><img src="../img/cart.png"  width="30" height="30"/><span class="badge"><?php echo $basket_count; ?></span></button>
				<?php if (get_session_param('user')){ ?>
					<?php if ($_SESSION['user']['type'] == 1) { ?>
						<button alt="Orders placed" onclick="window.location.href='../users/list.php'"><img src="../img/box.png"  width="30" height="30"/></button>
					<?php } ?>
				<?php } ?>
			</div>
      <h1>Cart</h1>
    </header>
  </div>
  <div class="container">
	<form method="POST" action="basket_update.php">
      <table align="center">

		<?php foreach ($basket_products as $key => $value) { ?>
    <tr>
      <td>
        <div class="products">
         <p><a ><?php echo $value['product']['name']; ?></a>
          <span style="padding-left:120px"></span>
          <a><?php echo $value['product']['price']; ?> RON</a>
          <span style="padding-left:120px"></span>
          <a><input type="text" name="quantity[<?php echo $key; ?>]" value="<?php echo $value['quantity']; ?>"></a>
          <span style="padding-left:120px"></span>
         <a class="modify" type="" onclick="window.location.href='remove_product.php?id=<?php echo $key; ?>'" >Remove product</a></p>
        </div>  

      </td>
    </tr>
    <?php } ?>
    <tr>
    	<td>
    		
    <input class="modify" style="float:right;" type="submit" value="update basket">
    	</td>
    </tr>
  </table>
	</form>
</div>
<hr>

<table align="center">
    <tr>
      <td>
        <div>
         <p>
          <span style="padding-left:300px"></span>
          <a>Total</a>
          <span style="padding-left:140px"></span>
         <a><?php echo $total; ?> RON</a>
        </div>
  </td>
</tr>
  </table>


<div class="cart">
  
    <div class="container">
      <p><button class="modify" type="submit" onclick="window.location.href='../orders/finish_order.php'">Submit order</button>
      <button class="modify" type="button" onclick="window.location.href='../index.php'" class="cancelbtn">Cancel</button></p>
    </div>

  </div>
</body>
</html>