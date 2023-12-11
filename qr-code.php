<?php
require("templates/template-functions.php");


$title = "Blotter Website";
$content = <<<CONTENT
	<div id="reader" width="600px"></div>
CONTENT;
?>
<?php include 'templates/default.php'; ?>
<script>
	function onScanSuccess(decodedText, decodedResult) {
		// handle the scanned code as you like, for example:
		let id = decodedText.substr(decodedText.indexOf(":") + 1).slice(0,-1).trim();
		var url = "view-blotters?id=" + encodeURIComponent(id);
		window.location.href = url;
	}

	function onScanFailure(error) {
		// handle scan failure, usually better to ignore and keep scanning.
		// for example:
		// console.warn(`Code scan error = ${error}`);
	}

	let html5QrcodeScanner = new Html5QrcodeScanner(
		"reader", {
			fps: 10,
			qrbox: {
				width: 250,
				height: 250
			}
		},
		/* verbose= */
		false);
	html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>