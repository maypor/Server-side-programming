<?php
require_once('../includes/session.php');
	if (!($session->signed_in&& $session->status=="work")){
		header('Location: ../includes/Login.php');}
	
?>
  <!DOCTYPE html>
<html>
    <head>
        <title>survey</title>
		<link rel="stylesheet" href="../css/index.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

		<script>
function submitForm() {
    var formData = $("#page1Form").serialize();
    $.ajax({
        type: "POST",
        url: "page1_data.php",
        data: formData,
        success: function(data) {
			 if (data.includes("OK")) {
				 window.location.href = "page2.php";
        } else {
			$("#message").html(data);
        }
    }});
}
</script>
		
    </head>
    <body>

<form id="page1Form">
          <h1>Hello, we are doing a survey, please fill in the following details: </h1>
		  <p>In this survey we check if there is a connection between a student's grade in the data structure course and the external assistance he received for the course</p>
		  <section id="s1">
		  <h2>Personal Information</h2>
		  <label>Age (between 18 and 50):</label>
		  <input type="number" id="age" name="age"><br><br>
			
		 <label>Please select your gender:</label>
		 <input type="radio" id="gender" name="gender" value="female">female<br>
		 <input type="radio" id="gender" name="gender" value="male">male<br><br>

		<label>Please select your family status:</label>
		<input type="radio" id="married" name="status" value="married">married<br>
		<input type="radio" id="male" name="status" value="single">single<br>
		<input type="radio" id="divorced" name="status" value="divorced">divorced<br>
		<input type="radio" id="widower" name="status" value="widower">widower<br><br>
		
		<label>Average grade (between 0 and 100):</label>
		<input type="number" id="avg_grade" name="avg_grade"<br><br>
 
		<label>Current year in degree: (between 1 and 5):</label>
		<input type="number" id="year_in" name="year_in"><br><br>
			
		<input type="button" value="next" onclick="submitForm()">


        </form>
		<div id="message">
		</div>
		

    </body>
</html>
