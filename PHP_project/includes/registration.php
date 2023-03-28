

<!DOCTYPE html>
<html>
    <head>
        <title>Is prime</title>
		<link rel="stylesheet" href="../css/registration.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
function submitForm() {
    var formData = $("#registrationForm").serialize();
    $.ajax({
        type: "POST",
        url: "registration_data.php",
        data: formData,
        success: function(data) {
			  if (data.includes("OK")) {
				 window.location.href = "Login.php";
        } else {
			$("#message").html(data);
        }
    }});
}
</script>

    </head>
	
    <body>
        <form id="registrationForm">
            <h1>Registation page </h1>
            <label>User name:</label>
			<input type="text" name="name"></p>
			<label>Password:</label>
			<input type="password" name="password">
            <label>ID:</label>
			<input type="text" name="id">
            <label>Date of birth:</label>
			<input type="date" name="date_birth">
            <label>city:</label>
			<input type="text" name="city">
            <label>The teacher from first grade:</label>
			<input type="text" name="teacher">
    <input type="button" value="Submit" onclick="submitForm()">
        </form>
		<div id="message">
		</div>

	
    </body>
</html>
