<?php
    require_once('../includes/init.php');
	if ($session->signed_in && $session->status=="work"){
		$user_id=$session->user_id;
	
	
	require_once('../classes/course.php');
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
				if(empty($_GET['weekly_hours'])or empty($_GET['reason_for_hes'])or empty($_GET['there_practice'])){$error.= "Error: all the fields are required";}

				elseif (empty($_GET['final_course_grade'])or empty($_GET['learning_style'])or empty($_GET['name'])or empty($_GET['level_of_study'])or empty($_GET['seniority']))
				{$error.= "Error: all the fields are required";}
				else{
				$weekly_hours=$_GET['weekly_hours'];
				$reason_for_hes=$_GET['reason_for_hes'];
				$there_practice=$_GET['there_practice'];
				$final_course_grade=$_GET['final_course_grade'];
				$learning_style=$_GET['learning_style'];
				$name=$_GET['name'];
				$level_of_study=$_GET['level_of_study'];
				$seniority=$_GET['seniority'];
				
				if (!(is_numeric($weekly_hours) && $weekly_hours >= 1 && $weekly_hours <= 5) ){
					$error.= 'Error: the number of hours should be an integer between 1-10';
				}
				elseif(!(ctype_alpha($name)) or (!(strlen($name) < 15))){
					$error.= 'Error: The name must be samaller than 15 chars and with alphabet letters only';
				}
				elseif (!(is_numeric($final_course_grade) && $final_course_grade >= 0 && $final_course_grade <= 100 ) ){
					$error.= 'Error: avarage grade should be an integer between 0-100';
				}
				else{
			
			
			 
			
			$p = new course($user_id, $weekly_hours,$reason_for_hes,$there_practice,$final_course_grade, $learning_style,$name,$level_of_study, $seniority);
			$error=course::add_user($user_id, $weekly_hours,$reason_for_hes,$there_practice,$final_course_grade, $learning_style,$name,$level_of_study, $seniority);
			
	}
		    
}
	if (isset($error)){
				echo "<script>alert('$error');</script>";}
			else{

				$session->set_status("final");
				echo "<script>alert('Please check your phone, you will receive an SMS');window.location.href = '../includes/show_result.php'</script>";
				send_sms($_GET['phone']);

			}

}
}		
		elseif($session->status=="final")echo "<script>alert('It is not possible to edit the form after submission');</script>";
		else{ 
		header('Location: ../includes/Login.php');}



function send_sms($phone_num){
    $phone_num = substr($phone_num, 1);
	$phone_num = "+972".$phone_num;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.twilio.com/2010-04-01/Accounts/AC273eca715f4b22acf9e98bf45ba416a1/Messages.json",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array(
    "Body" => "Thank you for filling out our survey",
    "From" => "+14342163730",
    "To" => $phone_num
  ),
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic " . base64_encode("AC273eca715f4b22acf9e98bf45ba416a1:a566bacfedca506d69fd17b9e8f41762")
  ),
));

$response = curl_exec($curl);

curl_close($curl);


}

	?>
<html>
<head>
        <title>survey</title>
		<link rel="stylesheet" href="../css/index.css">
		
    </head>
	<body>
<form>
		  <h2>Data structure course</h2>

		<label> How many weekly hours are there for the course?</label>
		<input type="number" name="weekly_hours"><br><br>
		<label>Mark the reason for assistance:</label>
		<input type="radio" id="reason_for_hes" name="reason_for_hes" value="difficult"> The study material is difficult <br>
		<input type="radio" id="reason_for_hes" name="reason_for_hes" value="unclear"> The lecturer is unclear<br>
		<input type="radio" id="reason_for_hes" name="reason_for_hes" value="missed"> I missed a lot of classes<br>
		<input type="radio" id="reason_for_hes" name="reason_for_hes" value="not_relavent"> not relavent<br>

		<br>
		<label>mark if there is a practice to the this lesson:</label>
		<input type="radio" id="there_practice" name="there_practice" value="yes">yes<br>
		<input type="radio" id="there_practice" name="there_practice" value="no">no<br><br>
		<label> Enter your final course grade</label>
		<input type="number" name="final_course_grade"><br><br>
		<label>Learning style:</label>
		<input type="radio" id="learning_style" name="learning_style" value="zoom">Zoom<br>
		<input type="radio" id="learning_style" name="learning_style" value="frontal">frontal<br><br>
		 
		 <h2>Information about the lecturer</h2>
		<label> the name of the lecturer</label>
		
		<input type="text" name="name"><br><br>
		<label> Rate the level of study of the lecturer: (1-10)</label>
		<input type="number" name= "level_of_study"><br><br>
				<label> Enter the seniority of the lecturer:</label>

		<input type="radio" id="seniority" name="seniority" value="less3">less than 3 yers<br>
		<input type="radio" id="seniority" name="seniority" value="between3-5">between 3-5 years<br>
		<input type="radio" id="seniority" name="seniority" value="between3-5">more than 5 years<br><br>
		<label> Enter your phone number:</label>

		<input type="phone" name='phone' placeholder='0503644434'>

            <p><input type="submit" value="submit"></p>
	
    					</form>

					</body>
	</html>
	