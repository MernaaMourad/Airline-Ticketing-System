<?php session_start();
if (!isset($_SESSION["administrative_id"])) {
      
	echo '<script >';
	echo 'window.location="../greeting.php"';
	echo '</script>';
	exit;}
 if(!isset($_GET["id"])){echo '<script >';
	echo 'window.location="../greeting.php"';
	echo '</script>';
	exit;}
include('../db_connect.php');
$qry = $conn->query("SELECT * FROM booked_flight where id = ".$_GET['id']);
foreach($qry->fetch_array() as $k => $v){
	$$k = $v;
}
?>
<div class="container-fluid">	
	<div class="col-lg-12">
	<form action="" id="book-flight">
		<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
		<div class="row">
		<div class="row">
		<div class="form-group col-md-12">
			<label class="control-label">Passport number</label>
			<input type="text" name="passport_no" class="form-control" value="<?php echo $passport_no ?>"required>
		</div>
			<div class="col-md-6">
				<label class="control-label">Name</label>
				<input type="text" name="name" class="form-control" value="<?php echo $name ?>"required>
			</div>
			<div class="col-md-6">
				<label class="control-label">Contact Number</label>
				<input type="text" name="contact" class="form-control" value="<?php echo $contact ?>"required>
			</div>
		</div>

		
		</div>
		<div id="row-field">
			<div class="row ">
				<div class="col-md-12 text-center">
					<button class="btn btn-primary btn-sm " >Save</button>
					<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
		
	</form>
	</div>
</div>
<script>
	
	$('#book-flight').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=update_booked',
			method:"POST",
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1 ){

					alert_toast("Booked Flight successfully updated.","success")
					setTimeout(function(){
						location.reload();
					},1200)
				} 
				else{

alert_toast("please fill all details.","fail")
setTimeout(function(){
	location.reload();
},1200)
} 
			}
		}
		)
	})
</script>
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>