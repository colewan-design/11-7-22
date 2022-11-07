<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update'])){
		$id = $_POST['allowanceId'];
		$allowanceName = $_POST['allowanceName'];
		$allowanceDescription = $_POST['allowanceDescription'];
		$allowanceAmount = $_POST['allowanceAmount'];
		$allowanceType = $_POST['allowanceType'];
		
		mysqli_query($conn, "UPDATE allowance SET allowanceType='$allowanceType', allowanceName='$allowanceName', allowanceDescription='$allowanceDescription', allowanceAmount='$allowanceAmount' WHERE allowanceId=$id") or die(mysqli_error());

		header("location: incentives.php");
	}
?>