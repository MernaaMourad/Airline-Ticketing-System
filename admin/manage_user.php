<?php session_start();
if (!isset($_SESSION["administrative_id"])) {
      
	echo '<script >';
	echo 'window.location="../greeting.php"';
	echo '</script>';
	exit;}

include('../db_connect.php');
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM customer where customer_id =".$_GET['id']);

foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	
	<form action="" id="manage-user">
		<input type="hidden" name="id" value="<?php echo isset($meta['customer_id']) ? $meta['customer_id']: '' ?>">
		<div class="form-group">
			<label for="first_name">First name</label>
			<input type="text" pattern="[A-Za-z]{1,32}" name="first_name" id="first_name" class="form-control" value="<?php echo isset($meta['first_name']) ? $meta['first_name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="last_name">Last_name</label>
			<input type="text" pattern="[A-Za-z]{1,32}" name="last_name" id="last_name" class="form-control" value="<?php echo isset($meta['last_name']) ? $meta['last_name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="gender">gender</label>
			<select name="gender" id="gender" class="custom-select">
				<option value= 'M' <?php echo isset($meta['gender']) && $meta['gender'] == 'M' ? 'selected': '' ?>>Male</option>
				<option value= 'F' <?php echo isset($meta['gender']) && $meta['gender'] == 'F' ? 'selected': '' ?>>Female</option>
			</select>
		</div>
	<!--	<div class="form-group">
						  <label for="email" class="control-label">Email</label>
  							<input type="email" id="email" name="email" class="form-control "required>
  						</div> -->
		<div class="form-group">
			<label for="">Email</label>
			<input type="email" name="email" id="email" class="form-control" value="<?php echo isset($meta['email']) ? $meta['email']: '' ?>" required>
		</div> 
		<div class="form-group">
			<label for="">Password</label>
			<input type="password" name="pwd" id="pwd" class="form-control" value="<?php echo isset($meta['pwd']) ? $meta['pwd']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="">phone number</label>
			<input type="text"  name="phone_no" id="phone_no" class="form-control" value="<?php echo isset($meta['phone_no']) ? $meta['phone_no']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="">Address</label>
			<input type="text" name="address" id="address" class="form-control" value="<?php echo isset($meta['address']) ? $meta['address']: '' ?>" required>
		</div>
	</form>
</div>
<script>

	$('#manage-user').submit(function(e){
		
		e.preventDefault();
		var emailId = document.getElementById("email");
		 var valid = emailId. checkValidity();
		 var	 name1Id = document.getElementById("first_name");
		var valid1 = name1Id. checkValidity();
		var name2Id = document.getElementById("last_name");
		var valid2 = name2Id. checkValidity();
	
		  if (!valid) {alert_toast("Invalid email",'fail')
					setTimeout(function(){
						location.reload()
					},1500) }



		 			 else if (!valid1 || !valid2 ) {alert_toast("Invalid name",'fail')
						setTimeout(function(){
							location.reload()
						},1500) }
						
						else {





						
		start_load()
	
		
	
		$.ajax({
			
			url:'ajax.php?action=save_user',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else if(resp==2){
					alert_toast("Data successfully edited",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				else if(resp==3){
					alert_toast("email already exists",'fail')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				else if(resp==0){
					alert_toast("please fill all data",'fail')
					setTimeout(function(){
						location.reload()
					},1500)
				}
				
			}
		})
	}})
</script>