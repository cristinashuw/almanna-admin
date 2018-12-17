<?php
include "koneksi.php";
session_start();
if (isset($_SESSION['username'])){
header ("");
}
?>
<!D0CTYPE html>
<html>
	<head>
		<title> Log In </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
		<div class = "container">
			<img src="images/icon.png">
			<form method="post" name="login" action="cek_login.php">
				<div class="form-input">
					<input type="text" name="username" placeholder="Enter Username">
				</div>
			
				<div class="form-input">
					<input type="password" name="password" placeholder="Enter Password">
				</div>
				
				<input type="submit" name="submit" value="LOGIN" class="btn-login">
				<br>
				
			</form>
		</div>
	</body>

</html>