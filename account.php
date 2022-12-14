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
?>
<!DOCTYPE html>
<html>
<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Deductions</title>

		<!-- Site favicon -->
		<link rel="icon" type="image/x-icon" href="src/images/dash.png">

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css"/>
		<link rel="stylesheet" type="text/css" href="src/styles/style.css" />
		<link rel="stylesheet" type="text/css" href="src/styles/media.css">
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
							<a class="dropdown-item" href="#"
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
            $result = $mysqli->query("SELECT * FROM deductions") or die(mysqli->error);
             
            ?>
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
							<a href="#;" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-envelope-paper"></i></span
								><span class="mtext">Payroll Report</span>
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
					
				<div class="card-box mb-30" style="width: 100%;left:3rm;">
				<div class="pd-20 pb-10 d-flex justify-content-center">
							<h4 class="text h4"></h4><br>
                        </div>
						
						
						<div>
       
						<div>
							
					<form style=" width:100%;" action="" method="POST" enctype='multipart/form-data'>
					<div class="login_form">

					<?php 
					if(isset($_POST['update_profile'])){
					$fname=$_POST['fname'];
					$lname=$_POST['lname'];  
					$username=$_POST['username']; 
					$folder='images/';
					$file = $_FILES['image']['tmp_name'];  
					$file_name = $_FILES['image']['name']; 
					$file_name_array = explode(".", $file_name); 
					$extension = end($file_name_array);
					$new_image_name ='profile_'.rand() . '.' . $extension;
					if ($_FILES["image"]["size"] >10000000) {
					$error[] = 'Sorry, your image is too large. Upload less than 10 MB in size .';

					}
					if($file != "")
					{
					if($extension!= "jpg" && $extension!= "png" && $extension!= "jpeg"
					&& $extension!= "gif" && $extension!= "PNG" && $extension!= "JPG" && $extension!= "GIF" && $extension!= "JPEG") {
					
					$error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';   
					}
					}

					$sql="SELECT * from users where username='$username'";
						$res=mysqli_query($dbc,$sql);
					if (mysqli_num_rows($res) > 0) {
					$row = mysqli_fetch_assoc($res);

					if($oldusername!=$username){
						if($username==$row['username'])
						{
							$error[] ='Username already Exists. Create Unique username';
							} 
					}
					}
				if(!isset($error)){ 
						if($file!= "")
						{
						$stmt = mysqli_query($dbc,"SELECT image FROM  users WHERE email='$email'");
						$row = mysqli_fetch_array($stmt); 
						$deleteimage=$row['image'];
					unlink($folder.$deleteimage);
					move_uploaded_file($file, $folder . $new_image_name); 
					mysqli_query($dbc,"UPDATE users SET image='$new_image_name' WHERE email='$email'");
							}
							$result = mysqli_query($dbc,"UPDATE users SET fname='$fname',lname='$lname',username='$username' WHERE email='$email'");
							if($result)
							{
						
							}
							else 
							{
							$error[]='Something went wrong';
							}

   					}


						}    
						if(isset($error)){ 

					foreach($error as $error){ 
					echo '<p class="errmsg">'.$error.'</p>'; 
					}
					}


					?> 
					<?php 
						ob_start();
				if(isset($_POST['change_password'])){
				$currentPassword=$_POST['currentPassword']; 
				$password=$_POST['password'];  
				$passwordConfirm=$_POST['passwordConfirm']; 
				$sql="SELECT password from users where email='$email'";
				$res = mysqli_query($dbc,$sql);
					$res=mysqli_query($dbc,$sql);
						$row = mysqli_fetch_assoc($res);
					if(password_verify($currentPassword,$row['password'])){
				if($passwordConfirm ==''){
							$error[] = 'Please confirm the password.';
						}
						if($password != $passwordConfirm){
							$error[] = 'Passwords do not match.';
						}
						if(strlen($password)<5){ // min 
							$error[] = 'The password is 6 characters long.';
						}
						
						if(strlen($password)>20){ // Max 
							$error[] = 'Password: Max length 20 Characters Not allowed';
						}
				if(!isset($error))
				{
					$options = array("cost"=>4);
					$password = password_hash($password,PASSWORD_BCRYPT,$options);

					$result = mysqli_query($dbc,"UPDATE users SET password='$password' WHERE email='$email'");
						if($result)
						{
							echo "<p style='color:green;border:solid;'>" . "Your password has been successfully updated!" . "</p>";
						}
						else 
						{
							$error[]='Something went wrong';
						}
				}

						} 
						else 
						{
							$error[]='Current password does not match!'; 
						}   
					}
						if(isset($error)){ 

				foreach($error as $error){ 
				echo '<p class="errmsg">'.$error.'</p>'; 
				}
				}
				ob_end_flush();
						?> 
					<form method="post" enctype='multipart/form-data' action="">
						<div >
						<div></div>
						<div > 
						<center>
						<?php if($image==NULL)
							{
							echo '<img src="https://technosmarter.com/assets/icon/user.png">';
							} else { echo '<img src="images/'.$image.'" style="height:150px;width:150px;border-radius:50%;">';}?> 
							<div class="form-group">
							<label>Change Profile Picture &#8595;</label>
							<div class="col-sm-12 col-md-4 col-form-label" >
							<input class="form-control" type="file" name="image" style="width:100%;" >
							</div>
						</div>

						</center>
						
						</div>
						
						</div>
						</div>


						<div  class="form-group">
						<label class="col-sm-12 col-md-4 col-form-label">Name</label>
						<div class="col-sm-12 col-md-12">
						<input  type="text" name="fname" value="<?php echo $name;?>" class="form-control" required>
						</div>
						</div>
                                                   


						
					


						<div class="form-group">
						<label class="col-sm-12 col-md-4 col-form-label">Email</label>
						<div class="col-sm-12 col-md-12">
						<input type="text" name="username" value="<?php echo $email;?>" class="form-control" required>
						</div>
						</div>

				

					
						
						<div class="col-sm-6" style="left:20rem;bottom:0rem;">
						<button class="btn btn-success" name="update_profile">Save Profile</button>

						</div>
						<div class="col-sm-4" style="left:30rem;bottom:2.9rem;">
						
						<a href="change-password.php"><button type="button" class="btn btn-warning">Change Password</button></a>
          				</div>

						<!--The Modal -->
						
						
						
						</form>
						</div>
						<div class="col-sm-3">
						</div>
						</div>
										
						</div>


					
					

			
					
					
					<!-- Export Datatable End -->
				</div>
			
			</div>
		</div>
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
