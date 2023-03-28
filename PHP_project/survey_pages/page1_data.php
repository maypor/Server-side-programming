<?php
	require_once('../includes/session.php');

	if ($session->signed_in){
		$user_id=$session->user_id;
	
	
	require_once('../classes/student.php');
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
				$error='';		
				if(empty($_POST['age']) or empty($_POST['gender'])or empty($_POST['status']) or empty($_POST['avg_grade'])){$error.= "Error: All fields are required ";}
				elseif (empty($_POST['year_in'])){$error.= "Error: The all fields is required.";}
				else{
				$age= $_POST['age'];
				$gender= $_POST['gender'];
				$status= $_POST['status'];
				$avg_grade= $_POST['avg_grade'];
				$year_in= $_POST['year_in'];
				
				 if	(!(is_numeric($age) && $age >= 18 && $age <= 50)) {
					$error.= 'Error: age should be an integer between 18-50.';
				}
				elseif (!(is_numeric($avg_grade) && $avg_grade >= 0 && $avg_grade <= 100 ) ){
					$error.= 'Error: avarage grade should be an integer between 0-100.';
				}
				elseif (!(is_numeric($year_in) && $year_in >= 1 && $year_in <= 5 ) ){
					$error.= 'Error: current year in the degree should be an integer between 1-5.';
				}
				else{
			
			$p = new student($user_id, $age,$gender,$status, $avg_grade,$year_in);
			$error=student::add_user($user_id, $age,$gender,$status, $avg_grade,$year_in);
	}
	
	
			}
			if (isset($error))
					echo "<script>alert('$error');</script>";
			else{echo "OK";}
}		
		else{ header('Location: Login.php');}



  ?>