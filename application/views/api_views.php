<!DOCTYPE html>
<html>
<head>
	<title>Rest api using codeigniter</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/dataTables.bootstrap4.min.css">
</head>
<body>
<div style="height: 50px;"></div>
<div class="container">
<div class="row">
  <div class="col-md-12">
  	  <div class="col-md-6">
  	  	 <button type="button" class="btn btn-info btn-xs" id="add_button">Add</button>
  	  	 <button type="button" class="btn btn-info btn-xs" id="filter-data">Filter Data</button>
  	  </div>
  	  <div class="col-md-6">
  	  	 <label>Select role</label>
           <select name="role_type" id="mySelect" class="form-control float-right">
           	<option value="Project Manager">Project Mnager</option>
           	<option value="Admin">Admin</option>
           	<option value="Task Manger">Task Manger</option>
           	<option value="Client">Client</option>
           </select>
           
  	  </div>
  </div>

</div>
<hr>
<div class="row">
    <div class="col-md-12">
    	<section class="container">
	        <div class="panel panel-primary">
				<div class="panel-heading">
	             <!--  <i class="fa fa-bar-chart fa-lg"></i> <strong>Rest Api Data</strong> -->
	            </div>
				<div class="panel-body">
					<span id="success_message"></span>
	                <table id="example" class="table table-striped table-bordered" style="width:100%" style="display: block;">
				        <thead>
				            <tr>
				                <th>First name</th>
				                <th>Last name</th>
				                <th>Email</th>
				                <th>Phone No</th>
				                <th>Role Type</th>
				                <th>From date</th>
				                <th>To date</th>
				                <th>Edit</th>
				                <th>Delete</th>
				            </tr>
				        </thead>
				        <tbody>
				            
				        </tbody>
				       
	                </table>
	                 <table id="filter" class="table table-striped table-bordered" style="width:100%;">
				        <thead>
				            <tr>
				                <th>First name</th>
				                <th>Last name</th>
				                <th>Email</th>
				                <th>Phone No</th>
				                <th>Role Type</th>
				                <th>From date</th>
				                <th>To date</th>
				                <th>Edit</th>
				                <th>Delete</th>
				            </tr>
				        </thead>
				        <tbody>
				            
				        </tbody>
				       
	                </table>
	            </div>
	        </div>
        </section>  
    </div>
    
  </div>
