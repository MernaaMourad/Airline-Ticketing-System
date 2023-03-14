<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('db_connect.php');
    
    if (!isset($_SESSION["customer_id"])) {
      
      echo '<script >';
      echo 'window.location="greeting.php"';
      echo '</script>';
      exit;}
    if(!isset($_GET['count'])){
      echo '<script >';
      
      echo 'window.location="greeting.php"';
      echo '</script>';
    exit;
  }

    ob_start();
    include('header.php');
    

	$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($query as $key => $value) {
		if(!is_numeric($key))
			$_SESSION['setting_'.$key] = $value;
	}
    ob_end_flush();
    ?>
    <script>
        function validateForm() {
          
           $contacts = document.forms["Form"]["contact"].value;
           foreach ($contacts	as $contact){
            $valid = $contact.checkValidity()
            if (!valid) {alert_toast("Invalid contact number",'fail')
					setTimeout(function(){
						location.reload()
					},1500) }
           }


           $names = document.forms["Form"]["name"].value;
           foreach ($names	as $name){
            $valid2 = $name.checkValidity()
            if (!valid2) {alert_toast("Invalid name",'fail')
					setTimeout(function(){
						location.reload()
					},1500) }

          }
        }
        </script>
    <style>
    	header.masthead {
		  background: url(assets/img/<?php echo $_SESSION['setting_cover_img'] ?>);
		  background-repeat: no-repeat;
		  background-size: cover;
		}
    </style>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg fixed-top py-3 bg-info" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./"><?php echo $_SESSION['setting_name'] ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=flightsList"></span>Flight List</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">About</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=yourtickets">Your Tickets</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login_Registration/logout.php">Logout</a></li>
                        
                       
                    </ul>
                </div>
            </div>
        </nav>
       
       
       

<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-righ t"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div id="preloader"></div>
        <footer class="bg-info py-5">
            <br>
            <div class="container"><div class="small text-center text-muted"> <?php echo $_SESSION['setting_name'] ?></div></div>
        </footer>
        
       <?php include('footer.php') ?>
    </body>

</html>

	<form name="Form" class="form-horizontal" method="POST" action="" onsubmit="return validateForm();">

<?php $_GET['count']?>
<?php for($i = 0; $i < $_GET['count']; $i++ ): ?>
<hr>
<div class="row">
	<div class="col-md-6">
		<label class="control-label">Name</label>
		<input type="text"  pattern="[A-Za-z]{1,32}" name="name[]" class="form-control" required>
	</div>
	<div class="col-md-6">
		<label class="control-label">Contact Number: (xxx-xx-xxx)</label>
		<input type="text" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" name="contact[]" class="form-control" required>
	</div>

	<div class="col-md-6">
		<label class="control-label">Package_weight</label>
		<input type="number" step="0.01" name="Package_weight[]" class="form-control">
	</div>

	<div class="col-md-6">
		<label class="control-label">Package_height</label>
		<input type="number" step="0.01"  name="Package_height[]" class="form-control">
	</div>
	
	<div class="col-md-6">
		<label class="control-label">Package_width </label>
		<input type="number" step="0.01" name="Package_width[]" class="form-control">
	</div>

	
    <br><div class="col-md-1">
	<label class="control-label">Type</label>
	<br><select style="width: 100px" name='type[]' onchange='' required>
                            <?php

                            

                            //$rw=mysqli_fetch_assoc($rs);
                   
                            $array = array();
                            //$rw=mysqli_fetch_assoc($rs);


                            
                                $array[] = "adult";
								                $array[] = "child";
                            


                            foreach ($array as $value) {

                                echo "<option value\"$value\">$value</option>";
                            }
                            ?>
                        </select></br>

					</div></br>


	<!--<br><div class="form-group">
	<br><label for="type" class="control-label">Type:
            (Adult default)</label></br>
				</div>
			<div class="form-group">
					
        if (!empty($_GET['type'])) {
                $selected[] = $_GET['type'];
            } else {
                 $selected[] = 'Adult';
                }
                ?></br>
                <br><label>
                    <input type="radio" name="type[]" value="Adult"/> Adult 
                </label>
                <label>
                            <input type="radio" name="type[]" value="Child"/> Child
                        </label></br>
					</br>
						</div> -->
