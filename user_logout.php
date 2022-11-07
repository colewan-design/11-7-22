<?php require_once("config.php"); 
require_once("process.php"); 
//employee logout activity
if (isset($_GET['logout'])){
	session_start();
 session_destroy();
    header("location:login.php"); 
  }

?>