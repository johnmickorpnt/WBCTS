<?php
$qrCodeImageData = isset($_GET['data']) ? $_GET['data'] : '';

if (!empty($qrCodeImageData)) {
    $timestamp = time(); // Get current timestamp
    $filename = 'qrcode_' . $timestamp . '.png'; // Add timestamp to the file name

    // Set appropriate headers for the file download
    header('Content-Type: application/octet-stream');
    header('Content-Transfer-Encoding: Binary');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Output the QR code image data
    echo base64_decode($qrCodeImageData);
    exit();
} else {
    // Redirect to an error page or handle the error case as per your requirements
    header('Location: error.php');
    exit();
}
