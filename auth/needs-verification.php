<?php
require("../templates/template-functions.php");
if (isset($_SESSION["verified"])) 
    if($_SESSION["verified"]) header("Location: ../index");


$title = "Needs Verification";


$content = <<<CONTENT
    {$_SESSION['verified']}
	<center>
		<a href="../index"><img src="../assets/images/sanroq.png"></a>
		<h1>Verification Needed</h1>
		<hr>
	</center>

	<div>
        <h2>Welcome to San Roque Blotter System,</h2>

        <p>Thank you for signing up with us! We're excited to have you on board.</p>
        
        <div style="margin:2rem">
            <h4>Account Verification is Required. </h4>
            
            <p>To ensure the security of your account, we require you to verify your email address. Please check your email inbox (and spam folder, just in case) for a verification link that we've sent to the address you provided during registration.</p>
        </div>
        
        <div style="margin:2rem">
            <h4>Why Verify Your Email?</h4>
            
            <ul>
                <li>Security: Verifying your email helps us ensure that your account is only accessible by you.</li>
                <li>Communication: We'll keep you updated on important account activities and promotions.</li>
                <li>Account Recovery: It will help you regain access to your account in case you forget your password or encounter any issues.</li>
            </ul>
        </div>

        <div style="margin:2rem">
            <h4>How to Verify</h4>
            
            Check your email for a message from San Roque Blotter System.
            Click on the verification link provided in the email.
            You will be redirected to San Roque Blotter System to confirm your email.
        </div>    
        <button class="btn" onclick="submitValidation()">Click here to Re-send verification Link</button>
        <form id="createValidation" method="POST" action="../php/functions/auth/create-verification.php">
            <input type="hidden" value="{$_SESSION["id"]}" name="user_id">
        </form>
    </div>
CONTENT;
?>
<?php include '../templates/auth.php'; ?>
<script>
    function submitValidation(){
        let form = document.getElementById("createValidation");
        form.submit();
    }
</script>