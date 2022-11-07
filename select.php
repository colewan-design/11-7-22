<!DOCTYPE html>
<html>
<head>
	<title>Dynamic Select Menu</title>
	    <!-- BootStrap CSS CDN-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- JavaScript CDN For BootStrap  -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
   <div class="container">
      <div class="jumbotron">
         <div class="form-group">
            <select onchange="getPositionList(this.value)" id="project_list" class="custom-select">
               <option>Select Project</option>
            </select>
         </div>
         <div class="form-group">
            <select onchange="getModelList(this.value)" id="position_list" class="custom-select">
               <option>Select Position</option>
            </select>
         </div>
         
      </div>
   </div>
</body>

<script type="text/javascript">
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

   
</script>
</html>