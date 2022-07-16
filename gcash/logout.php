<?php
	session_start(); //to ensure you are using same session
	session_destroy(); //destroy the session
	header("location: login.php"); //head back to login page after logging out
?>