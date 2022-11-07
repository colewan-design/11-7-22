<?php require_once("config.php");
require ("archive_query.php");
require_once("process.php"); 
if(!isset($_SESSION["login_sess"])) 
{
    header("location:login.php"); 
}
  $email=$_SESSION["login_email"];
  $findresult = mysqli_query($dbc, "SELECT * FROM users WHERE email= '$email'");
if($res = mysqli_fetch_array($findresult))
{
$username = $res['username']; 
$fname = $res['fname'];   
$lname = $res['lname'];  
$email = $res['email'];  
$image= $res['image'];
}

 


 ?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Employees | CBOO</title>

		<!-- Site favicon -->
		<link rel="icon" type="image/x-icon" href="src/images/dash.png">

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>
		<script src="https://kit.fontawesome.com/dd09e290e6.js" crossorigin="anonymous"></script>
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="src/styles/media.css">

        <link rel="stylesheet" href="style2.css">
    
    
	</head>
	<body>
	<div class="header" style=" border: 1px solid #008B8B;background:#1E90FF;">
			<div class="header-left">
				<div style="color:white;" class="menu-icon bi bi-list"></div>
				<a style="padding-left:2rem;" href="">BSU-CBOO Payroll - Admin</a>
			</div>
			<div class="header-right">
				<div class="mr-20 user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<!--<img src="" alt="" /> profile image here-->
								<div>
               
            <?php if($image==NULL)
                {
                 echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                } else { echo '<img src="images/'.$image.'" style="height:52px;width:52px;border-radius:50%;">';}?> 

