<?php
    require_once('init.php');
	if ($session->signed_in){
		$user_id=$session->user_id;
		$user=new users();
		$user->find_user_by_id($user_id);
		echo '<h1>Hello '.$user->name.'</h1><br>';
		
		}
	else {header('Location: Login.php');}


?>

<!DOCTYPE html>
<html>
<head>
		<link rel="stylesheet" href="../css/menu.css">

<script>
            function log_out(){
                window.location='logout.php';
            }

		</script>
</head>
<body>
<div class="btn-group">

 <button onclick='log_out()'>Log-off</button>
<br>
<H1>Welcome to our survey</h1>

<button>
<a href="../survey_pages/page1.php">fill in the survey</a>
</button>


</div>
</body>
</html>