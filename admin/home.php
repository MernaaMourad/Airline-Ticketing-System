<?php 
	if (!isset($_SESSION["administrative_id"])) {
	  echo '<script >';
	  echo 'window.location="../greeting.php"';
	  echo '</script>';
	  exit;
  }?>


<div class="containe-fluid">

	<div class="row">
		<div class="col-lg-12">
			
		</div>
	</div>

	<div class="row mt-3 ml-3 mr-3">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
				<?php echo "Welcome back  ".$_SESSION['firstname'].','.$_SESSION['lastname'] ."!"  ?>
									
				</div>
				<hr>
				<div class="row">
				
				</div>
			</div>
			
		</div>
		</div>
	</div>

</div>
<script>
	
</script>