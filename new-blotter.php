<?php
session_start();
if(!isset($_SESSION["id"])) header("Location: login.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Blotter form</title>

    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        * {
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
            <h1>NEW BLOTTER</h1>
            <p>Please fill up the form to file a blotter.</p>
        </center>
        <hr>
        <form name="RegistrationForm" method="post" action="php/functions/blotter/new.php">
            <div style="display: flex; gap:1rem; width:100%">
                <div class="field" style="width: 50%;">
                    <label for="respondent_name"><b>Respondent Full Name:</b></label><br>
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
                <label for="incident_details"><b>Incident Location:</b></label><br>
                <textarea type="text" placeholder="Enter Details of the incident" name="incident_details" id="incident_details" required style="width:100%"></textarea>
            </div>
            <div class="field" style="display: flex; flex-direction: column;">
                <label for="incident_type">Incident Type:</label>
                <select id="incident_type" name="incident_type">
                    <option value="Theft">Theft</option>
                    <option value="Physical Abuse">Physical Abuse</option>
                    <option value="Verbal Abuse">Verbal Abuse</option>
                    <option value="Staffa">Staffa</option>
                </select>
            </div>
            <input type="hidden" value="<?php echo $_SESSION['id'];?>" id="complainant_id" name="complainant_id">
            <div class="field">
                <label for="remarks">Remarks:</label>
                <input type="text" id="remarks" name="remarks" placeholder="Enter Remarks" required>
            </div>
            <?php
            if (isset($_SESSION["errors"])) {
                echo "<ul>";
                foreach ($_SESSION["errors"] as $error) {
                    echo "<li class='error'>{$error}</li>";
                }
                echo "</ul>";
                unset($_SESSION["errors"]);
            }
            ?>
            <hr>
            <p>NOTE: Please make sure that the information you'll enter is accurate and true. Failure to do so may have your submitted blotter to be declined.</p>
            <div class="registbtn">
                <button type="submit" onclick="ValidateForms()" />
                <span>Submit</span>
                </button>
            </div>
        </form>
</body>

</html>