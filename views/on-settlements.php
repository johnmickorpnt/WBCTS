<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  href="assets/css/style.css">
    </head>
</html>
<?php
require("../templates/template-functions.php");
$title = "On Settlements";
$content = <<<CONTENT



<table class="table-sortable">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Age</th>
                <th>Occupation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Dom</td>
                <td>35</td>
                <td>Web Developer</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Rebecca</td>
                <td>29</td>
                <td>Teacher</td>
            </tr>
            <tr>
                <td>3</td>
                <td>John</td>
                <td>30</td>
                <td>Civil Engineer</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Andre</td>
                <td>20</td>
                <td>Dentist</td>
            </tr>
        </tbody>
    </table>

    <script src="./src/tablesort.js"></script>
CONTENT;
?>

<?php include '../templates/default.php'; ?>


