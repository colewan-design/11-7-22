<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once("config.php");
require_once("process.php"); 
$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4-L',
    'orientation' => 'L']);

$fres = mysqli_query($mysqli, "SELECT * FROM payslipdata WHERE id= '$id'");
if($res = mysqli_fetch_array($fres))
{
$employee_name = $res['employee_name']; 
$gross_emp = $res['gross_emp']; 
$deduction_emp = $res['deduction_emp']; 
$nett_emp = $res['nett_emp']; 
$emp_id = $res['emp_id']; 
}

$employee_data = mysqli_query($mysqli, "SELECT * FROM data WHERE id= '$emp_id'");
if($data_emp = mysqli_fetch_array($employee_data))
{
$salary = $data_emp['salary']; 
$sg = $data_emp['sg']; 
$step = $data_emp['step']; 
$position = $data_emp['position']; 
}

$f='';
$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);



$html = '';
$html .= '
<div class="row" style="border: 1px solid black;padding:10px;">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <div align="center"><img src="images/letterhead.png" width="600" height="150"></div>
 <div class="text-center lh-1 mb-2">
                 <h6 style="margin-top:10px;"class="fw-bold"></h6> <span class="fw-normal"></span>
</div>
             <div style="position:absolute;float: left;width: 40%; padding: 10px;">
             <div class="col-md-10">
            
                     
                     <div class="col-md-6">
                         <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3"></small>'.$employee_name.' </div>
                     </div>
             </div>
             
                     <div class="col-md-6">
                         <div> <span class="fw-bolder">Pay Period</span> <small class="ms-3">'.date('F Y').'</small> </div>
                     </div>
                     
        
                     <div class="col-md-6">
                         <div> <span class="fw-bolder">Position</span> <small class="ms-3">'.$position.'</small> </div>
                     </div>
             </div>

                 <div style="float: right; width: 40%;">
                         <div class="col-md-6">
                             <div> <span class="fw-bolder"></span> <small class="ms-3"></small> </div>
                         </div>
                         <div class="col-md-6">
                             <div> <span class="fw-bolder">Salary Grade</span> <small class="ms-3">'.$sg.'</small> </div>
                         </div>
                  
                 
                         <div class="col-md-6">
                             <div> <span class="fw-bolder">Step</span> <small class="ms-3">'.$step.'</small> </div>
                         </div>
                         
                    </div>
<br/>
<br/>
<br/>
<br/>
<div class="column" style="float: right; width: 40%;">
<table style="      
                    font-family: arial, sans-serif;
                    border-collapse: collapse;
                   ">
<thead>
    <tr >
    
        <th >Deductions</th>
        <hr>
        <th style="padding-left:10px;">Amount</th>
        <hr>
    </tr>
</thead>
<tbody>';
$link = mysqli_connect("localhost","root","","crud");
$no = 1;
$other_no =1;
$q = "SELECT * FROM `employeedeductions`  where employeeId='$emp_id'";
$other_q = "SELECT * FROM `employeeotherdeductions`  where employeeId='$emp_id'";
$deduction_results = $mysqli->query("SELECT employeeId, sum(employeeDeductionAmount) AS value_difference FROM employeedeductions where employeeId=$emp_id") or die(mysqli->error);
$other_deduction_results = $mysqli->query("SELECT employeeId, sum(employeeOtherDeductionAmount) AS other_value_difference FROM employeeotherdeductions where employeeId=$emp_id") or die(mysqli->error);
while($deduction_rows = $deduction_results->fetch_assoc()) {
      
  $fetched_difference = $deduction_rows['value_difference'];
 
}

while($other_deduction_rows = $other_deduction_results->fetch_assoc()) {
      
    $other_fetched_difference = $other_deduction_rows['other_value_difference'];
   
  }
  
  $fetched_difference = $fetched_difference + $other_fetched_difference;
$res = mysqli_query($link,$q);
$row = mysqli_num_rows($res);

