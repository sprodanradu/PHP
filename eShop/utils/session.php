<?php
function get_session(){
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}

	return $_SESSION;
}

function set_session_param($key, $value){
	get_session();
	$_SESSION[$key] = $value;

	return $_SESSION;
}
function get_session_param($param){
	if (isset($_SESSION[$param])){
		return $_SESSION[$param];
	} else {
		return null;
	}
}
?>