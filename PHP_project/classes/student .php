<?php

require_once('../includes/database.php');

class student{
    	private $age;
    	private $gender;
		private $avg_grade;
		private $year_in;
		private $status;
		private $user_id;

	
	public function __get($property){
        		if (property_exists($this,$property))
					
            			return $this->$property;
					
    	}
	function __construct($user_id, $age,$gender,$status, $avg_grade,$year_in){
            $this->age=$age;
            $this->gender=$gender;
			$this->status=$status;
            $this->year_in=$year_in;
			$this->user_id=$user_id;
			$this->avg_grade=$avg_grade;

	}
	
	public function print_table_student(){
		$database=new Database();
		$sql="select * from student";
		$result=$database->query($sql);
		if (isset($result)){
			if ($result->num_rows>0)
				while($row=$result->fetch_assoc())
				{
					echo ' age: '.$row['age'].', gender: 	
			'.$row['gender'].', avarage grade: '.$row['avg_grade'].', year in degree: '.$row['year_in'].' , status: '.$row['status'].'<br>';
				}
		
		else
				echo "Problem with query";
			}
	}
public function print_student($user_id){
  $database=new Database();
  $sql="select * from student where user_id='" . $user_id . "'";
  $result=$database->query($sql);
  if (isset($result)){
    if ($result->num_rows>0){
		    echo "<table border='1' style='margin:auto;  border-width:8px;'>";
      echo '<tr><th>age</th><th>gender</th><th>avarage grade</th><th>year in degree</th><th>status</th></tr>';
      while($row=$result->fetch_assoc()){
        echo '<tr>';
        echo '<td>' . $row['age'] . '</td>';
        echo '<td>' . $row['gender'] . '</td>';
        echo '<td>' . $row['avg_grade'] . '</td>';
        echo '<td>' . $row['year_in'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        echo '</tr>';
      }
      echo '</table>';
    }
    else{
      echo "Problem with query";
    }
  }
}
	
	public static function add_user($user_id, $age,$gender,$status, $avg_grade,$year_in){
        global $database;
        $error=null;
		$sql="Insert into student(user_id,age,gender,status,avg_grade,year_in)values('".$user_id."','".$age."','".$gender."','".$status."','".$avg_grade."','".$year_in."')";
        $result=$database->query($sql);
         if (!$result){
            $error='Can not add student.  Error is:'. $database->get_connection()->error;
			return $error; 
		 }
		
        
		
	}
	 
public function relation_to_others_graph1($user_id){
	$database=new Database();
		$sql="select final_course_grade from course where user_id='" . $user_id . "'";
		$sql2="select assistance from semester where user_id='" . $user_id . "'";
		$sql3="SELECT AVG(final_course_grade) as avg_grade FROM course INNER JOIN semester ON course.user_id = semester.user_id where assistance='yes';";
		$sql4="SELECT AVG(final_course_grade) as avg_grade FROM course INNER JOIN semester ON course.user_id = semester.user_id where assistance='no';";

		$result=$database->query($sql);
		$result2=$database->query($sql2);
		$result3=$database->query($sql3);
		$result4=$database->query($sql4);


		if (isset($result)&&isset($result2)&&isset($result3)&&isset($result4)){
			if ($result->num_rows>0 && $result2->num_rows>0)
				while($row=$result->fetch_assoc())
				{
					$row2=$result2->fetch_assoc();
					$row3=$result3->fetch_assoc();
					$row4=$result4->fetch_assoc();
					
					
					if($row2['assistance']=='yes'&& $row['final_course_grade'] == $row3['avg_grade'])
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">Your final course grade is '.$row3['avg_grade'].' which is equal to the others students avarage that recived an assistance.<br><p>';
					else if($row2['assistance']=='yes'&& $row['final_course_grade'] > $row3['avg_grade'])
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">Your final course grade is '.$row3['avg_grade'].' which is above the others students avarage that recived an assistance.<br><p>';
					else if($row2['assistance']=='yes'&& $row['final_course_grade'] < $row3['avg_grade'])
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;"> Your final course grade is '.$row3['avg_grade'].' which is under the others students avarage that recived an assistance.<br><p>';
					else if($row2['assistance']=='no'&& $row['final_course_grade'] == $row3['avg_grade'])
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;" >Your final course grade is '.$row3['avg_grade'].' which is equal to the others students avarage that didnt recived an assistance.<br><p>';
					else if($row2['assistance']=='no'&& $row['final_course_grade'] > $row3['avg_grade'])
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;" >Your final course grade is '.$row3['avg_grade'].' which is above the others students avarage that didnt recived an assistance.<br><p>';
					else
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">Your final course grade is '.$row3['avg_grade'].' which is under the others students avarage that didnt recived an assistance.<br><p>';						
				}
		
		else
				echo "Problem with query";
			}
	}public function relation_to_others_graph2($user_id){
		$database=new Database();
		
		$sql="SELECT reason_for_hes from course where user_id='" . $user_id . "'";
		
		$result=$database->query($sql);

		if (isset($result)){
			if ($result->num_rows>0 )
				while($row=$result->fetch_assoc())
				{
					if($row['reason_for_hes']=='difficult')
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;"> The reason you got an assistance is because the study material is difficult.</p>';
					else if($row['reason_for_hes']=='unclear')
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;"> The reason you got an assistance is because the study material is unclear.</p>';
					else if($row['reason_for_hes']=='missed')
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;"> The reason you got an assistance is because you missed a lot of classes.</p>';
					else echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;"> You didnt needed any assistance.</p>';

				}
		
		else
				echo "Problem with query";
			}
	}
	public function relation_to_others_graph3($user_id){
		$database=new Database();
		$sql="SELECT type_help FROM semester where user_id='" . $user_id . "'";
		
		$result=$database->query($sql);

		if (isset($result)){
			if ($result->num_rows>0 )
				while($row=$result->fetch_assoc())
				{
					if($row['type_help']=='private')
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You got an assitance from a private lessons.</p>';
					else if($row['type_help']=='web')
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You got an assitance from a website.</p>';
					else if($row['type_help']=='center')
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You got an assitance from a study center.</p>';
					else echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You didnt needed any assistance.</p>';

				}
		
		else
				echo "Problem with query";
			}
	}
	public function relation_to_others_graph4($user_id){
		$database=new Database();
		$sql="SELECT final_course_grade FROM course where user_id='" . $user_id . "'";
		$sql2="SELECT name FROM lecture where user_id='" . $user_id . "'";		
		
		$result=$database->query($sql);
		$result2=$database->query($sql2);


		if (isset($result)&&isset($result2)){
			if ($result->num_rows>0 )
				while($row=$result->fetch_assoc())
				{
					$row2=$result2->fetch_assoc();
					echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You are studding with '.$row2['name'].' and your final course grade is '.$row['final_course_grade'].'</p>';
				}
		
		else
				echo "Problem with query";
			}
	}
		public function relation_to_others_graph5($user_id){
		$database=new Database();
		$sql="SELECT year_in,avg_grade, gender from student WHERE user_id='" . $user_id . "'";
		
		$result=$database->query($sql);


		if (isset($result)){
			if ($result->num_rows>0 )
				while($row=$result->fetch_assoc())
				{
					if($row['year_in']==1)
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You are at your first year, your avarage grade is '.$row['avg_grade'].' and your gender is '.$row['gender'].'</p>';
					else if($row['year_in']==2)
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You are at your second year, your avarage grade is '.$row['avg_grade'].' and your gender is '.$row['gender'].'</p>';
					else if($row['year_in']==3)
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You are at your third year, your avarage grade is '.$row['avg_grade'].' and your gender is '.$row['gender'].'</p>';
					else if($row['year_in']==4)
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You are at your fourth year, your avarage grade is '.$row['avg_grade'].' and your gender is '.$row['gender'].'</p>';
					else 
						echo '<p style="font-size: 25px; text-align: center; text-shadow: #2a8d7b -1px -1px; color: #FF4500;">You are at your fifth year, your avarage grade is '.$row['avg_grade'].' and your gender is '.$row['gender'].'</p>';
				}
		
		else
				echo "Problem with query";
			}
	}
 }


?>