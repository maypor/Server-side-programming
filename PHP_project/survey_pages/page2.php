<?php
    require_once('../includes/init.php');
	if ($session->signed_in&& $session->status=="work"){
		$user_id=$session->user_id;
	
	
	require_once('../classes/semester.php');
	require_once('../includes/database.php');
	
	$host="localhost";  
	$user="mayshlom_may";
	$pass="ufEpfd3soQ6M";
	$db="mayshlom_project_php";
	
	
	//create connection
	$conn=new mysqli($host,$user,$pass,$db);
	if ($conn->connect_error){
    		die("Connection failed: ".$conn->connect_error);}
	//echo "Connection successful";
	
	if($database->get_connection()){
		//echo "connection is OK<br>";
	}
	else{
		die("connection fails");
	}
		if ($_GET){
				$error='';		
				if (empty($_GET['num_courses'])or empty($_GET['type_help'])){$error.= "Error: all the fields are required";}
				elseif (empty($_GET['assistance'])){$error.= "Error: all the fields are required";}
				else{
				$numChelp= $_GET['numChelp'];
				$num_courses= $_GET['num_courses'];
				$type_help=$_GET['type_help'];
				$assistance=$_GET['assistance'];
				
				 if	(!(is_numeric($num_courses) && $num_courses >= 1 && $num_courses <= 8 ) ){
					$error.= 'Error: the number of courses should be an integer between 1-8';
				}
				elseif (!(is_numeric($numChelp) && $numChelp >= 0 && $numChelp <= 8 ) ){
					$error.= 'Error: the number of courses with assistance should be an integer between 1-8';
				}
				elseif (!( $numChelp <= $num_courses ) ){
					$error.= 'Error: the number of courses with assistance should be smaller than the number of courses without assistance.';
				}
				else{
			
			$p = new semester($user_id,$numChelp,$num_courses,$type_help, $assistance);
			$error=semester::add_user($user_id,$numChelp,$num_courses,$type_help, $assistance);
	}
		 
			

			}
				if (isset($error))
					echo "<script>alert('$error');</script>";
				else
						header('Location: page3.php');
}
}		
		
		else{ header('Location: ../includes/Login.php');}



?>
<html>
<head>
        <title>survey</title>
		<link rel="stylesheet" href="../css/index.css">
		
    </head>
	<body>
<form>
		  <h2>Current semester details</h2>

		<label>number of courses you are studing at your current semester: (between 1 and 8):</label>
		<input type="number" id="num_courses" name="num_courses" min="0"><br><br>
		
			<label>Mark if got an internal assistance:</label>
		<input type="radio" id="assistance" name="assistance" value="yes">yes<br>
		<input type="radio" id="assistance" name="assistance" value="no">no<br><br>

		 <label>Number of courses you have received assistance(between 0-8):</label>
		 <input type="number" id="numChelp" name="numChelp"><br><br>

		<label>Choose the kind of assistance you received: </label>
		<input type="radio" id="type_help" name="type_help" value="web">to a website<br>
		<input type="radio" id="type_help" name="type_help" value="private">private lessons<br>
		<input type="radio" id="type_help" name="type_help" value="center">study center<br>
		<input type="radio" id="type_help" name="type_help" value="no">dont need assistance<br><br>

	
		
		            <p><input type="submit" value="next"></p>

		</form>
		</body>
</html>