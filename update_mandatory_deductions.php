<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update'])){
		$id = $_POST['deductionId'];
		$deductionName = $_POST['deductionName'];
		$description = $_POST['description'];
		$amount = $_POST['amount'];
		$deductionType = $_POST['deductionType'];
		$deductionLimit = $_POST['deductionLimit'];
		
		mysqli_query($conn, "UPDATE deductions SET deductionType='$deductionType', deductionName='$deductionName', description='$description', amount='$amount' WHERE deductionId=$id") or die(mysqli_error());

		header("location: deductions.php");
	}
?>