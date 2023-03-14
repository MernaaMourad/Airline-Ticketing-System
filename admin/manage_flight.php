<?php session_start();
if (!isset($_SESSION["administrative_id"])) {
      
	echo '<script >';
	echo 'window.location="../greeting.php"';
	echo '</script>';
	exit;}
 
 include '../db_connect.php' ?>
<?php 

if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM flight_details where flight_id=".$_GET['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k = $val;
	}
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-flight">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="" class="control-label">Airline</label>
						<select name="airline_id" id="airline_id" class="custom-select browser-default select2">
							<option></option>
							<?php 
							$airline = $conn->query("SELECT * FROM airlines_list order by airlines asc");
							while($row = $airline->fetch_assoc()):
							?>
								<option value="<?php echo $row['airline_id'] ?>" <?php echo isset($airline_id) && $airline_id == $row['airline_id'] ? "selected" : '' ?>><?php echo $row['airlines'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-8">
					<div class="form-group">
						<label for="">Plane No</label>
						<input type="text" name="plane_no" id="plane_no" value="<?php echo isset($plane_no) ? $plane_no : '' ?>" required>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
					<div class="">
						<label for="">Departure Location</label>
						<select name="departure_airport_id" id="departure_airport_id" class="custom-select browser-default select2">
							<option value=""></option>
						<?php
							$airport = $conn->query("SELECT * FROM airport_list order by airport asc");
						while($row = $airport->fetch_assoc()):
						?>
							<option value="<?php echo $row['airport_id'] ?>" <?php echo isset($departure_airport_id) && $departure_airport_id == $row['airport_id'] ? "selected" : '' ?>><?php echo $row['location'].", ".$row['airport'] ?></option>
						<?php endwhile; ?>
						</select>

					</div>
				</div>
				<div class="col-md-6">
					<div class="">
						<label for="">Arrival Location</label>
						<select name="arrival_airport_id" id="arrival_airport_id" class="custom-select browser-default select2">

							<option value=""></option>

						<?php
							$airport = $conn->query("SELECT * FROM airport_list order by airport asc");
						while($row = $airport->fetch_assoc()):
						?>
							<option value="<?php echo $row['airport_id'] ?>" <?php echo isset($arrival_airport_id) && $arrival_airport_id == $row['airport_id'] ? "selected" : '' ?>><?php echo $row['location'].", ".$row['airport'] ?></option>
						<?php endwhile; ?>
						</select>

					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
					<div class="">
						<label for="">Departure Data/Time</label>
						<input type="text" name="departure_date" id="departure_date" class="form-control datetimepicker" value="<?php echo isset($departure_date) ? date("Y-m-d H:i",strtotime($departure_date)) : '' ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="">
						<label for="">Arrival Data/Time</label>
						<input type="text" name="arrival_date" id="arrival_date" class="form-control datetimepicker" value="<?php echo isset($arrival_date) ? date("Y-m-d H:i",strtotime($arrival_date)) : '' ?>">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="">
						<label for="">Seats</label>
						<input name="seats" id="seats" type="number" step="any" class="form-control text-right" value="<?php echo isset($seats) ? $seats : '' ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="">
						<label for="">Adult Price</label>
						<input name="adult_price" id="adult_price" type="number" step="0.01" class="form-control text-right" value="<?php echo isset($adult_price) ? $adult_price : 0 ?>">
					</div>
				</div>
				<div class="col-md-6">
					<div class="">
						<label for="">Child Price</label>
						<input name="child_price" id="child_price" type="number" step="any" class="form-control text-right" value="<?php echo isset($child_price) ? $child_price : 0 ?>">
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('.select2').each(function(){
		$(this).select2({
		    placeholder:"Please select here",
		    width: "100%"
		  })
	})
	})
	 $('.datetimepicker').datetimepicker({
      format:'m/d/y',
  })
	 $('#manage-flight').submit(function(e){
	 	e.preventDefault()
		 var arrival_dateId = document.getElementById("arrival_date").value;	 
		 var departure_dateId = document.getElementById("departure_date").value;

		 if(arrival_dateId<departure_dateId){
			alert_toast("arrival date have to be after departure date","success");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)

		 }else{
	 	start_load()
	 	$.ajax({
	 		url:'ajax.php?action=save_flight',
	 		method:'POST',
	 		data:$(this).serialize(),
	 		success:function(resp){
	 			if(resp == 1){
	 				alert_toast("Flight successfully saved.","success");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)
	 			}
				 else if (resp==2){
	 				alert_toast("Flight successfully edited.","success");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)
	 			}
				 else if(resp==0){
					alert_toast("please fill all fields.","fail");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)

				 }else if (resp==3){
	 				alert_toast("can't edit flight","fail");
	 				setTimeout(function(e){
	 					location.reload()
	 				},1500)
	 			}else {
				alert_toast(resp,"fail");
			 }
	 		}
	 	})
	 }})
	 $('.datetimepicker').attr('autocomplete','off')
</script>