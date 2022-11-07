<?php


require_once("config.php"); 
DATE_DEFAULT_TIMEZONE_SET('Asia/Manila');
//declare database
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));  
$result = $mysqli->query("SELECT * FROM data") or die(mysqli->error);

$findresult = mysqli_query($mysqli, "SELECT * FROM salaryData");
if($res = mysqli_fetch_array($findresult))
{
$salaryAmount = $res['salaryAmount']; 
$salaryGrade = $res['salaryGrade'];   
$salaryStep = $res['salaryStep'];  

}
while($row = $findresult->fetch_assoc()){
  $salaryAmount = $row['salaryAmount']; 
}
$id = 0;  
$update = false;
$name = '';
$position = '';
$sg = '';
$step = '';
$username = '';
$gsis = 0;
$hdmf = 0;
$philhealth = 0;
$salary = 0;
$pera = 2000;
$eaName = '';
$eaAmount = '';
$fetched_sum = 0;
$gross_amount = 0;
$output = NULL;
//update payslip of employee
if (isset($_POST['updatePayslip'])){
  $update = true;
  $emp_name =$_POST['name'];
  $fromDate =  date('Y-m-d', strtotime($_POST['fromDate']));
  $toDate = $_POST['toDate'];
  $emp_gross_amount = $_POST['gross_amount'];
  $emp_fetched_difference = $_POST['final_deduction'];
  $emp_net_amount = $_POST['net_amount'];
  $emp_id = $_POST['id'];


 $mysqli->query("UPDATE payslipdata SET emp_id='$emp_id', employee_name='$emp_name', from_date='$fromDate', to_date='$toDate', deduction_emp='$emp_fetched_difference', gross_emp='$emp_gross_amount', nett_emp='$emp_net_amount' WHERE emp_id=$emp_id") or die($mysqli->error());




 header("location:payslip_data.php");
}


