<?php

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN</title>

	<link rel="stylesheet"  href="css/style.css">

		<style>

		@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
		*{
		  margin: 0;
		  padding: 0;
		  outline: none;
		  box-sizing: border-box;
		  font-family: 'Poppins', sans-serif;
		}
		body {
		  font-family: Arial, Helvetica, sans-serif;
		}

		</style>
</head>

<body>
	<div class="container">
		<center><h1>LOGIN</h1>
        <p>Please fill up the form to login the account</p> <hr>
    	</center>

		<form name="LoginForm" method="post" onsubmit="return ValidateForms()">
			<div class="field">
			
			<label for="uname" >Username:</label>
				<input type="text" id="uname" name="Username"
				placeholder="Enter Username">
			</div>
			
			<div class="field">
				
				<label for="pword">Password:</label>
				<input type="text" id="pword" name="Password" 
				placeholder="Enter Password">

			<hr>
     		<p>Don't have an account yet? <a href="registration.php">Register here</a>.</p>
    		<div class="loginbtn">
    			<button type="onsubmit" onclick="ValidateForms()"/>
    				<a href="index.php">LOGIN</a></button>
  			</div>
		</form>

	</div>
</body>
</html>