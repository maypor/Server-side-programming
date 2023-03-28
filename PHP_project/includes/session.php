	<?php
  
require_once('init.php');

class Session{
    private $signed_in;
    private $user_id;
	private $status;
    
	
    public function __construct(){
        session_start();
        $this->check_login();
        if (!array_key_exists("status", $_SESSION))
			$_SESSION["status"] = "work";
		$this->status = $_SESSION['status'];
    }
    
     private function check_login(){
        if (isset($_SESSION['user_id'])){
            $this->user_id=$_SESSION['user_id'];
            $this->signed_in=true;
        }
        else{
            unset($this->user_id);
            $this->signed_in=false;
        }
    }
    
    public function login($user){
        if($user){
            $this->user_id=$user->id;
            $_SESSION['user_id']=$user->id;
            $this->signed_in=true;
        }
    }
    
       
    public function logout(){
        echo 'logout';
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in=false;

        
    }
    
    public function __get($property){
        if (property_exists($this,$property))
            return $this->$property;
    }
     
	public function set_status($status_id){
		$_SESSION['status'] = $status_id;
	}
	
}
$session=new Session();


    
?>

