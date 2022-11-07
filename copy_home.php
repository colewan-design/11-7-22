<?php
require_once("config.php");
if(!isset($_SESSION["login_sess"])) 
{
    header("location:login.php"); 
}
  $email=$_SESSION["login_email"];
  $findresult = mysqli_query($dbc, "SELECT * FROM users WHERE email= '$email'");
if($res = mysqli_fetch_array($findresult))
{
$oldusername =$res['username'];     
$username = $res['username']; 
$fname = $res['fname'];   
$lname = $res['lname'];  
$email = $res['email'];  
$image= $res['image'];
$admin_id= $res['id'];
}
$page = $_SERVER['PHP_SELF'];

require_once("process.php"); 


?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Employee List | CBOO</title>

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
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
						src="images/cboo.png" style="height:50px;width:50px;border-radius:50%;"
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
								><span class="mtext">Employees</span>
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
					</ul>
				</div>
			</div>
		</div>

		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					
					<div class="card-box mb-30">
					<div class="pd-20 pb-10 d-flex justify-content-center">
							<h4 class="text h4">List of Employees</h4>
						</div>
						<div style="margin-left: 7px;"class="pd-10 pr-20 d-flex justify-content-start">
							<button type="button" class="btn btn-secondary" data-toggle="modal" data-placement="top" title="Click if you want to insert a new employee record." data-target="#add-Employee"><i class='fas fa-plus'></i>&nbspAdd Employee</button>
						</div>
						<div style="margin-top:-4.1rem;margin-left: 10rem;" class="pd-10 pr-20 d-flex justify-content-start">
							<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#import-data" data-placement="top" title="Import CSV/Excel files only"><i class='fas fa-file-import'></i>&nbspImport</button>
						</div>
						<!--add employee modal -->
						<div class="modal fade" id="add-Employee" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title w-100 text-center" id="modalLabel">
													Add Employee
												</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													×
												</button>
											</div>
											<div class="modal-body">
												<form action="process.php" method="POST">
												<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">

													<div class="form-group">
													<span id="check-name"></span>
														<label class="col-sm-12 col-md-2 col-form-label">Name</label>
														<div class="col-sm-12 col-md-10">
															<input name="name"  class="form-control" type="text" placeholder="Enter Employee Name" onInput="checkName()" required>
														</div>
													</div>
                                                   
												
													<div class="form-group">
														<label class="col-sm-12 col-md-4 col-form-label">Salary Grade</label>
														<div class="col-sm-12 col-md-10">
															<input class="form-control" name="sg" type="number" placeholder="Enter Employee's Salary Grade" min="1" max="33" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-12 col-md-2 col-form-label">Step</label>
														<div class="col-sm-12 col-md-10">
															<input class="form-control" name="step" type="number" placeholder="Enter Employee's Step" min="1" max="8" data-bind="value:replyNumber" required>
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-12 col-md-2 col-form-label">Position</label>
														<div class="col-sm-12 col-md-10">
														<select name="positionName" class="selectpicker" required>
														<option value="">Select</option>
														<?php
													
														$resultss = $mysqli->query("SELECT * FROM position") or die($mysqli->error());
														while ($trow = mysqli_fetch_array($resultss)) {
															$trows[] = $trow;
														}
														foreach ($trows as $trow) {
															print "<option value='" . $trow['positionName'] . "'>" . $trow['positionName'] . "</option>";
														}
														?>
													</select>
														</div>
													</div>
                                                    <div>
                                                    <button style="margin-left: 1rem;" type="submit" name="save" id="save" class="btn btn-primary">
													Save changes
												    </button>
                                                    <button style="position: absolute; margin-left: 10rem; bottom: 1rem;" type="button" class="btn btn-secondary" data-dismiss="modal">
													Close
													</button>
                                                    </div>

												</form>
											</div>
											<div class="modal-footer">
												
											
											</div>
										</div>
									</div>
								</div>
								<!-- The Modal for Import -->
								<div class="modal fade" id="import-data" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title w-100 text-center" id="modalLabel">
												Import CSV file
												</h4>
												<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
													×
												</button>
											</div>
											<div class="modal-body">
												
											<div id="wrap">
											<div class="container">
												<div class="row">
													<div class="span3 hidden-phone"></div>
													<div class="span6" id="form-login">
														<form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
														<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
														<fieldset>
																<legend>Import CSV/Excel file</legend>
																<div class="control-group">
																	<div class="control-label">
																		<label>CSV/Excel File:</label>
																	</div>
																	<div class="controls">
																		<input type="file" name="file" id="file" class="input-large">
																	</div>
																</div>
										
																<div class="control-group">
																	<div class="controls">
																	<button style="margin-top:1rem;" type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Upload</button>
																	</div>
																</div>
															</fieldset>
														</form>
													</div>
													<div class="span3 hidden-phone"></div>
												</div>
										
												
											</div>
										
											</div>

												</form>
											</div>
											<div class="modal-footer">
												
												
											</div>
										</div>
									</div>
								</div>
						<div class="pb-20 table-responsive">		
						<table id="table" class="display nowrap table-bordered vertical">
                <thead class="bg-dark text-white">
                    <tr>
					<th data-placement="top" title="Employee Full Name" class="filter">Name</th>
					<th data-placement="top" title="Employee Current Position">Position</th>
					<th data-placement="top" title="Employee Current Salary Grade">Salary Grade</th>
					<th data-placement="top" title="Employee Current Salary Step">Step</th>
					<th data-placement="top" title="Employee Current Salary(basis has been taken from the salary grade and step)">Salary</th>
					<th data-placement="top" title="Add, Edit, Delete, Info, View">Action</th>
                    </tr>
                </thead>
				<?php
                    while($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td ><?php echo $row['name']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td><?php echo $row['sg']; ?></td>
                    <td><?php echo $row['step']; ?></td>
                    <td><?php echo $row['salary']; ?></td>
                    <td style="width:5rem;display: block;margin: auto;">
					<div class="dropdown">
					<button style="color:black"class="btn btn-link " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i style="text-align:center;justify-content:center;" class='fas fa-ellipsis-v'></i>
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="edit-record.php?edit=<?php echo $row['id']; ?>"><i class='fas fa-edit' aria-hidden='true'></i>&nbspEdit</a>
						<a class="dropdown-item" href="process.php?delete=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete<?php echo $row['id']; ?>"><i class='fas fa-trash' aria-hidden='true'></i>&nbspDelete</a>
						<a class="dropdown-item" href="employee-details.php?edit=<?php echo $row['id']; ?>"><i class='fas fa-envelope-open-text' aria-hidden='true'></i>&nbspInfo</a>
						<a class="dropdown-item" href="employee-pay.php?edit=<?php echo $row['id']; ?>"><i class='fas fa-eye' aria-hidden='true'></i>&nbspView</a>
					</div>
					</div>
                       
                    </td>
					
					<div class="modal fade" id="confirm-delete<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
							
							</div>
							<div class="modal-body">
								<p>Are you sure you want to delete this item?</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<a class="btn btn-danger btn-ok" href="process.php?admin_id=<?php echo $admin_id; ?>&delete=<?php echo $row['id']; ?>">Delete</a>
								
							</div>
						</div>
					</div>
				</div>
					</tr>
                <?php endwhile;  ?>
                
			</table>
			</div>
                        
		

			<style>
		table{
				table-layout:fixed;
			}
			#table thead tr:eq(1) th{
				table-layout:fixed;
			}
			
			.dataTable > thead > tr > th[class*="sort"]:before,
