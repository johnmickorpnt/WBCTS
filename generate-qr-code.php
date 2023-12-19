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
QRcode::png("http://localhost/wbcts/view-blotters?id=$blotterData", null, QR_ECLEVEL_L, $qrCodeOptions);
$qrCodeImageData = ob_get_clean();
$data = base64_encode($qrCodeImageData);
$content = <<<CONTENT
    <div class="qrcode-container">
        <img id="myImage" src="data:image/png;base64,{$data}" alt="QR Code">
        <p>Keep a copy of this generated QR Code for easy tracking</p>
        <a onclick="downloadQRCode()" class="download-button">Download QR Code</a>
    </div>
    <script>
        

        function downloadQRCode() {
            // Create a blob from the base64-encoded data
            const blob = new Blob([base64ToArrayBuffer('$data')], {
                type: 'image/png'
            });

            // Create a download link
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'qrcode.png';

            // Append the link to the document and trigger the download
            document.body.appendChild(link);
            link.click();

            // Remove the link from the document
            document.body.removeChild(link);
        }

        function base64ToArrayBuffer(base64) {
            const binaryString = window.atob(base64);
            const bytes = new Uint8Array(binaryString.length);
            for (let i = 0; i < binaryString.length; i++) {
                bytes[i] = binaryString.charCodeAt(i);
            }
            return bytes.buffer;
        }
    </script>
CONTENT;
?>

<?php include 'templates/default.php'; ?>