<?php
require("templates/template-functions.php");


$title = "About Us";
$containerStyles = "padding:4rem;width:75%;margin:auto";
$content = <<<CONTENT
	<center>
		<a href="../index"><img src="assets/images/sanroq.png"></a>
		<h1>About Us</h1>
		<hr>
	</center>

	<div style="display:grid; grid-template-columns: 1fr 1fr;gap:1rem">
        <div>
            <p>San Roque, formerly Poblacion, is a barangay in the city of Antipolo, in the province of Rizal. Its population as determined by the 2020 Census was 70,120. This represented 7.90% of the total population of Antipolo.</p>
            
            <h3>VISION:</h3>
            By the year 2020, Barangay San Roque is a progressive and self-reliant community, with healthy and well-informed residents who are god-fearing, peace-loving and energetic individuals, coordinating with local government to sustain its environment and promote a balanced eco-tourism.
            
            <h3>MISSION</h3>
            <p>
                To deliver high quality service to our barangay through a highly organized leadership system, and encourage active participation from our constituents in working towards the realization of our goals to become a progressive, more productive, peace-loving, and eco-friendly community.
            </p>
        </div>
        <div>
            <p><h4>Punong Barangay:</h4> Hon. Leandro "Anding" S. Cabasbas</p>
            <br>
            <h4>Barangay Kagawad:</h4>
            <p>Hon. Ian A. Asumbra</p>
            <p>Hon. Juanito "Lito" M. Abiog</p>
            <p>Hon. Lou Martin "Ambo" N. Aquino</p>
            <p>Hon. Fernando "Ferdie" R. Serreon</p>
            <p>Hon. Benjamin "Kambal" G. Caluma</p>
            <p>Hon. Christopher "Wowie" R. Zapanta</p>
            <p>Hon. Jayson G. Panganiban</p>
            
            <p>Barangay Secretary: Gertrude Aivee C. Diamante</p>
            
            <p>Barangay Treasurer: Rebecca L. Baldoz</p>
        </div>
    </div>
    <div>
        <h4 style="text-align:center">Find us At:</h4>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d965.320607108448!2d121.1714696161763!3d14.582975999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397bf555bce4a23%3A0xefa256eeb349e27d!2sSan%20Roque%20Barangay%20Hall!5e0!3m2!1sen!2sph!4v1703015260582!5m2!1sen!2sph" style="border:0;width:100%;height:300px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
CONTENT;
?>
<?php include 'templates/default.php'; ?>