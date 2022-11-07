<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];

$password = $_SESSION['password'];

if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
		$image = $fetch_info['image'];
		$name = $fetch_info['name'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
require_once("process.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Payslips | CBOO</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
		<!-- Site favicon -->
		<link rel="icon" type="image/x-icon" href="src/images/dash.png">

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>
		<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- Google Font -->

		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="src/styles/media.css">
		<script>
			//script for date theme
		$( function() {
			$( "#from_datepicker" ).datepicker();
		} );
		$( function() {
			$( "#to_datepicker" ).datepicker();
		} );
		</script>
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
							<span style="color:white;" class="user-name"><?php echo $name; ?></span>
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
			<div class="menu-block customscroll" >
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
								<span class="micon fa fa-history"></i></span
								><span class="mtext">User log</span>
							</a>
						</li>
						<li>
							<a href="create_user.php" class="dropdown-toggle no-arrow">
								<span class="micon fa fa-user-plus"></i></span
								><span class="mtext">Create user</span>
							</a>
						</li>
						<li>
							<a href="employee_data.php" class="dropdown-toggle no-arrow">
								<span class="micon fa fa-database"></i></span
								><span class="mtext">Employee Data</span>
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
					
					<div class="card-box mb-30">
						
										<?php
							$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
							$result = $mysqli->query("SELECT * FROM data") or die(mysqli->error);
							
							?>
						
					
							<?php 
							function pre_r($array){
							

								echo '<pre>';
								print_r($array);
								echo '</pre>';
							}
							?>
							<?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT * FROM position") or die(mysqli->error);
             
            ?>
					
						
                        
					</div>
                    
                    <div class="card-box mb-30" style="padding-bottom:1rem;">
                    <div class="pd-20 pb-10 d-flex justify-content-center">
							<h4 class="text h4">New Payslip</h4>
                        </div>
					<label style="" class="col-md col-form-label font-weight-bold">Select Employee Name </label><br>
					<!--form to get the employee ID and return data -->
                       			 <form action="" method="GET">
							
                         
                                <div class="col-md">
                                    
									<select name="id" class="selectpicker" required>
											<option>Select</option>
											<?php
										
											$resultss = $mysqli->query("SELECT * FROM data") or die($mysqli->error());
											while ($trow = mysqli_fetch_array($resultss)) {
												$trows[] = $trow;
											}
											foreach ($trows as $trow) {
												print "<option value='" . $trow['id'] . "'>" . $trow['name'] . "</option>";
											}
											?>
										</select>
                                </div>
								</form>
								<!--form to be submitted to process.php -->
								<form action="process.php" method="POST">
									<div class="container">
										<div class="row">
										<div style=""class="col" data-provide="datepicker">
										<p class="font-weight-bold"> Select Payroll Range</p>                     
										<label for="payroll_from" class="" >From</label>
										<input placeholder="Select Range" data-language='en' type="date" name="payroll_from" required>
									
										<label for="payroll_to" class="">To</label>
										<input placeholder="Select Range" data-language='en' type="date" name="payroll_to" required>
										</div>
								
										
							
										
										</div>
									</div>
							
							
							
                      
                        
					
                   
                    <div class="row">
                            <div class="col-md-5">
                             
                                <?php 
                                    $con = mysqli_connect("localhost","root","","crud");

                                    if(isset($_GET['id']))
                                    {
                                        $id = $_GET['id'];

                                        $query = "SELECT * FROM data WHERE id='$id' ";
                                        $query_run = mysqli_query($con, $query);
										
                                        if(mysqli_num_rows($query_run) > 0)
                                        {
                                            foreach($query_run as $row)
											
                                            {
                                                ?>
												<div style="padding-left:1rem;" class="form-group">
												<input type="hidden" name="id" value="<?= $row['id']; ?>">
												
												<input type="hidden" name="name" value="<?= $row['name']; ?>">

											
											
												
										
												<input type="hidden" name="sg" value="<?= $row['sg']; ?>">
										
												<input type="hidden" name="step" value="<?= $row['step']; ?>">
												
												
												<input type="hidden" name="position" value="<?= $row['position']; ?>">

												
                                                </div>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "No Record Found";
                                        }
                                    }
                                   
                                ?>

                            </div>
							
                        </div>
						
                   	
                 
													
                                                  

				
                  
                    
                    <?php
                    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
                    $result = $mysqli->query("SELECT * FROM employeedeductions where employeeId=$id") or die(mysqli->error);
                    $results = $mysqli->query("SELECT * FROM employeeotherdeductions where employeeId=$id") or die(mysqli->error);
                    
                    ?>
                    
                   
                     
                    
                    <?php
            $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
            $result = $mysqli->query("SELECT * FROM employeeallowance where employeeId=$id") or die(mysqli->error);
             
            ?>
                   
								<div style="padding-left:5rem;" class="form-group">
                        <table id="tableid" class="table  table-bordered table-sm" style=" background:white;width: calc(60vw - 320px);">
                   
               
                <?php
                    while($row = $result->fetch_assoc()):
                ?>
              
                <?php endwhile;  ?>
               
                
              
                <?php 
                $fresh = mysqli_query($mysqli, "SELECT * FROM data WHERE id= '$id'");
			
				
                if($res = mysqli_fetch_array($fresh))
                {	
                   
					$salary = $res['salary']; 
                }?>
                
               
                </table>
                 
                    </div>
                    </div> 
                 
                    <div class="card-box mb-30" style="padding-bottom:1rem;">
                    <div class="pd-20 pb-10 d-flex ">
					
							
                                                        
							
                                <label class="col-sm-12 col-md-4 col-form-label"><b>Gross Pay 

                                <?php
                                
                               
                                
                                $allowance_results = $mysqli->query("SELECT employeeId, sum(employeeallowanceAmount) AS value_sum FROM employeeallowance where employeeId=$id") or die(mysqli->error);
                                while($allowance_rows = $allowance_results->fetch_assoc()) {
                                        
                                    $fetched_sum = $allowance_rows['value_sum'];
                                
                                }
                                $current_employee_salary = $mysqli->query("SELECT * FROM data where id=$id") or die(mysqli->error);
                                
								$bad_symbols = array(",", ".");
								$salary = str_replace($bad_symbols, "", $salary);
                                    $gross_amount= $fetched_sum + $salary;
                                    echo number_format($gross_amount,2);
                                ?>

                                </b></label>
								<input type="hidden" name="gross_amount" value="<?php echo $gross_amount ?>">

                        <label  class="col-sm-12 col-md-4 col-form-label"><b>Total Deductions 
							
                        <?php
         
   
                        
                        $deduction_results = $mysqli->query("SELECT employeeId, sum(employeeDeductionAmount) AS value_difference FROM employeedeductions where employeeId=$id") or die(mysqli->error);
                        while($deduction_rows = $deduction_results->fetch_assoc()) {
                            
                        $fetched_difference = $deduction_rows['value_difference']; 
                        $total_deductions = number_format($fetched_difference,2);
					
                        }
						$other_deduction_results = $mysqli->query("SELECT employeeId, sum(employeeOtherDeductionAmount) AS other_value_difference FROM employeeotherdeductions where employeeId=$id") or die(mysqli->error);
                        while($other_deduction_rows = $other_deduction_results->fetch_assoc()) {
                            
                        $fetched_other_difference = $other_deduction_rows['other_value_difference']; 
                        $other_total_deductions = number_format($fetched_other_difference,2);
						
                        }
						//get total amount of deduction from employee deductions table
						$final_deduction = $fetched_difference + $fetched_other_difference;
						echo number_format($final_deduction,2);//print total deduction
                        $net_amount = $gross_amount - $final_deduction; 
                        ?>
                            </b></label>
                        <label class="col-sm-12 col-md-4 col-form-label"><b>Net Pay <?php echo number_format($net_amount,2); ?><b></label>
						<input type="hidden" name="net_amount" value="<?php echo $net_amount ?>">		
						<input type="hidden" name="final_deduction" value="<?php echo $final_deduction ?>">			
                                                  

					
                    </div>
					<?php
					
						
					 if ($update == true):
                 	?>
                    <div style="left:63rem;bottom:3rem;"class="col-md-4">
                    <button type="submit" name="updatePayslip" class="btn btn-primary">Update</button>
                	</div>
					<?php else: ?>
					<div style="left:63rem;bottom:3rem;"class="col-md-4">
                    <button type="submit" name="savePayroll" class="btn btn-primary">Save</button>
                	</div>
					<?php endif; ?>
					
				</div>
               
        </form>  
		
                    </div>
					<!-- Export Datatable End -->
				
				<div class="footer-wrap pd-20 mb-20 card-box">
					@ BSU-CMPS
				</div>
			</div>
		</div>
		<script>
			// Allow Only One Checkbox to be Checked using jQuery
		$(document).ready(function(){
			$('input:checkbox').click(function() {
				$('input:checkbox').not(this).prop('checked', false);
			});
		});
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

      <script>
		$('select').change(function ()
{
    $(this).closest('form').submit();
});
	  </script>
	  <style>
		html, body {
  max-width: 100%;
  overflow-x: hidden;
}
	  </style>
</body>
</html>