//insert payslip of employee 
if(isset($_POST['savePayslip'])){
  $emp_name = $_POST['name'];
  $fromDate = date('Y-m-d', strtotime($_POST['fromDate']));
  $toDate = $_POST['toDate'];
  $emp_gross_amount = $_POST['gross_amount'];
  $emp_fetched_difference = $_POST['final_deduction'];
  $emp_net_amount = $_POST['net_amount'];
  $emp_id = $_POST['id'];

  
  $mysqli->query("INSERT INTO payslipdata (emp_id, employee_name, from_date, to_date, gross_emp, deduction_emp, nett_emp) VALUES ('$emp_id', '$emp_name', '$fromDate', '$toDate', '$emp_gross_amount', '$emp_fetched_difference', '$emp_net_amount')") or
  die($mysqli->error);

  header("location:payslip_data.php");
}
//insert payslip of individual employee 
if(isset($_POST['savePayroll'])){
 
  $payroll_from = $_POST['payroll_from'];
  $date1 = new DateTime($payroll_from);
  $payroll_to = $_POST['payroll_to'];
  $date2 = new DateTime($payroll_to);
  //get the days between to and from dates
  $interval = $date1->diff($date2);
  $get_days =  $interval->days;
  if($get_days > 15){
    $payroll_type = 1;
  }
  else if($get_days < 15){
    $payroll_type = 0;
  }
  $emp_id = $_POST['id'];
  
  $mysqli->query("INSERT INTO payroll_list (emp_id, payroll_from, payroll_to, payroll_type) VALUES ('$emp_id', '$payroll_from', '$payroll_to', '$payroll_type') ON DUPLICATE KEY UPDATE `payroll_from` = '$payroll_from', `payroll_to` = '$payroll_to', `emp_id` = '$emp_id', `payroll_type` = '$payroll_type';") or
  die($mysqli->error);

  header("location:payslip_data.php");
}
//insert new salary
if(isset($_POST['saveNewSalary'])){
  $salaryGrade = $_POST['salaryGrade'];
  $salaryAmount = $_POST['salaryAmount'];
  $salaryStep = $_POST['salaryStep'];
  $position = $_POST['position'];
  $mysqli->query("INSERT INTO salaryData (salaryGrade, salaryAmount, salaryStep, position) VALUES ('$salaryGrade','$salaryAmount','$salaryStep', '$position')") or
  die($mysqli->error);

  header("location:salary.php");
//insert employee allowance
}
if(isset($_POST['addEmployeeAllowance'])){
  $employeeId = $_POST['id'];
  $employeeAllowanceId = $_POST['employeeAllowanceId'];
  $admin_id = $_POST['admin_id'];
	$activity_type = "Insert employee incentive";
  
	$time_logged = date("Y-m-d H:i:s",strtotime("now"));
	$mysqli->query("INSERT INTO activity (time_logged, admin_id, activity_type) VALUES ('$time_logged', '$admin_id', '$activity_type')") or
	die($mysqli->error);
  
  $result = $mysqli->query("SELECT * FROM allowance WHERE allowanceId=$employeeAllowanceId") or die($mysqli->error());
        $row = $result->fetch_array();
        $employeeAllowanceName = $row['allowanceName'];
        $employeeallowanceAmount = $row['allowanceAmount'];
        $allowanceType = $row['allowanceType'];
       
        $data_result = $mysqli->query("SELECT * FROM data WHERE id=$employeeId") or die($mysqli->error());
        $data_row = $data_result->fetch_array();
        $employee_salary = $data_row['salary'];
		    if($allowanceType == 'percentage'){
        $get_percentage = $employeeallowanceAmount / 100;
        $employeeallowanceAmount = $get_percentage * $employee_salary;
        }
       
    $mysqli->query("INSERT INTO employeeallowance (employeeallowanceAmount, employeeId, eaName, allowanceId) VALUES ('$employeeallowanceAmount', '$employeeId', '$employeeAllowanceName', '$employeeAllowanceId')") or
    die($mysqli->error);

  header("location:".$_SERVER['HTTP_REFERER']);
}
//insert employee deduction
if(isset($_POST['addEmployeeDeduction'])){
  $employeeId = $_POST['id'];
  $employeeDeductionId = $_POST['employeeDeductionId'];

  $admin_id = $_POST['admin_id'];
  $activity_type = "Insert employee Mandatory deduction";

  $time_logged = date("Y-m-d H:i:s",strtotime("now"));
  $mysqli->query("INSERT INTO activity (time_logged, admin_id, activity_type) VALUES ('$time_logged', '$admin_id', '$activity_type')") or
  die($mysqli->error);
  
        $result = $mysqli->query("SELECT * FROM deductions WHERE deductionId=$employeeDeductionId") or die($mysqli->error());
        $row = $result->fetch_array();
        //get the data of the employee to have access on the employee salary
        $employee_salary = $mysqli->query("SELECT * FROM data WHERE id=$employeeId") or die($mysqli->error());
        $employee_salary_row = $employee_salary->fetch_array();
        $current_employee_salary = $employee_salary_row['salary'];

        $employeeDeductionName = $row['deductionName'];
        $employeeDeductionAmount = $row['amount'];
        $percentage_employeeDeductionAmount = $employeeDeductionAmount/100;
        $deduction_type = $row['deductionType'];
        $deduction_limit = $row['deductionLimit'];
      //multiply the deduction amount in its percentage form to the employee's salary
        if($deduction_type == 'percentage'){
          $final_employeeDeductionAmount = $percentage_employeeDeductionAmount * $current_employee_salary;
        }
        else{
          //else retain the value and set it as the final deduction amount
          $final_employeeDeductionAmount = $employeeDeductionAmount;
        }
        //deduction amount being checked if it is greater than the limit
       if ($final_employeeDeductionAmount > $deduction_limit){
        $final_employeeDeductionAmount = $deduction_limit;
       }

       if ($final_employeeDeductionAmount == 0){
        $final_employeeDeductionAmount = $row['amount'];
       }
       else{
        $final_employeeDeductionAmount = $final_employeeDeductionAmount;
       }
    $mysqli->query("INSERT INTO employeedeductions( employeeDeductionAmount, employeeId, edName, deductionId) VALUES ('$final_employeeDeductionAmount', '$employeeId', '$employeeDeductionName', '$employeeDeductionId')") or
    die($mysqli->error);

  header("location:".$_SERVER['HTTP_REFERER']);
}

