<?php
require("../templates/template-functions.php");


$title = "Registration";
$errors = "";
if (isset($_SESSION["errors"])) {
    $errors .= "<ul>";
    foreach ($_SESSION["errors"] as $error) {
        $errors .= "<li class='error'>{$error}</li>";
    }
    $errors .= "</ul>";
    unset($_SESSION["errors"]);
}

$content = <<<CONTENT
  <center>
		<a href="../index"><img src="../assets/images/sanroq.png"></a>
    <h1>REGISTRATION</h1>
    <p>Please fill up the form to have an account</p>
  </center>
  <hr>
  <form name="RegistrationForm" method="post" action="../php/functions/auth/register.php">
    <div style="display: flex; gap:1rem; width:100%">
      <div class="field" style="width: 50%;">
        <label for="fname"><b>First Name:</b></label><br>
        <input type="text" placeholder="Enter First Name" name="fname" id="fname" required>
      </div>
      <div class="field" style="width: 50%;">
        <label for="lname"><b>Last Name:</b></label><br>
        <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>
      </div>
    </div>
    <div class="field">
      <label for="email"><b>Email:</b></label><br>
      <input type="email" placeholder="Enter Email" name="email" id="email" required>
    </div>
    <div style="display: flex; gap:1rem">
      <div class="field" style="width: 50%;">
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" placeholder="Enter Contact Number" required min="8">
      </div>
      <div class="field" style="width: 50%;">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" placeholder="Enter Address" required>
      </div>
    </div>
    <div class="field">
      <label for="pass"><b>Password:</b></label><br>
      <input type="password" placeholder="Enter Password" name="pass" id="pass" required>
    </div>
    <div class="field">
      <label for="conpass"><b>Confirm Password:</b></label><br>
      <input type="password" placeholder="Confirm Password" name="conpass" id="conpass" required>
    </div>
    {$errors}
    <hr>
    <p>Already have an account? <a href="user-login">Sign in here</a>.</p>
    <div class="registbtn">
      <button type="submit" onclick="ValidateForms()" />
      <span>Register</span>
      </button>
    </div>
  </form>
  <script type="text/javascript">
  function ValidateForms() {
    if (document.getElementById("username").value == "") {
      alert("Username cannot be blank");

    }
    if (document.getElementById("password").value == "") {
      alert("Password cannot be blank");

    }
    if (document.getElementById("email").value == "") {
      alert("Email cannot be blank");
    }
  }
  </script>
CONTENT;
?>
<?php include '../templates/auth.php'; ?>