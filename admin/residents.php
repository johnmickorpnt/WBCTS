<?php
include("php/config/Database.php");
include("php/models/Settlements.php");
include("php/models/Blotters.php");
include("components/Table.php");

// Add button and modal for new row
?>

<!-- Modal -->

<html>
<head>
  <style>

    .modal {
      display: none; 
      position: fixed; 
      z-index: 1; 
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4); 
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto; 
      padding: 20px;
      padding-top: 10px;
      border: 1px solid #888;
      width: 30%; 
    }

    .modal-content form label,
    .modal-content form input {
      display: block;
      padding-bottom: 10px;
    }

    .modal-content form button {
      margin-top: 10px; 
      background-color: #9999e6;
      color: black;
    }

    .modal-content form input {
  	width: 100%;
	}
  </style>
</head>
<body>

  <button onclick="openModal()">Open Modal</button>

  <div id="myModal" class="modal">

    <div class="modal-content">
      <span onclick="closeModal()" style="float: right; cursor: pointer;">&times;</span>
      <center><h1>Create New Record</h1></center>
      <form>
        <label for="name">Fullname:</label>
        	<input type="text" id="name" name="name">

        <label for="email">Email:</label>
       		<input type="text" id="email" name="email">

       	<label for="contact">Contact Information:</label>
       		<input type="number" id="contact" name="contact">

        <center><button type="submit">CREATE RECORD</button></center>
      </form>
    </div>
  </div>

  <script>
    
    const modal = document.getElementById("myModal");

    function openModal() {
      modal.style.display = "block";
    }

    function closeModal() {
      modal.style.display = "none";
    }
  </script>
</body>
</html>

