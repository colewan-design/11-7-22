<?php require_once("config.php");
if(!isset($_SESSION["login_sess"])) 
{
    header("location:login.php"); 
}
  $email=$_SESSION["login_email"];
  $findresult = mysqli_query($dbc, "SELECT * FROM users WHERE email= '$email'");
if($res = mysqli_fetch_array($findresult))
{
$role = $res['role']; 
$username = $res['username']; 
$fname = $res['fname'];   
$lname = $res['lname'];  
$email = $res['email'];  
$image= $res['image'];
$admin_id= $res['id'];
}

 ?> 
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Dashboard | CBOO</title>

		<!-- Site favicon -->
		<link rel="icon" type="image/x-icon" href="src/images/dash.png">
		<!-- Mobile Specific Metas -->
		<meta
			name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"
		/>
		<script src="https://kit.fontawesome.com/dd09e290e6.js" crossorigin="anonymous"></script>
		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="src/styles/media.css">


        
	</head>
	<body>
	<?php if ($role == 'admin') {?>
		<div class="header" style="box-shadow: 0px 5px 25px grey; border: 1px solid #008B8B;background:#1E90FF;">
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
							
							<a class="dropdown-item" href="logout.php?logout=true&admin_id=<?php echo $admin_id; ?>"
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
				
					<img class="light-logo"
					id="picture" src="images/cboo.png" style="height:50px;width:50px;border-radius:50%;"
						alt="System Logo"
						onMouseOver="this.style.box-shadow='#F8F8F8'" onMouseOut="this.style.box-shadow='#FFFFFF'"
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
								<li><a href="payslip_data.php">Payroll list</a></li>
								
							</ul>
						</li>
						<li>
							<a href="#">
								<span class="mtext">Maintenance</span>
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
						<li>
							<a href="create_user.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-envelope-paper"></i></span
								><span class="mtext">Create user</span>
							</a>
						</li>
					</ul>
                     <!--php code here-->
                <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT * FROM data") or die(mysqli->error);
             
            ?>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
        <div class="header-title">
                    <h2 style=" display: inline-block;" >CBOO Payroll Management System</h2>
                  
					<hr>
                    	<div style=" display: inline-block;">Payroll Period:</div>
                        <div style=" display: inline-block;"id="month"class="month"></div>
                        <div style=" display: inline-block;"id="year" class="year"></div>
						
                </div>
				<hr>
			<div class="xs-pd-20-10 pd-ltr-20 ">
				<div class=" title pb-20 d-flex justify-content-center">
					
					
				</div>

				<div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?php echo mysqli_num_rows($result); ?></div>
									<div class="font-14 text-secondary weight-500">
										 Employees
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00eccf">
										<i class="icon-copy fa fa-users" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">
                                    <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT sum(employeeallowanceAmount) as value_sum from employeeallowance") or die(mysqli->error);
            while($allowance_rows = mysqli_fetch_array($result)) {
                
                $fetched_sum = $allowance_rows['value_sum'];
               
            }

            
            ?> <?php echo number_format($fetched_sum,2); ?>
                                    </div>
									<div class="font-14 text-secondary weight-500">
										Total Gross Amount
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
										<i class="icon-copy fa fa-calculator" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">
                                    <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result_deduction = $mysqli->query("SELECT sum(employeeDeductionAmount) as value_difference from employeeDeductions") or die(mysqli->error);
            while($deduction_rows = mysqli_fetch_array($result_deduction)) {
                
                $fetched_deduction = $deduction_rows['value_difference'];
               
            }
            $net_amount = $fetched_sum - $fetched_deduction;
            
            ?> <?php echo number_format($fetched_deduction,2); ?>
                                    </div>
									<div class="font-14 text-secondary weight-500">Total Deductions</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#09cc06">
										<i class="icon-copy bi bi-person-dash-fill"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?php echo number_format($net_amount,2); ?></div>
									<div class="font-14 text-secondary weight-500">
										Total Net Amount
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon">
									<i class='fas fa-peso-sign'></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--letterhead -->
			<div>
				
			</div>

<div>    

    <div style="font-weight:10;font-family: Arial, Helvetica, sans-serif;display:inline-block;font-size:14px;position: absolute; bottom: 5px;">
   <b>	Copyright &copy; 2022.</b> <div style="display:inline-block;color:grey;"> All rights reserved. </div>
    </div>
</div>
			<div >
				
		</div>		
		</div>
		<!--User side--> 
		<?php }else { 
			header("location: user_payslip.php");
			 } ?>
		
        <style>
            .date-card{
  border:1px solid #ddd;
  width:200px;
  padding:10px;
  display:flex;
  align-items:center;
}

.date-card .day{
  font-size:48px;
  margin:0px 10px;
  color:#2ab6b6;
}

.date-card .month{
  font-weight:bold;
}
/* remove the horizontal scroll bar*/


img:hover {
      box-shadow: 0px 5px 25px white;
        </style>
        <script>
          const month = ["January","February","March","April","May","June","July","August","September","October","November","December"];

const d = new Date();
let name = month[d.getMonth()];
document.getElementById("month").innerHTML = name;

document.getElementById("year").innerHTML = new Date().getFullYear();


document.getElementById("day").innerHTML = d.getDate();
   </script>
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	</body>
</html>
