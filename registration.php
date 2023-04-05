<?php
session_start();
	
	include("connection.php");
	include("function.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";
			mysqli_query($query);

			header("Location: login.php");
			die;

		}else{
			echo "Please enter valid information!";
		}
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Registration form</title>

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
    <center>
      <h1>REGISTRATION</h1>
        <p>Please fill up the form to have an account</p>
    </center>
    <hr>
    <form name="RegistrationForm" method="post" onsubmit="return ValidateForms()">
    <div class="field">
        
       <label for="username"><b>Username:</b></label><br>
        <input type="text" placeholder="Enter Username" name="username" id="username">
    </div>

    <div class="field">

    <label for="password"><b>Password:</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" id="password" >
    </div>

    <label for="email"><b>Email:</b></label><br>
    <input type="email" placeholder="Enter Email" name="email" id="email" >

    <hr>
     <p>Already have an account? <a href="login.php">Sign in here</a>.</p>
    <div class="registbtn">
    <button type="onsubmit" onclick="ValidateForms()"/>
    <a href="home.html">Register</a></button>
  </div>
  </form>
<script type="text/javascript">

function ValidateForms()
{
  if(document.getElementById("username").value=="")
  {
    alert("Username cannot be blank");
 
  }
  if(document.getElementById("password").value=="")
  {
    alert("Password cannot be blank");
  
  }
  if(document.getElementById("email").value=="")
  {
    alert("Email cannot be blank"); 
  } 
}
</script>
</body>
</html>
