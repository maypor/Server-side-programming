<?php

require_once('../includes/database.php');

class semester{
    	
		private $num_courses;
		private $numChelp;
		private $type_help;
		private $assistance;
		private $user_id;

	
	public function __get($property){
        		if (property_exists($this,$property))
					
            			return $this->$property;
					
    	}
	function __construct($user_id,$numChelp,$num_courses,$type_help, $assistance){
           
            $this->numChelp=$numChelp;
            $this->num_courses=$num_courses;
            $this->type_help=$type_help;
            $this->assistance=$assistance;
			$this->user_id=$user_id;
			

			
	}
	

	
		public function print_table_semester(){
		$database=new Database();
		$sql="select * from semester";
		$result=$database->query($sql);
		if (isset($result)){
			if ($result->num_rows>0)
				while($row=$result->fetch_assoc())
				{
					echo ' course number: '.$row['num_courses'].', number of courses with assistance: 	
			'.$row['numChelp'].', the type of assistance: '.$row['numChelp'].'assistance: '.$row['assistance'].' <br>';
				}
		
		else
				echo "Problem with query";
			}
	}
	
public function print_student_table_semester($user_id) {
  $database = new Database();
  $sql = "select * from semester where user_id='" . $user_id . "'";
  $result = $database->query($sql);
  if ($result && $result->num_rows > 0) {
    echo "<table border='1' style='margin:auto; border-width:8px;'>";
    echo "<tr>";
    echo "<th>Course Number</th>";
    echo "<th>Number of Courses with Assistance</th>";
    echo "<th>Type of Assistance</th>";
    echo "<th>Did recieved Assistance</th>";
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['num_courses'] . "</td>";
      echo "<td>" . $row['numChelp'] . "</td>";
      echo "<td>" . $row['type_help'] . "</td>";
      echo "<td>" . $row['assistance'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
  } else {
    echo "Problem with query";
  }
}

	public static function add_user($user_id,$numChelp,$num_courses,$type_help, $assistance){
        global $database;
        $error=null;
		
        $sql="Insert into semester(user_id,num_courses,numChelp,type_help,assistance)values('".$user_id."','".$num_courses."','".$numChelp."','".$type_help."','".$assistance."')";
        $result=$database->query($sql);
         if (!$result){
            $error='Can not add student.  Error is:'. $database->get_connection()->error;
			return $error; 
		 
		}
		
	}
 }


?>