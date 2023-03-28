<?php

require_once('../includes/database.php');

class course{
    	
		private $user_id;
		private $weekly_hours;
		private $reason_for_hes;
		private $there_practice;
		private $final_course_grade;
		private $learning_style;
		private $name;
		private $level_of_study;
		private $seniority;

	
	public function __get($property){
        		if (property_exists($this,$property))
					
            			return $this->$property;
					
    	}
	function __construct($user_id, $weekly_hours,$reason_for_hes,$there_practice,$final_course_grade, $learning_style,$name,$level_of_study, $seniority){
            
			$this->user_id=$user_id;
			$this->weekly_hours=$weekly_hours;
			$this->reason_for_hes=$reason_for_hes;
			$this->there_practice=$there_practice;
			$this->final_course_grade=$final_course_grade;
			$this->learning_style=$learning_style;
			$this->name=$name;
			$this->level_of_study=$level_of_study;
			$this->seniority=$seniority;
			
	}
	
	public function print_table_course(){
		$database=new Database();
		$sql="select * from course";
		$result=$database->query($sql);
		if (isset($result)){
			if ($result->num_rows>0)
				while($row=$result->fetch_assoc())
				{
					echo ' weekly hours of course: '.$row['weekly_hours'].', the reason for getting an assistance: 	
			'.$row['reason_for_hes'].', the final course help: '.$row['final_course_grade'].', lernning style: '.$row['learning_style'].' <br>';
				}
		
		else
				echo "Problem with query";
			}
	}
	public function print_student_course($user_id){
		$database=new Database();
$sql="select * from course where user_id='" . $user_id . "'";
$result=$database->query($sql);
if (isset($result)){
if ($result->num_rows>0){
	    echo "<table border='1' style='margin:auto; border-width:8px;'>";
echo '<tr><th>weekly hours of course</th><th>reason for getting an assistance</th><th>final course grade</th><th>lernning style</th><th>is there a practice</th></tr>';
while($row=$result->fetch_assoc()){
echo '<tr>';
echo '<td>' . $row['weekly_hours'] . '</td>';
echo '<td>' . $row['reason_for_hes'] . '</td>';
echo '<td>' . $row['final_course_grade'] . '</td>';
echo '<td>' . $row['learning_style'] . '</td>';
echo '<td>' . $row['there_practice'] . '</td>';

echo '</tr>';
}
echo '</table>';
}
else{
echo "Problem with query";
}
}
}

public function print_student_lucture($user_id){
$database=new Database();
$sql="select * from lecture where user_id='" . $user_id . "'";
$result=$database->query($sql);
if (isset($result)){
if ($result->num_rows>0){
	    echo "<table border='1' style='margin:auto;  border-width:8px;'>";

echo '<tr><th>lecture name</th><th>level of study</th><th>seniority of the lecturer</th></tr>';
while($row=$result->fetch_assoc()){
echo '<tr>';
echo '<td>' . $row['name'] . '</td>';
echo '<td>' . $row['level_of_study'] . '</td>';
echo '<td>' . $row['seniority'] . '</td>';
echo '</tr>';
}
echo '</table>';
}
else{
echo "Problem with query";
}
}
}
		public function print_table_lucture(){
		$database=new Database();
		$sql="select * from lecture";
		$result=$database->query($sql);
		if (isset($result)){
			if ($result->num_rows>0)
				while($row=$result->fetch_assoc())
				{
					echo ' lecture name: '.$row['name'].', the level of study: 	
			'.$row['level_of_study'].', the seniority of the lecturer: '.$row['seniority'].' <br>';
				}
		
		else
				echo "Problem with query";
			}
	}
	public static function add_user($user_id,$weekly_hours,$reason_for_hes,
	$there_practice,$final_course_grade, $learning_style,$name,$level_of_study, $seniority){
        global $database;
        $error=null;
	
		$sql="Insert into course(user_id, weekly_hours,reason_for_hes,there_practice,final_course_grade,learning_style)values('".$user_id."','".$weekly_hours."','".$reason_for_hes."','".$there_practice."','".$final_course_grade."','".$learning_style."')";
        $result=$database->query($sql);
         if (!$result){
            $error='Can not add student.  Error is:'. $database->get_connection()->error;
			return $error; 
		 }
		 
		 $sql="Insert into 	lecture(user_id,name,level_of_study,seniority)values('".$user_id."','".$name."','".$level_of_study."','".$seniority."')";
        $result=$database->query($sql);
         if (!$result){
            $error='Can not add student.  Error is:'. $database->get_connection()->error;
			return $error; 
		 }
		
	}
 }


?>