<?php
	date_default_timezone_set("Etc/GMT+8");
	
	require_once 'conn.php';
	
	$query = mysqli_query($conn, "SELECT * FROM `payslipdata`");
    if($res = mysqli_fetch_array($query))
{
    $employee_name = $res['employee_name']; 
    $emp_id = $res['emp_id']; 
    $from_date = $res['from_date']; 
    $to_date = $res['to_date']; 
    $gross_emp = $res['gross_emp']; 
    $deduction_emp = $res['deduction_emp']; 
    $nett_emp = $res['nett_emp']; 
  


}
	$date = date("Y-m-d");
	while($fetch = mysqli_fetch_array($query)){
		if(strtotime($fetch['to_date']) < strtotime($date)){
			mysqli_query($conn, "INSERT INTO archive VALUES('$fetch[employee_name]', '$fetch[from_date]', '$fetch[to_date]',  '$fetch[gross_emp]',  '$fetch[deduction_emp]',  '$fetch[nett_emp]',NULL, '$fetch[emp_id]')") or die(mysqli_error($conn));
            mysqli_query($conn, "DELETE FROM payslipdata WHERE id = '$fetch[id]'") or die(mysqli_error($conn));
		}
	}
	
?>