<?php
  
require('database.php');

class users{
    private $id;
    private $name;
    private $password;
    private $date_birth;
    private $teacher;
    private $city;
	
    
    public static function fetch_users(){
        
	
        global $database;
        $result=$database->query("select * from users");
        $users=null;
        if ($result){
            $i=0;
            if ($result->num_rows>0){ 
                while($row=$result->fetch_assoc()){ 
                    $user=new User();
                    $user->instantation($row);
                    $users[$i]=$user;
                    $i+=1;
                }
            }
        }
        return $users;
    }
	
		
        
    private function has_attribute($attribute){
        
        $object_properties=get_object_vars($this);
        return array_key_exists($attribute,$object_properties);
    }
    
     private function  instantation($user_array){
        foreach ($user_array as $attribute=>$value){
            if ($result=$this->has_attribute($attribute))
                $this->$attribute=$value;
       }
     }
    public function find_user_by_id($id){
        global $database;
        $error=null;
        $result=$database->query("select * from users where id='".$id."'");
		
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
             $error="Can no find user by this id";
		 
        return $error;
        
    }
	public function find_user_by_name($name,$password){
        global $database;
        $error=null;
		$password= MD5((MD5($password)))."bhbjlhkg";
        $result=$database->query("select * from users where name='".$name."' and password='".$password."'");
		
        if (!$result)
            $error='Can not find the user.  Error is:'.$database->get_connection()->error;
        elseif ($result->num_rows>0){
            $found_user=$result->fetch_assoc();
			$this->instantation($found_user);
        }
         else
             $error="Can no find user by this name";
		 
        return $error;
        
    }
    public static function add_user($id,$name,$password,$date_birth, $teacher, $city){
        global $database;
        $error=null;
        $sql="Insert into users(id,name,password,city,teacher, date_birth) values ('".$id."','".$name."','".$password."','".$date_birth."','".$teacher."','".$city."')";
        $result=$database->query($sql);
        if (!$result)
            $error='Can not add user.  Error is:'.$database->get_connection()->error;
        return $error;
        
    }
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }

   
}

    
?>

