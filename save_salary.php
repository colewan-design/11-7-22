<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
		$salaryGrade = $_POST['salaryGrade'];
		$salaryStep = $_POST['salaryStep'];
		$salaryAmount = $_POST['salaryAmount'];
		$position = $_POST['position'];
		mysqli_query($conn, "INSERT INTO salarydata (salaryGrade, salaryAmount, salaryStep, position)  VALUES('$salaryGrade', '$salaryAmount', '$salaryStep', '$position')") or die(mysqli_error());
		
	
		header("location: salary_matrix.php");
	}
?>