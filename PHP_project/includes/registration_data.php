
	<?php

		$host="localhost";  
	$user="mayshlom_may";
	$pass="ufEpfd3soQ6M";
	$db="mayshlom_project_php";
		//create connection
		$conn=new mysqli($host,$user,$pass,$db);
		if ($conn->connect_error){
				die("Connection failed: ".$conn->connect_error);}
		//echo "Connection successful";
		
		require_once('user.php');
		require_once('database.php');
		if($database->get_connection()){
			//echo "connection is OK<br>";
		}
		else{
			die("connection fails");
		}
		
				$error = NULL;
			

				
				 if(empty($_POST['name'])or empty($_POST['password'])or empty($_POST['id'])or empty($_POST['date_birth'])or empty($_POST['teacher'])or empty($_POST['city'])){
					$error.= "Error: All fields are required";

				 }
				else{ 
				$name=$_POST['name'];
				$password=$_POST['password'];
				$id=$_POST['id'];
				$date_birth=$_POST['date_birth'];
				$teacher=$_POST['teacher'];
				$city=$_POST['city'];
				$uppercase = preg_match('@[A-Z]@', $password);
				$lowercase = preg_match('@[a-z]@', $password);
				$number  = preg_match('@[0-9]@', $password);
				$specialChars = preg_match('@[^\w]@', $password);

				 if	(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {

					$error.= 'Error: Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
				}
				elseif (!(strlen($id) == 9 && is_numeric($id))){
					$error.= 'Error: The ID is not valid, must have 9 numbers';
				}
				elseif(!(ctype_alpha($teacher)) or (!(ctype_alpha($city)))){
					$error.= 'Error: The city and the name of the teacher must be with letters only.';
				}
			
				else{
				$password= MD5((MD5($password)))."bhbjlhkg";
				$p = new users($id,$name,$password, $date_birth,$teacher,$city);
				$error.=users::add_user($id,$name,$password, $date_birth,$teacher,$city);

				
				
				}	}
				if ($error)
						echo "<script>alert('$error');</script>";
				else{echo "OK";}

	
?>