</div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script  src="<?php echo base_url() ?>assets/jquery.dataTables.min.js"></script>
<script  src="<?php echo base_url() ?>assets/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<!-- <script type="text/javascript">
	$(document).ready(function() {
    $('#filter').DataTable();
} );
</script> -->
<script type="text/javascript">
	$(document).ready(function(){
       function get_data()
       {
       	 $.ajax({
       	 	url:"<?php echo base_url() ?>test_api/action",
       	 	method:"POST",
       	 	data:{data_action:'fetch_all'},
       	 	success:function(data)
       	 	{
       	 		var x = document.getElementById("filter");
       	 		  x.style.display = "none";
       	 		$('tbody').html(data);
       	 	}
       	 })
       }

       get_data();

       $("#add_button").click(function()
       {
       	$("#user_form")[0].reset();
        $("#userModal").modal("show");
        $(".modal-title").text("Add User");
        $("#action").val("Add");
        $("#data_action").val("Insert");

       });
       $('#action').click(function(e){
         var form = $("form").serialize();
        // alert(form);
        e.preventDefault();
         $.ajax({
         	    method:"POST",
                url:"<?php echo base_url() ?>test_api/action",
                data:form,
                dataType:"json",
                success:function(data)
                {
                    if (data.success) 
                    {  
                       $("#user_form")[0].reset();
                       $("#userModal").modal("hide");
                        get_data();
                         if ($("#data_action").val()=="Insert") 
                         {
                         	$("#success_message").html("<div class='alert alert-success'>Data Inserted</div>");
                         }
                    }
                    if (data.error) 
                    {
                            $('#first_name_error').html(data.first_name_error);
                            $('#last_name_error').html(data.first_name_error);
                            $('#email_error').html(data.email_error);
                            $('#password_error').html(data.password_error);
                            $('#phone_no_error').html(data.phone_no_error);
                            $('#role_type_error').html(data.role_type_error);
                            $('#from_date_error').html(data.from_date_error);
                            $('#to_date_error').html(data.to_date_error);
                    }
                }

        })
       
    });
      
      
      $(document).on('click','.edit',function(){
         var user_id=$(this).attr('id');
         $.ajax({
         	method:"POST",
         	url:"<?php echo base_url() ?>test_api/action",
         	data:{user_id:user_id,data_action:'Fetch_single'},
         	dataType:"json",
         	success:function(data)
         	{
         		$("#userModal").modal('show');
         		$("#first_name").val(data.first_name);
         		$("#last_name").val(data.last_name);
         		$("#email").val(data.email);
         		$("#password").val(data.password);
         		$("#phone_no").val(data.phone_no);
         		$("#role_type").val(data.role_type);
         		$("#from_date").val(data.from_date);
         		$("#to_date").val(data.to_date);
         		$(".modal-title").text("Edit User");
         		$("#user_id").val(data.user_id);
         		$("#action").val("Edit");
         		$("#data_action").val("Edit");
         	}
         })
      })  

      $('.edit').click(function(e){
         var form = $("form").serialize();
       // alert(form);
        e.preventDefault();
         $.ajax({
         	    method:"POST",
                url:"<?php echo base_url() ?>test_api/update",
                data:form,
                dataType:"json",
                success:function(data)
                {
                    if (data.success) 
                    {  
                       //$("#user_form")[0].reset();
                       $("#userModal").modal("hide");
                        get_data();
                         if ($("#data_action").val()=="Edit") 
                         {
                         	$("#success_message").html("<div class='alert alert-success'>Data Updated</div>");
                         }
                    }
                    if (data.error) 
                    {
                            $('#first_name_error').html(data.first_name_error);
                            $('#last_name_error').html(data.first_name_error);
                            $('#email_error').html(data.email_error);
                            $('#password_error').html(data.password_error);
                            $('#phone_no_error').html(data.phone_no_error);
                            $('#role_type_error').html(data.role_type_error);
                            $('#from_date_error').html(data.from_date_error);
                            $('#to_date_error').html(data.to_date_error);
                    }
                }

        })
       
    });
      $(document).on('click','.delete',function(){
        var user_id=$(this).attr('id');
        
        if (confirm("Are you sure you want to delete this?")) 
        {
        	 $.ajax({
        	 	url:"<?php echo base_url() ?>test_api/action",
       	      	method:"POST",
       	 	    data:{user_id:user_id,data_action:'Delete'},
                success:function(data)
                {
                   if (data.success) 
                    {
                    	 get_data();
                        $("#success_message").html("<div class='alert alert-success'>Data deleted</div>");
                         
                    }
                }

          })
        }

      })  
     
     $("#filter-data").click(function()
       {
          var role_type=document.getElementById("mySelect").value;
           $.ajax({
       	 	url:"<?php echo base_url() ?>test_api/action",
       	 	method:"POST",
       	 	data:{role_type:role_type,data_action:'filter'},
       	 	success:function(data)
       	 	{
       	 		/*var x = document.getElementById("filter");
       	 		  x.style.display = "block";*/
       	 		  $('tbody').html(data);
       	 	}
       	 })
         
       });
	});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>

<div id="userModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <form action="" id="user_form">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<div class="modal-title"><h4>Add User</h4></div>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      	<div class="form-group">
      	  <label>First Name</label>
          <input type="text" name="first_name" id="first_name" class="form-control">
          <span id="first_name_error" class="text-danger"></span>
        </div>
        <div class="form-group">
        	<label>Last Name</label>
           <input type="text" name="last_name" id="last_name" class="form-control" >
          <span id="last_name_error" class="text-danger"></span>
        </div>
        <div class="form-group"> 
           <label>Email</label>
           <input type="text" name="email" id="email" class="form-control">
          <span id="email_error" class="text-danger"></span>
        </div>
        <div class="form-group">
        	<label>Password</label>
           <input type="password" name="password" id="password" class="form-control">
          <span id="password_error" class="text-danger"></span>
        </div>
        <div class="form-group">
          <label>Phone no</label>
          <input type="text" name="phone_no" id="phone_no" class="form-control">
          <span id="phone_no_error" class="text-danger"></span>
        </div>
        <div class="form-group">
        	<label>Select role</label>
           <select name="role_type" id="role_type" class="form-control">
           	<option value="Project Manager">Project Mnager</option>
           	<option value="Admin">Admin</option>
           	<option value="Task Manger">Task Manger</option>
           	<option value="Client">Client</option>
           </select>
          <span id="role_type_error" class="text-danger"></span>
        </div>
        <div class="form-group">
          <label>From date</label>
          <input type="date" name="from_date" id="from_date" class="form-control">
          <span id="from_date_error" class="text-danger"></span>
        </div>
         <div class="form-group">
          <label>To date</label>
          <input type="date" name="to_date" id="to_date" class="form-control">
          <span id="to_date_error" class="text-danger"></span>
        </div>
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="user_id" id="user_id">
        <input type="hidden" name="data_action" id="data_action" value="Insert">
        <input type="submit" name="action" id="action" class="btn btn-success edit" value="Add">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
   </form>
  </div>
</div>