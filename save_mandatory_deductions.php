<?php
	require_once 'conn.php';
	
	if(ISSET($_POST['save'])){
		$deductionName = $_POST['deductionName'];
		$description = $_POST['description'];
		$amount = $_POST['amount'];
        $deductionType = $_POST['deductionType'];
        $deductionLimit = $_POST['deductionLimit'];

		

		mysqli_query($conn, "INSERT INTO deductions (deductionName, description, amount, deductionType, deductionLimit)  VALUES('$deductionName', '$description', '$amount', '$deductionType' , '$deductionLimit')") or die(mysqli_error());
		
        


        
		header("location: deductions.php");
	}
?>

