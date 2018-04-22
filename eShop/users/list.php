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

$conn = get_connection();
//Connection for select
$sql_prod = "SELECT * FROM users";
$result = mysqli_query($conn, $sql_prod); //resource
$users = array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$users[] = $row; 
	}
}

$user_types = array(0 => 'normal', 1 => 'administrator');
$user_active = array(0 => 'inactive', 1 => 'active');
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
    border-style: none;
  }
  button.modify {
    background-color: white;
    border-style: solid;
    border-color: green;
    font-size: 15px;
  }
    a.modify {
    background-color: white;
    border-style: solid;
    border-color: green;
    font-size: 15px;
  }
  img:hover {
    opacity: 0.9;
    background-color: #c7d4e8;
  }
  button:hover {
    opacity: 0.9;
    background-color: #c7d4e8;
  }
  div.users {
    text-align: center;
  }
  div.actions {
    padding: 30px;
  }
  hr {
    width: 60%;
  }
  table {
    padding: 40px;
  }
  label {
    padding-left: 50px;
  }
</style>
</head>
	<body>

		  <div>
    <header>
    	      <div class="buttons"> 
        
      </div>
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

				<button alt="Home" onclick="window.location.href='../index.php'"><img src="../img/home.png"  width="30" height="30"/></button>
			</div>
      <h1>Users</h1>
    </header>
  </div>
		

		<table>

			<tr>
				<th style="padding-left:100px">login</th>
				<th style="padding-left:100px">type</th>
				<th style="padding-left:100px">active</th>
				<th style="padding-left:100px"> </th>
			</tr>
			<?php foreach ($users as $user) { ?>
				<tr>
					<td style="padding-left:100px"><?php echo $user['login']; ?></td>
					<td style="padding-left:100px"><?php echo $user_types[$user['type']]; ?></td>
					<td style="padding-left:100px"><?php echo $user_active[$user['active']]; ?></td>
					<td style="padding-left:100px"><a class="modify" href="">edit</a> <a class="modify" href="">deactivate</a><?php ?></td>
				</tr>
			<?php } ?>
<tr><td></td><td></td><td></td><td><a style="float:right;" class="modify" href="/users/add.php">Add users</a></td></tr>
		</table>
		<!-- <a href="/users/list.php">Users</a>
		<a href="/users/list.php">Users</a> -->
	</body>
</html>