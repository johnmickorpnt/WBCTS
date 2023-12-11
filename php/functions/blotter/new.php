<?php
require_once "../../phpqrcode/qrlib.php";


session_start();
header('Content-Type: application/json; charset=utf-8');
require_once "../../config/Database.php";
require_once "../../models/Blotter.php";
require_once "../../models/User.php";

require '../../../vendor/autoload.php';

require_once "../../phpqrcode/qrlib.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$valid = array();
$_SESSION["msg"] = array();
$_SESSION["errors"] = array();
$errors = array();
$response = array();

$database = new Database();
$db = $database->connect();
$blotter = new Blotter($db);
$user = new User($db);

$_SESSION["msg"] = array();

$complainant_id = $_POST['complainant_id'] ?? "";
$respondent_name = $_POST['respondent_name'] ?? "";
$respondent_address = $_POST['respondent_address'] ?? "";
$incident_location = $_POST['incident_location'] ?? "";
$incident_details = $_POST['incident_details'] ?? "";
$incident_type = $_POST['incident_type'] ?? "";
$investigating_officer = $_POST['investigating_officer'] ?? "";
$complainant_name = $_POST['complainant_name'] ?? "";


$remarks = $_POST['remarks'] ?? "";

if (empty($complainant_id)) {
    $valid[0] = false;
    array_push($_SESSION["errors"], "Please login first before filing a blotter.");
} else $valid[0] = true;

if (empty($respondent_name)) {
    $valid[1] = false;
    array_push($_SESSION["errors"], "The respondent's name is required");
} else $valid[1] = true;

if (empty($respondent_address)) {
    $valid[2] = false;
    array_push($_SESSION["errors"], "Respondent Address is missing");
} else $valid[2] = true;

if (empty($incident_location)) {
    $valid[3] = false;
    array_push($_SESSION["errors"], "Incident Location Missing");
} else $valid[3] = true;

if (empty($incident_details)) {
    array_push($_SESSION["errors"], "Incident details missing");
    $valid[4] = false;
} else $valid[4] = true;

if (empty($incident_type)) {
    $valid[5] = false;
    array_push($_SESSION["errors"], "Incident type missing");
} else $valid[5] = true;

if (empty($remarks)) {
    $valid[6] = false;
    array_push($_SESSION["errors"], "Remarks is missing.");
} else $valid[6] = true;

if (empty($complainant_name)) {
    $valid[7] = false;
    array_push($_SESSION["errors"], "Complainant name is missing.");
} else $valid[7] = true;

if (in_array(false, $valid)) {
    http_response_code(422);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
$timestamp = time(); // Get current timestamp
$outputFile = '../../../assets/qrcode' . $timestamp . ".png";

$blotter->setComplainant_id($complainant_id);
$blotter->setRespondent_name($respondent_name);
$blotter->setRespondent_address($respondent_address);
$blotter->setIncident_location($incident_location);
$blotter->setIncident_details($incident_details);
$blotter->setIncident_type($incident_type);
$blotter->setRemarks($remarks);
$blotter->setQrCode($outputFile);
$blotter->setIs_archived(false);
$blotter->setComplainant_name($complainant_name);


$userRes = $user->read($complainant_id);
$userData = $userRes->fetch(PDO::FETCH_ASSOC);
$result = $blotter->save();

if ($result) {
    $lastInsertedId = $db->lastInsertId();

    // Generate QR code using the last inserted ID
    $qrCodeData = 'Blotter ID: ' . $lastInsertedId;

    $qrCodeOptions = [
        'errorCorrectionLevel' => 'L',
        'margin' => 4,
        'size' => 300
    ];

    // Construct the URL with query parameters
    $nextPageUrl = '../../../generate-qr-code.php' . '?blotterData=' . urlencode(json_encode($qrCodeData)) . '&qrCodeOptions=' . urlencode(json_encode($qrCodeOptions));



    // QR code options
    $ecc = QR_ECLEVEL_L; // Error correction level: L (Low), M, Q, H (High)
    $size = 10; // Size of the QR code modules
    $margin = 4; // Margin around the QR code

    // Generate QR code
    QRcode::png($qrCodeData, $outputFile, $ecc, $size, $margin);

    $mail = new PHPMailer(true);
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication


    $mail->Username = 'blotter.wbcts.project@gmail.com';
    $mail->Password = 'ouynrinftcjzpmdf';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->setFrom('blotter.wbcts.project@gmail.com', "WBCTS Blotter System");
    $mail->addAddress($userData["email"]);
    $mail->isHTML(true);
    $mail->Subject = "Your Blotter Report Has been Received";

    $mail->Body = <<<MSG
            <table class="table table-striped" style="width:100%">
                <thead>
                    <th>Blotter Information</th>
                    <th>Details</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Blotter Number</td>
                        <td>{$complainant_id}</td>
                    </tr>
                    <tr>
                        <td>Respondent Name</td>
                        <td>{$respondent_name}</td>
                    </tr>
                    <tr>
                        <td>Respondent Address</td>
                        <td>{$respondent_address}</td>
                    </tr>
                    <tr>
                        <td>Incident Location</td>
                        <td>{$incident_location}</td>
                    </tr>
                    <tr>
                        <td>Incident Details</td>
                        <td>{$incident_details}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>Pending</td>
                    </tr>
                </tbody>
            </table>
        MSG;
    try {
        $mail->send();
        echo json_encode(["response" => "Email Successfully Sent.", ["status" => true]]);
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    http_response_code(200);


    // Redirect to the next page
    header('Location: ' . $nextPageUrl);
    exit();
}
