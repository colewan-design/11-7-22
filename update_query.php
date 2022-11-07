<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['update'])){
		$id = $_POST['id'];
		$salaryGrade = $_POST['salaryGrade'];
		$salaryAmount = $_POST['salaryAmount'];
		$salaryStep = $_POST['salaryStep'];
		$position = $_POST['position'];
		
		mysqli_query($conn, "UPDATE salarydata SET salaryGrade='$salaryGrade', salaryAmount='$salaryAmount', salaryStep='$salaryStep', position='$position' WHERE id=$id") or die(mysqli_error());

		header("location: salary_matrix.php");
	}
?>