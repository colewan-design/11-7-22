<script>jQuery.noConflict();</script>
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
<html>  
    <head>  
  <title>CBOO | Employees</title>  
  <script src="https://kit.fontawesome.com/dd09e290e6.js" crossorigin="anonymous"></script>
		
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="src/styles/media.css">
  <style>
  .hide
  {
     display:none;
  }

  </style>
    </head>  
    <body> 
       
    <div class="main-container"> 
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
    <!--add employee button -->
    <button style="margin-bottom:1rem"type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	<i class='fas fa-user-plus'></i>
	</button>

	<!--import button -->
	<button style="margin-bottom:1rem"type="button" class="btn btn-primary" data-toggle="modal" data-target="#import-data">
	<i class="fa-solid fa-file-import"></i>
	</button>

	<!--employee data button -->
	<button style="margin-bottom:1rem"type="button" class="btn btn-primary" onclick="location.href='employee_data.php';">
	<i class="fa-solid fa fa-database"></i>
	</button>

	<!--generate payroll button -->
	<button style="float:right;margin-bottom:1rem"type="button" class="btn btn-primary" data-toggle="modal" data-target="#generate-payroll">
	<span class="icon-stack">
	<i class="fa-solid fa-peso-sign"></i>
	<i class="fa-solid fa-user"></i>
	</span>
	</button>

    <!--add employee modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process.php" method="POST">
		<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
		<div class="container">
			<!--new row -->
			<div class="row">
			<div class="col form-group">
			<span id="check-name"></span>
				<label >Name</label>
				<div >
					<input name="name"  class="form-control" type="text" placeholder="Enter Employee Name" onInput="checkName()" required>
				</div>
			</div>
      <div class="col form-group">
			<span id="check-name"></span>
				<label >ID Number</label>
				<div >
					<input name="id"  class="form-control" type="number" placeholder="Enter Employee Number" onInput="" required>
				</div>
			</div>
			
		
			<div class="col form-group">
				<label>Salary Grade</label>
				<div >
					<input class="form-control" name="sg" type="number" placeholder="Enter Employee's Salary Grade" min="1" max="33" required>
				</div>
			</div>
			</div>
			<!--new row -->
			<div class="row">
			<div class="col form-group">
				<label >Step</label>
				<div >
					<input class="form-control" name="step" type="number" placeholder="Enter Employee's Step" min="1" max="8" data-bind="value:replyNumber" required>
				</div>
			</div>
	
			<div class="col form-group">
			<label>Select Project</label>
				<select name="position_name" onchange="getPositionList(this.value)" id="project_list" class="custom-select">
				<option>Select Project</option>
				</select>
			</div>
			
			</div>
			<!--new row -->
			<div class="row">
				
			<div class="col form-group">
				<label>Type</label>
				<div class="form-check">
				<input class="form-check-input" type="radio" name="employee_type" value="T" id="radio_teaching">
				<label class="form-check-label" for="radio_teaching">
					Teaching Staff
				</label>
				</div>
				<div class="form-check">
				<input class="form-check-input" type="radio" name="employee_type" id="radio_non_teaching" value="NT" checked>
				<label class="form-check-label" for="radio_non_teaching">
					Non-Teaching Staff
				</label>
				</div>
			</div>
			<div class="col">
			
				<label>Select Position</label>
				<div class="form-group">
					<select name="project_name" onchange="getModelList(this.value)" id="position_list" class="custom-select">
					<option>Select Position</option>
					</select>
				</div>
         
				
			</div>
			</div>
			</div>
			<div>
			<button style="margin-left: 1rem;" type="submit" name="save" id="save" class="btn btn-primary">
			Save changes
			</button>
			<button style="position: absolute; margin-left:1rem; bottom: 1rem;" type="button" class="btn btn-secondary" data-dismiss="modal">
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
<!--import data modal -->
<div class="modal fade" id="import-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Excel File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form class="form-horizontal well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
		<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
		<fieldset>
				<legend>Import CSV/Excel file</legend>
				<div class="control-group">
					<div class="control-label">
						<label>CSV/Excel File:</label>
					</div>
					<div class="controls">
						<input type="file" accept=".csv, .xml, .xls" name="file" id="file" class="input-large">
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
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<!--generate payroll modal -->
<div class="modal fade" id="generate-payroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Payroll</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form class="form-horizontal well" action="process.php" method="post">
	  
		<div class="form-group"> <!-- from date picker-->                                              
		<label>From Date</label>
		<input class="form-control" name="payroll_from" type="date" required>
		</div>
		<div class="form-group">  <!-- to date picker-->    
		<label>To Date</label>
		<input class="form-control" name="payroll_to" type="date" required>
		</div>
		<div class="form-group">  <!-- payroll type (monthly / semi )-->    
		<label> Type</label>
		<select  class="custom-select"  name="payroll_type"  required>
		<option value="0">Semi Monthly</option>
		<option value="1">Monthly</option>
		</select>
		</div>
		<div>
		<button style="margin-left: 1rem;" type="submit" name="save_payroll" id="save_payroll" class="btn btn-primary">
		Save changes
		</button>
		<button style="position: absolute; margin-left:1rem; bottom: 1rem;" type="button" class="btn btn-secondary" data-dismiss="modal">
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
   <div class="table-responsive">  
   
    <div id="grid_table"></div>
   </div>  
  </div>
