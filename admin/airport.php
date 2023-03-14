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
			<form action="" id="manage-airports">
				<div class="card">
					<div class="card-header">
						   Airport's Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Airport</label>
								<textarea name="airport" id="" cols="30" rows="2" class="form-control" required></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Location</label>
								<textarea name="location" id="" cols="30" rows="2" class="form-control" required></textarea>
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
									<th class="text-center">Airport</th>
									<th class="text-center">Locoation</th>
								<!--	<th class="text-center">Action</th> -->
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$sql = $conn->query("SELECT * FROM airport_list order by airport_id  asc");
								while($row=$sql->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><?php echo $i++ ?></td>
									
									<td class="">
										 <b><?php echo $row['airport'] ?></b>
									</td>

									<td class="">
										 <b><?php echo $row['location'] ?></b>
									</td>
									<td class="text-center">
									<!--	<button class="btn btn-sm btn-primary edit_airport" type="button" data-id="<?php /* echo $row['airport_id'] ?>" data-airport="<?php echo $row['airport'] ?>" data-location="<?php echo $row['location'] */?>" >Edit</button> -->
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
		//$('#cimg').attr('src','');
		$('[name="id"]').val('');
		$('#manage-airports').get(0).reset();
	}
	
	$('#manage-airports').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_airports',
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
				/*else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}*/
			}
		})
	})
	/*$('.edit_airport').click(function(){
		start_load()
		var cat = $('#manage-airports')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='airport']").val($(this).attr('data-airport'))
		cat.find("[name='location']").val($(this).attr('data-location'))
		end_load()
	})*/

</script>