//insert other deductions
if(isset($_POST['addEmployeeOtherDeduction'])){
  $employeeId = $_POST['id'];
  $otherDeductionId = $_POST['otherDeductionId'];
  $employeeOtherDeductionAmount = $_POST['employeeOtherDeductionAmount'];

  $admin_id = $_POST['admin_id'];
  $activity_type = "Insert Employee Secondary Deduction";

  $time_logged = date("Y-m-d H:i:s",strtotime("now"));
  $mysqli->query("INSERT INTO activity (time_logged, admin_id, activity_type) VALUES ('$time_logged', '$admin_id', '$activity_type')") or
  die($mysqli->error);

        $result = $mysqli->query("SELECT * FROM otherdeductions WHERE otherDeductionId=$otherDeductionId") or die($mysqli->error());
        $row = $result->fetch_array();

        
        $employeeOtherDeductionName = $row['otherDeductionName'];
       
        
    $mysqli->query("INSERT INTO employeeotherdeductions( employeeOtherDeductionAmount, employeeId, employeeOtherDeductionName, otherDeductionId) VALUES ('$employeeOtherDeductionAmount', '$employeeId', '$employeeOtherDeductionName', '$otherDeductionId')") or
    die($mysqli->error);

  header("location:".$_SERVER['HTTP_REFERER']);
}
//insert deductions
if(isset($_POST['insertDeductions'])){
  $deductionName = $_POST['deductionName'];
  $description = $_POST['description'];
  $amount = $_POST['amount'];
  $deduction_type = $_POST['deductionType'];
  $deduction_limit = $_POST['deductionLimit'];
 //getting the amount of deduction if the limit is set to 0
  
  //getting the amount of deduction
  if ($amount >$deduction_limit){
    $amount = $deduction_limit;
  }
  if ($amount <=0){
    $amount = $amount;
  }
  else{
    $amount = $amount;
  }
  
  $mysqli->query("INSERT INTO deductions (deductionName, description, amount, deductionType, deductionLimit) VALUES ('$deductionName', '$description', '$amount', '$deduction_type', '$deduction_limit')") or
  die($mysqli->error);

  header("location:deductions.php");
}

//insert department
if(isset($_POST['insertDepartment'])){
  $departmentName = $_POST['departmentName'];
  $mysqli->query("INSERT INTO department (departmentName) VALUES ('$departmentName')") or
  die($mysqli->error);

  header("location:department.php");
}
//insert position
if(isset($_POST['insertPosition'])){
  $position_name= $_POST['position_name'];
  $mysqli->query("INSERT INTO position (position_name) VALUES ('$position_name')") or
  die($mysqli->error);

  header("location:position.php");
}
//insert allowance
if(isset($_POST['insertAllowance'])){
  $allowanceName = $_POST['allowanceName'];
  $allowanceDescription = $_POST['allowanceDescription'];
  $allowanceAmount = $_POST['allowanceAmount'];
  $mysqli->query("INSERT INTO allowance (allowanceName, allowanceDescription, allowanceAmount) VALUES ('$allowanceName', '$allowanceDescription', '$allowanceAmount')") or
  die($mysqli->error);

  header("location:incentives.php");
}

