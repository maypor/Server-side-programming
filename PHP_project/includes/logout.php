<?php

    require_once('init.php');
    global $session;

    $session->logout();
    header('Location: Login.php');

?>
    
     
           
