<!DOCTYPE html>
<?php require 'archive_query.php'?>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<a class="navbar-brand" href="https://sourcecodester.com">Sourcecodester</a>
		</div>
	</nav>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">PHP - Simple Auto Archive Data</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<a href="index.php" class="pull-right">Main Page</a>
		<br /><br />
		<table class="table table-bordered">
			<thead class="alert-info">
				<tr>
                <th>Name</th>
                <th>Start</th>
                <th>End</th>
                <th>Gross</th>
                <th>Deductions</th>
                <th>Nett</th>
                <th>Actions</th>
				</tr>
			</thead>
			<?php
                 $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));       
                 $result = $mysqli->query("SELECT * FROM archive") or die(mysqli->error);
                 
                    while($row = $result->fetch_assoc()):

                ?>
                <tr>
                    <td><?php echo $row['employee_name']; ?></td>
                    <td><?php echo $row['from_date']; ?></td>
                    <td><?php echo $row['to_date']; ?></td>
                    <td><?php echo number_format($row['gross_emp'],2); ?></td>
				
                    <td><?php echo number_format( $row['deduction_emp'],2); ?></td>
                    <td><?php echo number_format( $row['nett_emp'],2); ?></td>
                    <td>
                       
                
                       
                        <select class="selectpicker ass" data-width="fit" id="xyz" onChange="window.location.href=this.value">
                        <option value="" disabled selected hidden>Actions</option>
                        <option  class="btn-sm" target="_blank"  value="mpdf.php?edit=<?php echo $row['id']; ?>" data-content="<i class='fas fa-eye' aria-hidden='true'></i>&nbspView">View</option>
                            
						<option  class="btn-sm"  value="payslip_download.php?edit=<?php echo $row['id']; ?>" data-content="<i class='fas fa-download' aria-hidden='true'></i>&nbspDownload">Download</option>
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
			</tbody>
		</table>
	</div>
</body>	
</html>