<?php
	//connecting to database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$databasename = "gcash";

	//your login credential
	$loginpassword = "elaiimyours";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $databasename);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
?>