<?php
//subdomain.php
include('database_connection.php');

include('function.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}

// if($_SESSION['type'] != 'Admin')
// {
// 	header('location:user.php');
// }

include('header.php');

?>
<div class="container px-5 my-5 py-5">
	<span id="alert_action"></span>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-md-10">
                			<h3 class="panel-title">Course Sub Domain List</h3>
                		</div>
                		<div class="col-md-2" align="right">
                			<button type="button" name="add" id="add_button" class="btn btn-success btn-xs">Add</button>
                		</div>
                	</div>
                </div>
                <div class="panel-body">
                	<table id="subdomain_data" class="table table-bordered table-striped">
                		<thead>
							<tr>
								<th>ID</th>
								<!-- <th>Course Type</th> -->
								<th>Course Sub Domain</th>
								<th>Status</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
                	</table>
                </div>
            </div>
        </div>
    </div>

    <div id="subdomainModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="subdomain_form">
    			<div class="modal-content">
    				<div class="modal-header">
    					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Sub Domain</h4>
    				</div>
    				<div class="modal-body">
    					<div class="form-group">
							<label>Enter Sub Domain Name</label>
							<input type="text" name="subdomain_name" id="subdomain_name" class="form-control" required />
						</div>
    				</div>
    				<div class="modal-footer">
    					<input type="hidden" name="subdomain_id" id="subdomain_id" />
    					<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
</div>
<script>
$(document).ready(function(){

	$('#add_button').click(function(){
		$('#subdomainModal').modal('show');
		$('#subdomain_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Sub Domain");
		$('#action').val('Add');
		$('#btn_action').val('Add');
	});


	$(document).on('submit','#subdomain_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"subdomain_action.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#subdomain_form')[0].reset();
				$('#subdomainModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				subdomaindataTable.ajax.reload();
			}
		})
	});

// Update Button Features		

	$(document).on('click', '.update', function(){
		var subdomain_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:'subdomain_action.php',
			method:"POST",
			data:{subdomain_id:subdomain_id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{
				$('#subdomainModal').modal('show');
				$('#subdomain_name').val(data.subdomain_name);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit Sub Domain");
				$('#subdomain_id').val(subdomain_id);
				$('#action').val('Edit');
				$('#btn_action').val('Edit');
			}
		})
	});


// Delete Button Features	

	$(document).on('click','.delete', function(){
		var subdomain_id = $(this).attr("id");
		var status  = $(this).data('status');
		var btn_action = 'delete';
		if(confirm("Are you sure you want to change status?"))
		{
			$.ajax({
				url:"subdomain_action.php",
				method:"POST",
				data:{subdomain_id:subdomain_id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
					subdomaindataTable.ajax.reload();
				}
			})
		}
		else
		{
			return false;
		}
	});


	var subdomaindataTable = $('#subdomain_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"subdomain_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				// "targets":[4, 5],
				"targets":[3, 4],
				"orderable":false,
			},
		],
		"pageLength": 10
	});

});
</script>


<?php
include('footer.php');
?>