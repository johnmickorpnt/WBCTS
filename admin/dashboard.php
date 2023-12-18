<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user'])) {
	// Redirect to the login page
	header('Location: auth/login');
	exit;
}
else if($_SESSION['user']["is_verified"] == false){
	header('Location: auth/verify');
	exit;
}

include("php/config/Database.php");
include("php/models/Settlements.php");
include("php/models/Blotters.php");
include("components/Table.php");

$title = "Blotter Dashboard";

$database = new Database();
$db = $database->connect();

// $settlement = new Settlements($db);
// $settlements = $settlement->getAll();

$blotterObj = new Blotters($db);
$blotterObj->setColumns(["id", "respondent_name", "incident_location", "incident_type", "blotter_status"]);
$blotters = $blotterObj->getAll();

// $settlementTable = new Table($settlements);
$blottersTable = new Table($blotters);

// $settlementTable->setHasActions(false);
$blottersTable->setHasActions(false);

// $settlementTable->setTblName("settlements");
$blottersTable->setTblName("blotters");
$blottersTable->setColumnType(2, "select");
$blottersTable->setColumnAttributes("5", "style='display:none'");
$blottersTable->setColumnAttributes("8", "style='display:none'");
$blottersTable->setColumnAttributes("10", "style='display:none'");
$blottersTable->setColumnAttributes("11", "style='display:none'");

$content = <<<CONTENT
	<section class="dashboard-section">
		<h4>Statistics</h4>
		<canvas id="myChart"></canvas>
	</section>
	
CONTENT;
?>
<?php include 'templates/default.php'; ?>
<script>
	const ctx = document.getElementById('myChart');
	var fetch_statistics = (num_interval, interval_indicator) => {
		var params = new URLSearchParams();
		params.append("num_interval", num_interval);
		params.append("interval_indicator", interval_indicator);

		return fetch('php/functions/blotters/statistics', {
				method: 'POST',
				body: params,
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				}
			})
			.then(res => {
				// Check if the response status is OK (200)
				if (!res.ok) {
					throw new Error('Network response was not ok');
				}
				// Parse the JSON data from the response
				return res.json();
			})
			.then(data => {
				// Call the function to generate the chart with the parsed data
				generateChart(data);
			})
			.catch(error => {
				console.error('Error:', error);
			});
	}

	document.addEventListener("DOMContentLoaded", function() {
		let t = fetch_statistics(null, null);
		console.log(t);
	});

	function generateChart(data) {
		// console.log(data);
		const datesArray = [];
		const countsArray = [];
		data.forEach(item => {
			// Push date and count to their respective arrays
			datesArray.push(item.date);
			countsArray.push(item.count);
		});

		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: datesArray,
				datasets: [{
					label: '# of Blotter Reports Made',
					data: countsArray,
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	}
</script>