//payroll save:all employees
if(isset($_POST['save_payroll'])){
  $payroll_from = $_POST['payroll_from'];
  $payroll_to = $_POST['payroll_to'];
  $payroll_type = $_POST['payroll_type'];
 
//get all data
  $payroll_result = mysqli_query($mysqli, "SELECT * FROM data");
  if($payroll_res = mysqli_fetch_array($payroll_result))
  {
  $payroll_emp_id = $payroll_res['id']; 
  $payroll_emp_name = $payroll_res['name'];   
  $payroll_emp_salary = $payroll_res['salary'];  
   
  }


 //create payroll for each employee, the data will be taken from the table 'data'
  while ($trow = mysqli_fetch_array($payroll_result)) {//$payroll_result = select * from data
    $trows[] = $trow;
  }
  foreach ($trows as $trow) {
    $payroll_emp_id = $trow['id']; //employee ID
    $payroll_emp_salary = $trow['salary']; //employee Salary
 
    
    //insert new payroll to payroll list table
   $mysqli->query("INSERT INTO payroll_list (payroll_from, payroll_to, emp_id, payroll_type) VALUES ('$payroll_from', '$payroll_to', '$payroll_emp_id', '$payroll_type')ON DUPLICATE KEY UPDATE payroll_from='$payroll_from', payroll_to='$payroll_to', payroll_type='$payroll_type';") or
   die($mysqli->error);
    }  

    
  header("location:employees.php");

}

//Employees save - employees.php
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $id = $_POST['id'];
    $sg = $_POST['sg'];
    $step = $_POST['step'];
    $position = $_POST['position_name'];//position_id fetched
    $position_result = mysqli_query($mysqli, "SELECT * FROM position where project_id = $position");
    if($position_res = mysqli_fetch_array($position_result))
    {

    $position_name = $position_res['position_name'];   
  
     
    }

    $type = $_POST['employee_type'];
    $project = $_POST['project_name'];
    $admin_id = $_POST['admin_id'];
    $activity_type = "Insert an employee";

    //archive data 
    $time_logged = date("Y-m-d H:i:s",strtotime("now"));
    $mysqli->query("INSERT INTO activity (time_logged, admin_id, activity_type) VALUES ('$time_logged', '$admin_id', '$activity_type')") or
    die($mysqli->error);

    //add new employee
    $mysqli->query("INSERT INTO data (name, position, sg, step, salary, project, type, id) VALUES ('$name', '$position_name', '$sg', '$step', '$salaryAmount', '$project', '$type', '$id')") or
    die($mysqli->error);

    $salaryAmount=0;
            




    header("location:employees.php");

}

//delete employee record
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
    $mysqli->query("DELETE FROM employeedeductions WHERE employeeId=$id") or die($mysqli->error());
    $mysqli->query("DELETE FROM employeeallowance WHERE employeeId=$id") or die($mysqli->error());
    $admin_id = $_GET['admin_id'];
    $activity_type = "Delete an employee";

    $time_logged = date("Y-m-d H:i:s",strtotime("now"));
    $mysqli->query("INSERT INTO activity (time_logged, admin_id, activity_type) VALUES ('$time_logged', '$admin_id', '$activity_type')") or
    die($mysqli->error);

    

    header("location:employees.php");
}
//payslip data delete process
if (isset($_GET['payslipDelete'])){
  $payslipId = $_GET['payslipDelete'];
  $mysqli->query("DELETE FROM payslipdata WHERE id=$payslipId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:payslip_data.php");
}

//employee salary delete process
if (isset($_GET['salaryDelete'])){
  $salaryId = $_GET['salaryDelete'];
  $mysqli->query("DELETE FROM salarydata WHERE id=$salaryId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:salary_matrix.php");
}

//employee allowance delete process
if (isset($_GET['employeeallowanceDelete'])){
  $eaID = $_GET['employeeallowanceDelete'];
  $mysqli->query("DELETE FROM employeeallowance WHERE eaID=$eaID") or die($mysqli->error());

  $admin_id = $_GET['admin_id'];
  $activity_type = "Delete employee incentive";

  $time_logged = date("Y-m-d H:i:s",strtotime("now"));
  $mysqli->query("INSERT INTO activity (time_logged, admin_id, activity_type) VALUES ('$time_logged', '$admin_id', '$activity_type')") or
  die($mysqli->error);

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:".$_SERVER['HTTP_REFERER']);
}

