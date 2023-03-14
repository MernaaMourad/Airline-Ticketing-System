<?php include '../db_connect.php' ?>
<?php 
session_start();
if (!isset($_SESSION["administrative_id"])) {
      
	echo '<script >';
	echo 'window.location="../greeting.php"';
	echo '</script>';
	exit;}
 if(!isset($_GET["id"])){echo '<script >';
	echo 'window.location="../greeting.php"';
	echo '</script>';
	exit;}
    if(isset($_GET['id'])){
        $airline= $conn->query("SELECT * FROM airlines_list where airline_id =".$_GET['id']);
   
        foreach($airline->fetch_array() as $k =>$v){
            $meta[$k] = $v;
            
        }}
   


?>

<div class="col-md-12">
			<form action="" id="manage-airliness">
				<div class="card">
					<div class="card-header">
						   Airlines Form
				  	</div>
					<div class="card-body">
							<input type="hidden" name="id"  class="form-control" value="<?php echo isset($meta['airline_id']) ? $meta['airline_id']: '' ?>">
							<div class="form-group">
								<label class="control-label">Airlines</label>
								<input type="text" name="airlines" id="airlines" cols="30" rows="2" class="form-control" name="airlines" class="form-control" value="<?php echo isset($meta['airlines']) ? $meta['airlines']: '' ?>" required>
							</div>
							
							<div class="form-group">
								<label class="control-label">Package weight</label>
								<input type="number" step="o.1" class="form-control" name="package_weight" class="form-control" value="<?php echo isset($meta['package_weight']) ? $meta['package_weight']: '' ?>" required>
							</div>
							
							<div class="form-group">
								<label class="control-label">Package width</label>
								<input type="number" step="o.1" class="form-control" name="package_width" class="form-control" value="<?php echo isset($meta['package_width']) ? $meta['package_width']: '' ?>" required>
							</div>
							<div class="form-group">
								<label class="control-label">package height</label>
								<input type="number" step="o.1" class="form-control" name="package_height" class="form-control" value="<?php echo isset($meta['package_height']) ? $meta['package_height']: '' ?>" required>
							</div>
							
							
					</div>
							
					<!--<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
								<button class="btn btn-sm btn-default col-sm-3" type="button" onclick="_reset()"> Cancel</button>
							</div>
						</div>
					</div>-->
				</div>
			</form>
			</div>
            


<script>
	/*$(document).ready(function(){
		$('.select2').each(function(){
		$(this).select2({
		    placeholder:"Please select here",
		    width: "100%"
		  })
	})
	})
	 $('.datetimepicker').datetimepicker({
      format:'Y-m-d H:i',
  })*/
	 $('#manage-airliness').submit(function(e){
	 	e.preventDefault()
	 	start_load()
		 
	 	$.ajax({
	 		url:'ajax.php?action=edit_airline',
	 		method:'POST',
	 		data:$(this).serialize(),
			 
		    
	 		success:function(resp){
	 			if(resp == 1){
	 				alert_toast("Airline successfully edited.","success");
	 				setTimeout(function(){
	 					location.reload()
	 				},1500)
	 			}
                
	 		}
	 	})
	 }
	 )
	 
</script>