.dataTable > thead > tr > th[class*="sort"]:after {
    content: "" !important;
}
			td {
    border: 1px solid #000;
}

tr td:last-child {
    width: 1%;
    white-space: nowrap;
}

table {
  width: 100%;
}

th {
  height: 20px;
  width: 30px;
}


			
		</style>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function checkName() {
    
    jQuery.ajax({
    url: "process.php",
    data:'name='+$("#name").val(),
    type: "POST",
    success:function(data){
        $("#check-name").html(data);
    },
    error:function (){}
    });
}

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});


let temp = $("#btn1").clone();
$("#btn1").click(function(){
    $("#btn1").after(temp);
});

$(document).ready(function(){
    var table = $('#table').DataTable({
       orderCellsTop: true,
       fixedHeader: true 
	  
    });

    //create a row in the head of the table and clone it for each column
    $('#table thead tr').clone(true).appendTo( '#table thead' );

    $('#table thead tr:eq(1) th').each( function (i) {
		
        var title = $(this).text(); //name of the column
        $(this).html( '<input type="text" maxlength="10" size="10	"  />' );
		if (title == 'Action') {
			$(this).text('');  
			
        } else {
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
		}
    } );   
});

$(function(){
        var validation_el = $('<div>')
            validation_el.addClass('validation-err alert alert-danger my-2')
            validation_el.hide()
        $('input[name="name"]').on('input',function(){
            var name = $(this).val()
                $(this).removeClass("border-danger border-success")
                $(this).siblings(".validation-err").remove();
            var err_el = validation_el.clone()

                if(name == '')
                return false;

                $.ajax({
                    url:"validate.php",
                    method:'POST',
                    data:{name:name},
                    dataType:'json',
                    error:err=>{
                        console.error(err)
                        alert("An error occured while validating the data")
                    },
                    success:function(resp){
                        if(Object.keys(resp).length > 0 && resp.field_name == 'name'){
                            err_el.text(resp.msg)
                            $('input[name="name"]').addClass('border-danger')
                            $('input[name="name"]').after(err_el)
                            err_el.show('slideDown')
                            $('#save').attr('disabled',true)
                        }else{
                            $('input[name="name"]').addClass('border-success')
                            $('#save').attr('disabled',false)
                        }
                    }
                })
        })

    })

</script>


                        
					</div>
					<!-- Export Datatable End -->
				</div>
				<div class="footer-wrap pd-20 mb-20 card-box">
					@ BSU-CMPS
				</div>
			</div>
		</div>
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
