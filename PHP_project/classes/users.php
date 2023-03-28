<?php

require_once('database.php');

class user{
	    static $catalog=100;
    	private $age;
    	private $gender;
		private $avg_grade;
		private $year_in;
		private $num_courses;
		private $numChelp;
		private $type_help;
		private $assistance;
    
	
	public function __get($property){
        		if (property_exists($this,$property))
					
            			return $this->$property;
					
    	}
	function __construct($age,$gender,$status, $avg_grade,$year_in,$numChelp,$num_courses,$type_help, $assistance){
            $this->age=$age;
            $this->gender=$gender;
			$this->status=$status;
            $this->year_in=$year_in;
            $this->avg_grade=$avg_grade;
            $this->numChelp=$numChelp;
            $this->num_courses=$num_courses;
            $this->type_help=$type_help;
            $this->assistance=$assistance;			
			
            $this->id=self::$catalog++;
	}
	
	public function print_table_student(){
		$database=new Database();
		$sql="select * from student";
		$result=$database->query($sql);
		if (isset($result)){
			if ($result->num_rows>0)
				while($row=$result->fetch_assoc())
				{
					echo 'catalog number: '.$row['catalog'].', age: '.$row['age'].', gender: 	
			'.$row['gender'].', avarage grade: '.$row['avg_grade'].', year in degree: '.$row['year_in'].' <br>';
				}
		
		else
				echo "Problem with query";
			}
	}
	
		public function print_table_semester(){
		$database=new Database();
		$sql="select * from semester";
		$result=$database->query($sql);
		if (isset($result)){
			if ($result->num_rows>0)
				while($row=$result->fetch_assoc())
				{
					echo 'catalog number: '.$row['catalog'].', course number: '.$row['num_courses'].', number of courses with assistance: 	
			'.$row['numChelp'].', the type of assistance: '.$row['numChelp'].'assistance: '.$row['assistance'].' <br>';
				}
		
		else
				echo "Problem with query";
			}
	}
	public static function add_user($age,$gender,$status, $avg_grade,$year_in,$numChelp,$num_courses,$type_help, $assistance){
        global $database;
        $error=null;
		$sql="Insert into student(catalog,age,gender,status,avg_grade,year_in)values('".self::$catalog."','".$age."','".$gender."','".$status."','".$avg_grade."','".$year_in."')";
        $result=$database->query($sql);
         if (!$result){
            $error='Can not add student.  Error is:'. $database->get_connection()->error;
			return $error; 
		 }
		
        $sql="Insert into semester(catalog,num_courses,numChelp,type_help,assistance)values('".self::$catalog."','".$num_courses."','".$numChelp."','".$type_help."','".$assistance."')";
        $result=$database->query($sql);
         if (!$result){
            $error='Can not add student.  Error is:'. $database->get_connection()->error;
			return $error; 
		 
		}
		
	}
 }


?>