<?php
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header('Location: auth/login');
    exit;
}

include("php/config/Database.php");
include("php/models/Blotters.php");
include("components/Table.php");
include("components/Modal.php");


$title = "Blotter Records - Admin";

$database = new Database();
$db = $database->connect();

$blotterObj = new Blotters($db);
// $blotterObj->setColumns(["respondent_name", "incident_location", "incident_type", "blotter_status"]);
$blotters = $blotterObj->getAllWhere(["is_archived" => 0], 'created_at DESC');
if (isset($_GET["search"]))
    $blotters = $blotterObj->search($_GET["search"], 0);
$searchTerm = isset($_GET["search"]) ? $_GET["search"] : "";

$blottersTable = new Table($blotters);
$blottersTable->setHasActions(true);
$blottersTable->setId("blotters_table");
$blottersTable->setTblName("blotter_records");
$blottersTable->setColumnType("1", "select");

$blottersTable->setColumnAttributes(1, "data-table='users'");


$blottersTable->setColumnAttributes("6", "style='display:none'");
$blottersTable->setColumnAttributes("7", "style='display:none'");
$blottersTable->setColumnAttributes("8", "style='display:none'");
$blottersTable->setColumnAttributes("10", "style='display:none'");
$blottersTable->setColumnAttributes("12", "style='display:none'");
$blottersTable->setColumnAttributes("13", "style='display:none'");
$blottersTable->setColumnAttributes("14", "style='display:none'");
$blottersTable->setUpdateAction("php/functions/blotters/update.php");
$blottersTable->setAddAction("php/functions/blotters/create.php");
$blottersTable->setIsArchiveTable(true);
$blottersTable->setIsArchiveTable(false);
$newModal = new Modal("modal");
$newModal->setHeader("Blotter Records");
$newModal->setContent(<<<CONTENT
<form id="data-form"></form>
CONTENT);

// Add button and modal for new row
$content = <<<CONTENT
	<section class="dashboard-section">
		<h4>Latest Blotters</h4>
        <div class="row-actions">
            <form class="search-bar" method="GET" action="#">
                <input type="text" id="search-input" name="search" placeholder="Search..." value={$searchTerm}>
                <button id="search-button">
                    <i class="fas fa-search"></i>
                </button>
            </form>
            <button class="table-action-btn add-button"style="margin-left:auto" data-table="blotters_table">
                <i class="fa-solid fa-plus"></i> Add
            </button>
        </div>
        {$blottersTable->build_table()}
	</section>
	{$newModal->build_modal()}

CONTENT;
?>
<?php include 'templates/default.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        var selects = document.querySelectorAll(".select_investigating_officer");
        selects.forEach((select) => {
            select.addEventListener("change", () => {
                let conf = confirm("Are you sure to assign the investigation officer to this case?");
                if (!conf) return false;

                var params = new URLSearchParams();
                params.append("id", select.getAttribute("blotter_id"));
                params.append("officer", select.value);

                fetch('php/functions/blotters/setOfficer.php', {
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
                        window.location.reload();
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    });
</script>