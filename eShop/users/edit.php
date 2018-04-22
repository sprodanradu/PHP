<?php
include "../utils/session.php";
include "../utils/connection.php";

	if ($_SERVER['REQUEST_METHOD'] == "POST"){ //Check if smt was submitted
		$login = $_POST['login'];
		$plain_passwd = $_POST['passwd'];
		$type = $_POST['type'];
		$passwd = hash('whirlpool', $plain_passwd);

		$conn = get_connection();

		$sql = "INSERT INTO users (login, passwd, type) VALUES ('$login', '$passwd', $type)";
		
		if (mysqli_query($conn, $sql)) {
    		
		} else {
   			 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		mysqli_close($conn);
	}
?>

<html>
	<body>
		<form method="POST" action="add.php">
			Username<input type="text" name="login" value=""><br>
			Password<input type="text" name="passwd" value=""><br>
			Type
			<select name="type" >
				<option value="0">normal</option>	
				<option value="1">admin</option>	
			</select>
			<br>
			<input type="submit" name="">
		</form>
	</body>
</html>