//employee allowance delete process
if (isset($_GET['employeeotherdeductionDelete'])){
  $odId = $_GET['employeeotherdeductionDelete'];
  $mysqli->query("DELETE FROM employeeotherdeductions WHERE odId=$odId") or die($mysqli->error());

  $admin_id = $_GET['admin_id'];
  $activity_type = "Delete employee secondary deduction";

  $time_logged = date("Y-m-d H:i:s",strtotime("now"));
  $mysqli->query("INSERT INTO activity (time_logged, admin_id, activity_type) VALUES ('$time_logged', '$admin_id', '$activity_type')") or
  die($mysqli->error);

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:".$_SERVER['HTTP_REFERER']);
}
//employee deduction delete process
if (isset($_GET['employeeDeductionDelete'])){
  $edID = $_GET['employeeDeductionDelete'];
  $mysqli->query("DELETE FROM employeedeductions WHERE edID=$edID") or die($mysqli->error());

  
  $admin_id = $_GET['admin_id'];
  $activity_type = "Delete employee mandatory deduction";

  $time_logged = date("Y-m-d H:i:s",strtotime("now"));
  $mysqli->query("INSERT INTO activity (time_logged, admin_id, activity_type) VALUES ('$time_logged', '$admin_id', '$activity_type')") or
  die($mysqli->error);

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:".$_SERVER['HTTP_REFERER']);
}

//deduction delete process
if (isset($_GET['deductionDelete'])){
  $deductionId = $_GET['deductionDelete'];
  $mysqli->query("DELETE FROM deductions WHERE deductionId=$deductionId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:deductions.php");
}
//otherdeduction delete process
if (isset($_GET['otherDeductionDelete'])){
  $otherDeductionId = $_GET['otherDeductionDelete'];
  $mysqli->query("DELETE FROM otherdeductions WHERE otherDeductionId=$otherDeductionId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:other_deductions.php");
}
//allowance delete process
if (isset($_GET['allowanceDelete'])){
  $allowanceId = $_GET['allowanceDelete'];
  $mysqli->query("DELETE FROM allowance WHERE allowanceId=$allowanceId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:incentives.php");
}
//department delete process
if (isset($_GET['departmentDelete'])){
  $departmentId = $_GET['departmentDelete'];
  $mysqli->query("DELETE FROM department WHERE departmentId=$departmentId") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:department.php");
}

//position delete process
if (isset($_GET['positionDelete'])){
  $position_id = $_GET['positionDelete'];
  $mysqli->query("DELETE FROM position WHERE id=$position_id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:position.php");
}

//salary delete process
if (isset($_GET['salaryDelete'])){
  $id = $_GET['salaryDelete'];
  $mysqli->query("DELETE FROM allowance WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:incentives.php");
}
//edit
if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;

    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());

   

    if (is_countable($result) && count($result) == 1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $position = $row['position'];
        $sg = $row['sg'];
        $step = $row['step'];
    
    }

   
}
//update
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $name =$_POST['name'];
    $sg =$_POST['sg'];
    $step =$_POST['step'];

    $admin_id = $_POST['admin_id'];
    $activity_type = "update employee record";

    $time_logged = date("Y-m-d H:i:s",strtotime("now"));
    $mysqli->query("INSERT INTO activity (time_logged, admin_id, activity_type) VALUES ('$time_logged', '$admin_id', '$activity_type')") or
    die($mysqli->error);

    $findresults_data= mysqli_query($mysqli, "SELECT * FROM salaryData where salaryStep= '$step' and salaryGrade= '$sg'");
      if($res_data = mysqli_fetch_array($findresults_data))
      {
      $salary = $res_data['salaryAmount']; 
      $position= $res_data['position']; 

      }

   $mysqli->query("UPDATE data SET salary='$salary', name='$name', position='$position', sg='$sg', step='$step' WHERE id=$id") or die($mysqli->error());


   $_SESSION['message'] = "Record has been updated!";
   $_SESSION['msg_type'] = "warning";

   header("location:employees.php");
}






    

?>