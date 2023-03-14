<?php
	
	if (!isset($_SESSION["administrative_id"])) {
	  echo '<script >';
	  echo 'window.location="../greeting.php"';
	  echo '</script>';
	  exit;
  }
 include('../db_connect.php');?>

<div class="container-fluid">
	
	<div class="col-lg-12">
		<div class="row">
			<!-- FORM Panel -->
			<div class="col-md-4">
			<form action="" id="manage-airlines">
				<div class="card">
					<div class="card-header">
						   Airlines Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Airlines</label>
								<textarea name="airlines" id="" cols="30" rows="2" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label for="" class="control-label">Logo</label>
								<input type="file" class="form-control" name="img" onchange="displayImg(this,$(this))">
							</div>
							<div class="form-group">
								<img src="" alt="" id="cimg">
							</div>
							<div class="form-group">
								<label class="control-label">Package weight</label>
								<input type="number" step="o.1" class="form-control" name="package_weight" required>
							</div>
							
							<div class="form-group">
								<label class="control-label">Package width</label>
								<input type="number" step="o.1" class="form-control" name="package_width" required>
							</div>
							<div class="form-group">
								<label class="control-label">package height</label>
								<input type="number" step="o.1" class="form-control" name="package_height" required>
							</div>
							
							
					</div>
							
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			</div>
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Image</th>
									<th class="text-center">Name</th>
									<th class="text-center">package_weight</th>
									<th class="text-center">package_width</th>
									<th class="text-center">package_height</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$cats = $conn->query("SELECT * FROM airlines_list order by airline_id asc");
								while($row=$cats->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									<td class="text-center">
										<img src="../assets/img/<?php echo $row['logo_path'] ?>" alt="">
									</td>
									<td class="">
										 <b><?php echo $row['airlines'] ?></b>
									</td>
									<td class="">
										 <b><?php echo $row['package_weight'] ?></b>
									</td>
									<td class="">
										 <b><?php echo $row['package_width'] ?></b>
									</td>
									<td class="">
										 <b><?php echo $row['package_height'] ?></b>
									</td>
									<td class="text-center">
										<button class="btn btn-sm btn-primary edit_airline" type="button" data-id="<?php echo $row['airline_id'] ?>">Edit</button>
										<button class="btn btn-sm btn-danger delete_airline" type="button" data-id="<?php echo $row['airline_id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<style>
	
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height: :150px;
	}
</style>
<script>
	function _reset(){
		$('#cimg').attr('src','');
		//$('[name="img"]').val('');
		$('[name="id"]').val('');
		$('#manage-airlines').get(0).reset();
	}
	
	$('#manage-airlines').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_airlines',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){					
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				/*	else if(resp==2){
						alert_toast("Data successfully updated",'success')
						setTimeout(function(){
							location.reload()
						},1500)

					}


					else{
						alert_toast(resp,'fail')
						//alert_toast("Can't be updated",'fail')
						setTimeout(function(){
							location.reload()
						},1500)

					} */
			}
		})
	})

	$('.edit_airline').click(function(){
	uni_modal('Edit Airline','manage_airlines.php?id='+$(this).attr('data-id'))})

	$('.delete_airline').click(function(){
		_conf("Are you sure to delete this airline?","delete_airline",[$(this).attr('data-id')])
	})
	function displayImg(input,_this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        	$('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
	function delete_airline($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_airlines',
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
					//alert_toast(resp,'success')
                  
					alert_toast("Data can't be deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)


				}
				
			}
		})
	}
</script>