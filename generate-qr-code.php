<?php
require("templates/template-functions.php");
require_once "php/phpqrcode/qrlib.php";
$title = "Generated QR Code";
$blotterData = isset($_GET['blotterData']) ? json_decode(urldecode($_GET['blotterData']), true) : [];
$qrCodeOptions = isset($_GET['qrCodeOptions']) ? json_decode(urldecode($_GET['qrCodeOptions']), true) : [];

// Validate the data
if (empty($blotterData) || empty($qrCodeOptions)) {
    header('Location: dashboard.php');
    exit;
}

// Capture the QR code image data
ob_start();
QRcode::png(json_encode($blotterData), null, QR_ECLEVEL_L, $qrCodeOptions);
$qrCodeImageData = ob_get_clean();
$data = base64_encode($qrCodeImageData);
$content = <<<CONTENT
    <div class="qrcode-container">
        <img src="data:image/png;base64,{$data}" alt="QR Code">
        <p>Keep a copy of this generated QR Code for easy tracking</p>
        <a href="php/functions/download.php?data={$data}" class="download-button">Download QR Code</a>
    </div>
CONTENT;
?>

<?php include 'templates/default.php'; ?>
