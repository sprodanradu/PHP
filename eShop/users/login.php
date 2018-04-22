<?php
include "../utils/session.php";
include "../utils/connection.php";

$session = get_session();

$conn = get_connection();
$passwd = hash('whirlpool', $_POST['passwd']);
$login = $_POST['login'];

$sql = "SELECT * FROM users WHERE login='$login' and passwd='$passwd' ";
$result = mysqli_query($conn, $sql); //resource

if (mysqli_num_rows($result) > 0) {
	//Add user to session
	while($row = mysqli_fetch_assoc($result)) {
        $user = array( 
        	"id" => $row['id'],
        	"login" => $row['login'],
        	"active" => $row['active'],
            'type'=> $row['type']
        );
    }
    if ($user['active'] == 0){
    	echo "User innactive";
    } else {
       set_session_param('user', $user);
	   header('location: ../index.php');
    }
} else {
    header('location: /users/login.html');
    // echo "Wrong password or username";
}

mysqli_close($conn);

?>