<style>
	.icon-stack {
 
  width: 100%;
  
}
.selectBox{
  width:140px;
  height:40px;
  border:0px;
  outline:none;
}
</style>
	


    </body>  
</html>  
<script>
	//function for getting the position which are covered under a selected project
	$(document).ready(function(){
       
       let tag ="projectList"; 
       let select_menu=$('#project_list')[0]; // this expression is same as document.getElementById('dynamic_menu')
       $.ajax({
            url:"ajax.php",
            dataType:"json",
            method:"post",
            data:{tag:tag},
            success:function(response){
                //alert(response.length);
                console.log($.isArray(response)); // if response is an array, this function will return true

                response.forEach((position,index)=>{
                    console.log(index,position);
                    var option = document.createElement("option");
                    option.value = position['id'];
                    option.text = position['project_name'];
                    select_menu.appendChild(option);
                })
            }
        })
	});
    
    //Getting position List on the basis of project_id
    function getPositionList(project_id)
    {
        let tag = "positionList";
        let positionMenu =$('#position_list')[0];

        //Removing all the old options from position list and model list and adding only one option in one go
        $('#position_list').empty().append('<option>Select position</option>');
   

        $.ajax({
            url:"ajax.php",
            dataType:"json",
            method:"post",
            data:{tag:tag,project_id:project_id},
            success:function(response){
                response.forEach((position,index)=>{
                    console.log(index,position);
                    var option = document.createElement("option");
                    option.value = position['id'];
                    option.text = position['position_name'];
                    positionMenu.appendChild(option);
                })
            }
        })
    }

	//fucntion for employee name validation
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
    $('#grid_table').jsGrid({
     width: "100%",
     height: "600px",

     
     filtering: true,
    
     editing: true,
     sorting: true,
    
     autoload: true,
     pageSize: 10,
     pageButtonCount: 5,
     deleteConfirm: "Do you really want to delete data?",

     controller: {
      loadData: function(filter){
       return $.ajax({
        type: "GET",
        url: "fetch_data.php",
        data: filter
       });
      },
      insertItem: function(item){
       return $.ajax({
        type: "POST",
        url: "fetch_data.php",
        data:item
       });
      },
      updateItem: function(item){
       return $.ajax({
        type: "PUT",
        url: "fetch_data.php",
        data: item
       });
      },
      deleteItem: function(item){
       return $.ajax({
        type: "DELETE",
        url: "fetch_data.php",
        data: item
       });
      },
     },

     fields: [
      {
       name: "id",
    type: "hidden",
    css: 'hide'
      },
      {
       name: "name",
       title: "Employee Name",  
    type: "text", 
    width: 150, 
    validate: "required"
      },
      {
       name: "sg", 
       title: "SG",  
    type: "text", 
    width: 150, 
    validate: "required"
      },
      {
       name: "step", 
       title: "STEP",  
    type: "text", 
    width: 50, 
    validate: function(value)
    {
     if(value > 0)
     {
      return true;
     }
    }
      },
      {
       name: "salary", 
       title: "Salary",  
       type: "text", 
      width: 150, 
      validate: "required"
      },
      {
       name: "position", 
       title: "Position",  
       type: "text", 
      width: 150, 
      validate: "required"
      },
	
      {
       type: "control"
      }
     ]

    });
	//check from data table if employee name already exist, go to validate.php
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
