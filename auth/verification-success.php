<?php
require("../templates/template-functions.php");


$title = "Verify";


$content = <<<CONTENT
	<center>
		<a href="../index"><img src="../assets/images/sanroq.png"></a>
		<h1>Account Verified</h1>
		<hr>
	</center>

	<div style="text-align:center">
        <p>We have successfully validated your account!</p>
        <p>Redirecting you to the main page...</p>
    </div>
CONTENT;
?>
<?php include '../templates/auth.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        var verifyForm = document.getElementById("verifyForm");
        setTimeout(function() {
            window.location.href = "../index";
        }, 3000);
    });
</script>