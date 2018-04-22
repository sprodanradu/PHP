<?php
include "../utils/session.php";
include "../utils/connection.php";

$session = get_session();
session_destroy();
header("location: ../index.php");

?>