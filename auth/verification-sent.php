<?php
require("../templates/template-functions.php");


$title = "Verify";


$content = <<<CONTENT
	<center>
		<a href="../index"><img src="../assets/images/sanroq.png"></a>
		<h1>Verification Sent</h1>
		<hr>
	</center>

	<div>
        <h4>Email Verification Sent!</h4>
        <p>Thank you for signing up!</p>
        <p>We've just sent a verification email to the address you provided. To complete your registration and start exploring our services, please check your inbox and click on the verification link.</p>
        
        <h4>Didn't receive the email?</h4>
        <ul>
            <li>Check your spam or junk folder. Sometimes emails can end up there.</li>
            <li>Ensure your email address is correct. If you think you might have made a typo, you can go back and resubmit your email address.</li>
            <li>Give it a few minutes. Sometimes email delivery can be delayed.</li>
            <li>Still having trouble? Contact our support team at support@yourdomain.com for assistance.</li>
        </ul>
        
        <h4>Welcome aboard, and we look forward to having you with us!</h4>
    </div>
CONTENT;
?>
<?php include '../templates/auth.php'; ?>