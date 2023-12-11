<?php
$qrCodeImageData = isset($_GET['data']) ? $_GET['data'] : '';

if (!empty($qrCodeImageData)) {
    // Decode the base64-encoded image data
    $imageData = base64_decode($qrCodeImageData);

    if ($imageData !== false) {
        $timestamp = time(); // Get current timestamp
        $filename = 'qrcode_' . $timestamp . '.png'; // Add timestamp to the file name

        // Set appropriate headers for the file download
        header('Content-Type: image/png'); // Specify the image type
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Output the decoded image data
        echo $imageData;
        exit();
    } else {
        // Handle the case where decoding fails
        header('Location: error.php?message=Failed to decode image data');
        exit();
    }
} else {
    // Redirect to an error page or handle the error case as per your requirements
    header('Location: error.php?message=Missing QR code data');
    exit();
}
