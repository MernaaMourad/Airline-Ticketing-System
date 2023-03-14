<?php session_start();
    if (!isset($_SESSION["customer_id"])) {
      
      echo '<script >';
      echo 'window.location="greeting.php"';
      echo '</script>';
      exit;}
    else if(!isset($_GET["id"])){echo '<script >';
      echo 'window.location="greeting.php"';
      echo '</script>';
      exit;}?>
<div class="container-fluid">
	<div class="col-lg-12">
	 <form action="" name="Form"  id="book-flight"> 
	<!-- <form id="book-flight" name="Form" method="POST" action="" onsubmit="; >-->
		<input type="hidden" name="flight_id" value="<?php echo $_GET['id'] ?>">
		
		<div class="form-group row" id="qty">
			<div class="col-md-3">
			<label for="" class="control-label">Person/s</label>
			<input type="number" class="form-control text-right" min="2" value="1" id="count" max="<?php echo $_GET['max'] ?>">
			
		</div>
		</form>
			<div class="col-md-2">
			<label for="" class="control-label">&nbsp;</label>
			<!-- <button class="btn btn-primary btn-block" type="button" id="go" onclick ='window.location="index.php?page=home"'>Go</button> -->
			<button class="btn btn-primary btn-block" type="button" id="go">Go</button> 
			</div>
			<div class="col-md-2">
			<label for="" class="control-label">&nbsp;</label>
			<button class="btn btn-secondary btn-block" type="button" data-dismiss="modal" >Cancel</button>
			</div>
		</div>
	
		<div id="row-field" style="display: none">
			<div class="row ">
				<div class="col-md-12 text-center">
				
					<button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
					</form>
				</div>
			</div>
		</div>		
	    
	</div>
</div>




<script >
	$('#go').click(function(){
		start_load()
		if(<?php echo $_GET['max'] ?> < $('#count').val()){
			alert("The number of person can't be greater than the available flight seats.")
					end_load()
			return false;
		}
		else{
		
	    window.location="Booking.php?flight_id=<?php echo $_GET['id'] ?>&count="+$('#count').val();
        	
	    }
	})
          
		   </script>
		   
		   
<style>
	#uni_modal .modal-footer{
		display: none
	}
</style>


