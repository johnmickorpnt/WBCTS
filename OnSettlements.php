<!DOCTYPE html>
<html lang="en">

<head>
    <title>Blotter Website | Settlements</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style1.css">


</head>

<header>

    <a href="#" class="logo"><img src="image/wbctsLogo.png"></a>
    <input type="checkbox" id="menu-bar">
    <label for="menu-bar">Menu</label>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="OnSettlements.php">Settlements</a></li>
            <li><a href="#">Blotter Records</a></li>
            <li><a href="#">QR Code Tracking</a></li>
            <li><a href="#">Profile</a>
                <ul>
                    <li><a href="#">Personal Information</li></a>
                    <li><a href="logout.php">Log out</li></a>
                </ul>
        </ul>

    </nav>
</header>

<body>
    <?php
    include("header.php");
    ?>
    <br><br><br><br><br><br>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Job</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Antipolo</td>
                <td>61</td>
                <td>2011-04-25</td>

            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Antipolo</td>
                <td>63</td>
                <td>2011-07-25</td>

            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>Antipolo</td>
                <td>66</td>
                <td>2009-01-12</td>

            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Antipolo</td>
                <td>22</td>
                <td>2012-03-29</td>

            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Antipolo</td>
                <td>33</td>
                <td>2008-11-28</td>

            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>Antipolo</td>
                <td>61</td>
                <td>2012-12-02</td>

            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>Antipolo</td>
                <td>59</td>
                <td>2012-08-06</td>

            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>Integration Specialist</td>
                <td>Antipolo</td>
                <td>55</td>
                <td>2010-10-14</td>

            </tr>
            <tr>
                <td>Colleen Hurst</td>
                <td>Javascript Developer</td>
                <td>Antipolo</td>
                <td>39</td>
                <td>2009-09-15</td>

            </tr>
            <tr>
                <td>Sonya Frost</td>
                <td>Software Engineer</td>
                <td>Antipolo</td>
                <td>23</td>
                <td>2008-12-13</td>

            </tr>
            <tr>
                <td>Jena Gaines</td>
                <td>Office Manager</td>
                <td>Antipolo</td>
                <td>30</td>
                <td>2008-12-19</td>

            </tr>
            <tr>
                <td>Quinn Flynn</td>
                <td>Support Lead</td>
                <td>Antipolo</td>
                <td>22</td>
                <td>2013-03-03</td>

            </tr>
            <tr>
                <td>Charde Marshall</td>
                <td>Regional Director</td>
                <td>Antipolo</td>
                <td>36</td>
                <td>2008-10-16</td>

            </tr>

    </table>
    <?php
    include("footer.php");
    ?>
</body>

</html>