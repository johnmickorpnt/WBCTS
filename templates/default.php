<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : "Blotter"; ?></title>
    <link rel="stylesheet" href="<?= asset("css/footerstyle.css") ?>">
    <link rel="stylesheet" href="<?= asset("css/headerstyle.css") ?>">
    <link rel="stylesheet" href="<?= asset("css/style.css") ?>">
    <script src="https://kit.fontawesome.com/fbc9e418a7.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
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
    <?= component("new-blotter.php") ?>
    <?= component("header.php") ?>
    <main class="<?php echo isset($customContainerClass) ? $customContainerClass : "main-container";?>" 
    <?= isset($containerStyles) ? "style='{$containerStyles}'" : "" ?>>
        <?= $content ? $content : "" ?>
    </main>
    <?= component("footer.php") ?>
</body>

</html>

<script>
    var blotterElem = document.getElementById("new_blotter");
    let verified = <?= $_SESSION["verified"]?>;
    document.addEventListener("DOMContentLoaded", () => {
        let incidentType = document.getElementById("incident_type");
        let specificIncidentType = document.getElementById("specific_incident_type");
        specificIncidentType.style.display = "none";
        incidentType.addEventListener("change", () => {
            if (incidentType.value !== "other") {
                incidentType.setAttribute("name", "incident_type");
                specificIncidentType.removeAttribute("name");
                specificIncidentType.style.display = "none";
            } else {
                incidentType.removeAttribute("name");
                specificIncidentType.setAttribute("name", "incident_type");
                specificIncidentType.style.display = "inline";
            }
        });
    });

    function closeBlotterDialog() {
        blotterElem.close();
    }

    function openNewBlotterDialog() {
        if(!verified) window.location.href ="auth/needs-verification";
        blotterElem.showModal();
    }

    function goToBlotters(){
        if(!verified) window.location.href ="auth/needs-verification";
        window.location.href ="blotter-records";
    }
</script>