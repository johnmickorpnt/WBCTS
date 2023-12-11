<?php
require("templates/template-functions.php");
if (!isset($_SESSION["id"])) header("Location: auth/user-login");

$title = "Blotter Website";
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
<form name="RegistrationForm" method="post" action="php/functions/blotter/new.php">
    <div class="field">
        <label for="complainant_name"><b>Complainant name:</b></label><br>
        <input type="text" placeholder="Enter The complainant name" name="complainant_name" id="complainant_name" required>
    </div>    
    <div style="display: flex; gap:1rem; width:100%">
        <div class="field" style="width: 50%;">
            <label for="respondent_name"><b>Respondent/Pinablotter Full Name:</b></label><br>
            <input type="text" placeholder="Enter Name" name="respondent_name" id="respondent_name" required>
        </div>
        <div class="field" style="width: 50%;">
            <label for="respondent_address"><b>Respondent Address:</b></label><br>
            <input type="text" placeholder="Enter Respondent Address" name="respondent_address" id="respondent_address" required>
        </div>
    </div>
    <div class="field">
        <label for="incident_location"><b>Incident Location:</b></label><br>
        <textarea type="text" placeholder="Enter the Location of the Incident" name="incident_location" id="incident_location" required style="width:100%"></textarea>
    </div>
    <div class="field">
        <label for="incident_details"><b>Incident Details:</b></label><br>
        <textarea type="text" placeholder="Enter Details of the Details" name="incident_details" id="incident_details" required style="width:100%"></textarea>
    </div>
    
    <div class="field" style="display: flex; flex-direction: column;">
        <label for="incident_type">Incident Type:</label>
        <select id="incident_type" name="incident_type">
            <option value="Theft">Theft</option>
            <option value="Physical Abuse">Physical Abuse</option>
            <option value="Verbal Abuse">Verbal Abuse</option>
            <option value="Staffa">Staffa</option>
            <option value="other">Other</option>
        </select>
    </div>
    <input type="hidden" value="{$_SESSION['id']}" id="complainant_id" name="complainant_id">
    <div class="field">
        <label for="remarks">Remarks:</label>
        <input type="text" id="remarks" name="remarks" placeholder="Enter Remarks" required>
    </div>
    {$errors}
    <hr>
    <p>NOTE: Please make sure that the information you'll enter is accurate and true. Failure to do so may have your submitted blotter to be declined.</p>
    <div class="registbtn">
        <button type="submit" onclick="ValidateForms()" />
        <span>Submit</span>
        </button>
    </div>
</form>
CONTENT;
?>
<?php include 'templates/auth.php'; ?>

