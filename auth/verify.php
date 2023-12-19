<?php
require("../templates/template-functions.php");


$title = "Verify";


$content = <<<CONTENT
	<center>
		<a href="../index"><img src="../assets/images/sanroq.png"></a>
		<h1>Verify</h1>
		<hr>
	</center>

	<div>
        Please wait while we validate your account...
        <form id="verifyForm" method="post" action="../php/functions/auth/verify.php">
            <input id="id" name="id" value={$_GET["id"]} type="hidden">
            <input id="token" name="token" value={$_GET["token"]} type="hidden">
        </form>
    </div>
CONTENT;
?>
<?php include '../templates/auth.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        var verifyForm = document.getElementById("verifyForm");
        setTimeout(function() {
            verifyForm.submit();
        }, 3000);
    });
</script>