<p></p>
  
                </div>
							</span>
							<span style="color:white;" class="user-name"><?php echo $fname ." " .$lname; ?></span>
						</a>
						<div 
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="account.php"
								><i class="dw dw-user1"></i> My Account</a
							>
							
							<a class="dropdown-item" href="login.php"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar" >
		<div class="brand-logo" style=" border-bottom: 1px solid grey;">
				<a href="index.php">
					
					<img
						src="images/cboo.png" style="box-shadow: 0px 0px 8px 2px grey;height:50px;width:50px;border-radius:50%;"
						alt="sample"
						class="light-logo"
					/>
					<span style="font-size:14px;margin-left:1rem;color:white;"class="mtext">BSU-CBOO Payroll</span>
				</a>
			
			</div> 
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
				<ul id="accordion-menu">
						<li>
							<a href="index.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Dashboard</span>
							</a>
						</li>
                       
                   

						<li>
							<a href="employees.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-people"></span
								><span class="mtext">Employee List</span>
							</a>
						</li>
						<li>
						<a href="#" class="dropdown-toggle">
								<span class="micon bi bi-calculator"></span
								><span class="mtext">Payslips</span>
							</a>
							<ul class="submenu">
							<li><a href="payslips.php">Add New Payslip</a></li>
								<li><a href="payslip_data.php">History</a></li>
								
							</ul>
						</li>
						<li>
							<a href="#">
								<p class="mtext">Maintenance</p>
							</a>
						</li>
						<li>
							<a href="salary_matrix.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-grid-3x2"></span
								><span class="mtext">Salary Matrix</span>
							</a>
						</li>
						<li>
							<a href="position.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-pin-map"></i></span
								><span class="mtext">Position</span>
							</a>
						</li>
						<li>
							<a href="#" class="dropdown-toggle">
								<span class="micon bi bi-calculator"></span
								><span class="mtext">Calculations</span>
							</a>
							<ul class="submenu">
								<li><a href="incentives.php">Incentives</a></li>
								<li><a href="deductions.php">Mandatory Deductions</a></li>
								<li><a href="other_deductions.php">Other Deductions</a></li>
								<li><a href="#">Add Record</a></li>
							</ul>
						</li>
					
						<li>
							<a href="pay_report.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-envelope-paper"></i></span
								><span class="mtext">Payroll Report</span>
							</a>
						</li>
						<li>
							<a href="user_log.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-envelope-paper"></i></span
								><span class="mtext">User log</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<!-- Export Datatable start -->
					<div class="card-box mb-30">
						<div class="pd-20 pb-10 d-flex justify-content-center">
							<h4 class="text h4">List of Payrolls</h4>
						</div>
						<form action="payslips.php" >
                        <div style="margin-left: 7px;"class="pd-10 pr-20 d-flex justify-content-start">
							<button type="submit" class="btn btn-primary"><i class='fas fa-plus'></i>&nbsp Create New</button>
						</div>
                        </form>
						
                        <form action="" onchange="window.open(this.value, '_blank')">
						<div class="pb-20">
                        <table id="tableid" class="table hover  data-table-export nowrap  ">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>ID</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Employee</th>
                            <th>Type</th>
							<th>Gross</th>
							<th>Salary</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                <?php
                 $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
                 $result = $mysqli->query("SELECT * FROM payroll_list") or die(mysqli->error);
				
                    while($row = $result->fetch_assoc()):

                ?>
                <tr>
                    <td><?php echo $row['payroll_id']; ?></td>
                    <td><?php echo $row['payroll_from']; ?></td>
                    <td><?php echo $row['payroll_to']; ?></td>
                    
					<td><?php $emp_id = $row['emp_id'];
					 echo $row['emp_id']; ?></td>
					<td><?php 
					$payroll_type = $row['payroll_type']; 
					if ($payroll_type == 1){
						echo 'Monthly';
					}
					if ($payroll_type == 0){
						echo 'Semi-Monthly';
					}
					?></td>
					<td>
					<?php 
					$fresh = mysqli_query($mysqli, "SELECT * FROM data WHERE id= '$emp_id'");
			
				
					if($res = mysqli_fetch_array($fresh))
					{	
						
						$salary = $res['salary']; 
						echo $salary; 
					}    
					$allowance_results = $mysqli->query("SELECT employeeId, sum(employeeallowanceAmount) AS value_sum FROM employeeallowance where employeeId=$emp_id") or die(mysqli->error);
					while($allowance_rows = $allowance_results->fetch_assoc()) {
							
						$fetched_sum = $allowance_rows['value_sum'];
					
					}
					$current_employee_salary = $mysqli->query("SELECT * FROM data where id=$emp_id") or die(mysqli->error);
					
					$bad_symbols = array(",", ".");
					$salary = str_replace($bad_symbols, "", $salary);
						$gross_amount= $fetched_sum + $salary;
						echo number_format($fetched_sum,2);
					?>

					</td>
					<td>
						
					</td>
                 
                    <td>
                       
                
                       
                        <select class="selectpicker ass" data-width="fit" id="xyz" onChange="window.location.href=this.value">
                        <option value="" disabled selected hidden>Actions</option>
                        <option  class="btn-sm" target="_blank"  value="merged.php?edit=<?php echo $row['id']; ?>" data-content="<i class='fas fa-eye' aria-hidden='true'></i>&nbspView">View</option>
                            
						<option  class="btn-sm"  value="payslip_download.php?edit=<?php echo $row['id']; ?>" data-content="<i class='fas fa-download' aria-hidden='true'></i>&nbspDownload">Download</option>
						<option  class="btn-sm"  value="employee-details.php?edit=<?php echo $row['emp_id']; ?>" data-content="<i class='fas fa-edit' aria-hidden='true'></i>&nbspEdit">Edit</option>
			
						<option  class="btn-sm"  value="process.php?payslipDelete=<?php echo $row['id']; ?>" data-content="<i class='fas fa-trash' aria-hidden='true'></i>&nbspDelete">Delete</option>
			
                        </select>
						<script>
							<script>

								window.onload = function(){
									window.open(url, "_blank"); // will open new tab on window.onload
								}
								</script>
						</script>
                       
                    </td>
                </tr>
                <?php endwhile;  ?>
               

                </table>
						</div>
						</form>
					</div>
					<!-- Export Datatable End -->
				</div>
				<div class="footer-wrap pd-20 mb-20 card-box">
					@ BSU-CMPS
				</div>
			</div>
		</div>
       <style>
         select#xyz {
   border:0px;
   outline:0px;
   color:var(--link-color);
}
.fa-download {
		color: purple;
		}
       </style>
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<!-- buttons for Export datatable -->
		<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
		<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
		<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
		<!-- Datatable Setting js -->
		<script src="vendors/scripts/datatable-setting.js"></script>
	</body>
</html>
