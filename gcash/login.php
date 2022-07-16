<?php
	require "mysqlconnection.php";
	session_start();
	if(!isset($_SESSION['loggedin'])){
		$_SESSION['loggedin'] = "";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
</head>
<body>
	<h2>sign in</h2>
	<form action="login.php" method="POST">
		<input type="password" placeholder="Password" name="pass" autofocus>
		<input type="submit" name="login" value="Log in">
	</form>

	<?php
		//if the log in button is clicked and the password field is not empty, verify the credentials
		if(isset($_POST['login']) && $_POST['pass'] != ""){
			$password = $_POST['pass'];

			//the $loginpass variable here can found at myqlconnection.php and can be accessed her since it is imported from the very start of this code
			if($password == $loginpassword){
				//if passwords matched
				$_SESSION['loggedin'] = $password;
				//now head back to homepage where the records can now be viewed
				header("Location: index.php");
			}else{
				echo "<p style='color:red'>incorrect password</p>";	
			}
		}else{
			echo "<p style='color:red'>please log in first</p>";
		}
	?>
</body>
</html>