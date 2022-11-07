<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
		$allowanceName = $_POST['allowanceName'];
		$allowanceDescription = $_POST['allowanceDescription'];
		$allowanceAmount = $_POST['allowanceAmount'];
        $allowanceType = $_POST['allowanceType'];

		

		mysqli_query($conn, "INSERT INTO allowance (allowanceName, allowanceDescription, allowanceAmount, allowanceType)  VALUES('$allowanceName', '$allowanceDescription', '$allowanceAmount', '$allowanceType')") or die(mysqli_error());
		
        


        
		header("location: incentives.php");
	}
?>