$other_res = mysqli_query($link,$other_q);
$other_row = mysqli_num_rows($other_res);
if($row > 0) { 
while($row = mysqli_fetch_assoc($res)) {
    $html .= '<tr align="center">
    <td>'.$row['edName'].'</td>
    <td style="padding-left:10px;">'.number_format($row['employeeDeductionAmount'],2).'</td>
    
    ';
    $no++;
}
while($other_row = mysqli_fetch_assoc($other_res)) {
    $html .= '<tr align="center">
    <td>'.$other_row['employeeOtherDeductionName'].'</td>
    <td style="padding-left:10px;">'.number_format($other_row['employeeOtherDeductionAmount'],2).'</td>
    
    ';
    $other_no++;
}
$html .= '      <tr><th>Total Deductions</th>
                <td style="padding-left:10px;">'.number_format($fetched_difference,2).'</td>
    </tr>';
} else {
    $html .= '<tr aling="center"><td colspan="8">No Event</td></tr>';
}

   $html .= '</tbody></table></div>';

   $html .= '
   <!--Allowance-->
   
   <div class="column" style="padding-left:10px;float: left; width: 40%;">
    
   <table style=" font-family: arial, sans-serif;
                  border-collapse: collapse;">
<thead>
    <tr>
    
        <th>Earnings</th>
        <hr>
        <th style="padding-left:10px;">Amount</th>
        <hr>
    </tr>
</thead>
<tbody>';
   $link = mysqli_connect("localhost","root","","crud");
$nos = 1;
$qs = "SELECT * FROM `employeeallowance`  where employeeId='$emp_id'";

$allowance_results = $mysqli->query("SELECT employeeId, sum(employeeallowanceAmount) AS value_sum FROM employeeallowance where employeeId=$id") or die(mysqli->error);
while($allowance_rows = $allowance_results->fetch_assoc()) {
      
  $fetched_sum = $allowance_rows['value_sum'];
 
}
$current_employee_salary = $mysqli->query("SELECT * FROM data where id=$id") or die(mysqli->error);


  $gross_amount= $fetched_sum + $salary;
  
$ress = mysqli_query($link,$qs);
$rows = mysqli_num_rows($ress);
if($rows > 0) { 
while($rows = mysqli_fetch_assoc($ress)) {
    $html .= '<tr align="center">
    <td>'.$rows['eaName'].'</td>
    <td style="padding-left:10px;">'.number_format($rows['employeeallowanceAmount'],2).'</td>
    
    ';
    $nos++;
}
$html .= '   <tr><th>Salary </th>
<td style="padding-left:10px;">'.number_format($salary,2).'</td>
</tr>';
    $html .= '   <tr><th>Gross Amount </th>
    <td style="padding-left:10px;">'.number_format($gross_emp,2).'</td>
    </tr>';
} else {
    $html .= '<tr aling="center"><td colspan="8">No Event</td></tr>';
}

   $html .= '</tbody></table></div>
   </div>
   <br/>
   <br/>
   <div class="row">
   <div style="text-align:center;" class="col-md-4">Net Pay : '.number_format($nett_emp,2).'</div>
       <div style="text-align:center;" class="d-flex flex-column">
      '. $f->format($nett_emp,2).'</div>
   </div>
</div>
<br/>
<br/>
<br/>
<div class="d-flex justify-content-end" style="text-align:right;">
   <div class="d-flex flex-column mt-2"> <span class="fw-bolder"></span> <span class="mt-4">Authorised Signatory</span> </div>
</div>
<hr>
<div class="d-flex justify-content-end" style="text-align:center;">
   <div class="d-flex flex-column mt-2"> <span class="fw-bolder"></span> <span class="mt-4">This is a system generated payslip</span> </div>
</div>
   <style>.column {
    float: left;
    width: 50%;
  }
  
  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }
  .row {
    display: flex;
  }
  
  .column {
    flex: 50%;
  }
  </style>
  
  ';
  
   
$mpdf->WriteHTML($html);
$mpdf->Output();

?>
