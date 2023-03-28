<?php


    require_once('init.php');
	
    global $session;
    $error='';
    if(isset($_POST['submit'])){
        if (!$_POST['name']){
            $error='User is required';
        }
        else if(!$_POST['password']){
            $error='Password is required';
        }
        else{
            
            $name=$_POST['name'];
            $password=$_POST['password'];
            $user=new users();
            $error=$user->find_user_by_name($name,$password);
            if (!$error){
                $session->login($user);
                header('Location: menu.php');

            }
    
        }
    }
    
 
?>

<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" href="../css/login.css">


    </style>  
</head>
<body>
    <p id="error"><?php echo $error?></p>
    <form  method="post">
		<h1>Survey website</h1>

        <fieldset>
        <legend>Login User:</legend>
        <p><label>User: <input type="text" name="name"></label></p>
        <p><label>Password: <input type="password" name="password"></label></p>
         <div>
		<input type="submit" value="log in" name="submit">
		<button>
		<a href="registration.php">sign in</a>
		</button>
		</div>
  </fieldset>
	

</form>


</body>
</html>

