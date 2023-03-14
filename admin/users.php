<?php if (!isset($_SESSION["administrative_id"])) {
	  echo '<script >';
	  echo 'window.location="../greeting.php"';
	  echo '</script>';
	  exit;}

?>

<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
	</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">first_name</th>
					<th class="text-center">last_name</th>
					<th class="text-center">gender</th>
					<th class="text-center">email</th>
					<th class="text-center">pwd</th>
					<th class="text-center">phone_no</th>
					<th class="text-center">address</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include '../db_connect.php';
 					$users = $conn->query("SELECT * FROM customer order by first_name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td>
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo $row['first_name'] ?>
				 	</td>
					 <td>
				 		<?php echo $row['last_name'] ?>
				 	</td>
					 <td>
				 		<?php echo $row['gender'] ?>
				 	</td>
				 	<td>
				 		<?php echo $row['email'] ?>
				 	</td>
					 <td>
				 		<?php echo $row['pwd'] ?>
				 	</td>
					 <td>
				 		<?php echo $row['phone_no'] ?>
				 	</td>
					 <td>
				 		<?php echo $row['address'] ?>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['customer_id'] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['customer_id'] ?>'>Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<script>
	
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
		_conf("Are you sure to delete this user?","delete_user",[$(this).attr('data-id')])
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else{

                   alert_toast("Data can't be deleted",'fail')
					setTimeout(function(){
						location.reload()
					},1500)


				}
			}
		})
	}
</script>