<div class="form-group col-md-6">
	<label class="control-label">Passport Number</label>
	<input type="text" name="passport_no[]" class="form-control"required></textarea>
</div>
</div>		
<?php endfor; ?>
<center><input class="btn btn-primary" type="submit" name="Book_now" value="Book now">
</center></form>
<?php
if (isset($_POST['Book_now'])){
	$flight_id=$_GET['flight_id'];
  
	$count=$_GET['count'];
/*

foreach( $_POST as $name ) { if( is_array( $name ) ) 
	{ foreach( $name  ) { $countAdult=$countAdult+1; echo $name; } } else { $countChild=$countChild+1; echo $countChild; } }

}*/
    
  
  $names = $_POST['name'];
	$contacts = $_POST['contact'];
	$Package_weights=$_POST['Package_weight'];
	$Package_heights=$_POST['Package_height'];
	$Package_widths=$_POST['Package_width'];
	$passport_nos=$_POST['passport_no'];
	$types=$_POST['type'];
  if (isset($_SESSION["way"])) {
$way=$_SESSION['way'];} else { $way=1;}
  $customer_id=$_SESSION['customer_id'];
  $_SESSION['flight_id']=$flight_id;


  $Adultcount=0;
	$childcount=0;
	$adult="adult";



		foreach ($types	as $type){
          if($type==$adult){$Adultcount=$Adultcount+1;}
		  else{$childcount=$childcount+1;}	
	
	}


	$query = "SELECT * FROM flight_details WHERE (flight_id=$flight_id)";
        $res = $conn->query($query);
        $rw = $res->fetch_array();
        if ($res == TRUE) {
            $airline_id = $rw['airline_id'];
            $adult_price = $rw['adult_price'];
            $child_price   = $rw['child_price'];   }
	$query2 = "SELECT * FROM airlines_list WHERE (airline_id=$airline_id)";
	$ress = $conn->query($query2);
	$row = $ress->fetch_array();
	if ($ress == TRUE) {
		$package_weight = $row['package_weight'];
		$package_height = $row['package_height'];
		$package_width = $row['package_width'];


	}



for($i = 0; $i < $_GET['count']; $i++ ){

	if ($Package_weights[$i]!=NULL){
		if($Package_heights[$i]!=NULL){
		 if($Package_widths[$i]!=NULL){
		if($Package_weights[$i]>$package_weight || $Package_heights[$i]>$package_height || $Package_widths[$i]>$package_width){
			echo '<script language="javascript">';
echo 'alert("packages overload!")';
echo '</script>';
echo '<script >';
      
      echo 'window.location="index.php?page=home"';
      echo '</script>';
      exit;
		}
          
		 }}
		
	}

}
$date = date('Y-m-d H:i:s');
$_SESSION['date']=$date;

for($i = 0; $i < $_GET['count']; $i++ ){

$sqll = "INSERT INTO booked_flight (customer_id, flight_id, passport_no, name,contact,date_booked) VALUES ('$customer_id','$flight_id','$passport_nos[$i]','$names[$i]','$contacts[$i]','$date')";

$rss = mysqli_query($conn, $sqll);

}


$ticket_price=($adult_price*$Adultcount)+($child_price*$childcount);

$sql = "INSERT INTO ticket_details (flight_id, customer_id, ticket_price,no_child,no_adult,date_created) VALUES ('$flight_id','$customer_id','$ticket_price','$childcount','$Adultcount','$date')";

$rs = mysqli_query($conn, $sql);


if($rs)
{
  if($way==1){
echo '<script >';
echo 'window.location="index.php?page=ticket_details"';
 echo '</script>';}
 else if($way==2){
  $_SESSION['count']=$count;
  
  echo '<script >';
  echo 'window.location="index.php?page=arrival_search"';
   echo '</script>';

 }

}
/*else{
//echo $sql;

echo '<script language="javascript">'; 
echo 'alert("error!")'; 
echo '</script>';
echo '<script >';
echo 'window.location="Booking.php"';
 echo '</script>';
exit



}*/



}


?>