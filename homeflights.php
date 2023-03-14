<?php 

session_start();
ob_start();
    include('header.php');
    include('db_connect.php');


	$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach ($query as $key => $value) {
		if(!is_numeric($key))
			$_SESSION['setting_'.$key] = $value;
	}
    ob_end_flush();
    ?>

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
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="homeflights.php">flights</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login_Registration/login.php">Login</a></li>
                      
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








<section class="page-section" id="flight" >
        <div class="container">
        	<div class="card">
        		<div class="card-body">
        			<div class="col-lg-12">
						<div class="row">
							<div class="col-md-12 text-center">
                            <?php if (isset($_SESSION['way'])){
                                unset($_SESSION['way']) ;}?>
                        <?php if (!isset($_SESSION['way'])){ ?>


                            
                            <h2><b><?php echo 'Available Flights'?></b></h2>
							
                            </div>
						</div>
						<hr class="divider">
				<?php
				$airport = $conn->query("SELECT * FROM airport_list ");
				while($row = $airport->fetch_assoc()){
					$aname[$row['airport_id']] = ucwords($row['airport'].', '.$row['location']);
				}
				$where = " where date(f.departure_date) > '".date("Y-m-d")."' ";
				//if($_SERVER['REQUEST_METHOD'] == "POST" )
                $flight = $conn->query("SELECT f.*,a.airlines,a.logo_path FROM flight_details f inner join airlines_list a on f.airline_id = a.airline_id $where order by rand()");
				//echo$where;
                //echo $test->num_rows;
                //echo $flight->num_rows;
                if($flight->num_rows > 0){
                    
				while($row=$flight->fetch_assoc()){
					$booked = $conn->query("SELECT * FROM booked_flight where flight_id = ".$row['flight_id'])->num_rows;
				?>
                 <div class="row align-items-center">
					<div class="col-md-3">
						<img src="assets/img/<?php echo $row['logo_path'] ?>" alt="">
					</div>
					<div class="col-md-6">
						 <p><b><?php echo $aname[$row['departure_airport_id']].' - '.$aname[$row['arrival_airport_id']] ?></b></p>
						 <p><small>Airline: <b><?php echo $row['airlines'] ?></b></small></p>
						 <p><small>Departure: <b><?php echo date('h:i A',strtotime($row['departure_date'])) ?></b></small></p>
						 <p><small>Arrival: <b><?php echo (date('M d,Y',strtotime($row['departure_date'])) == date('M d,Y',strtotime($row['arrival_date']))) ? date('h:i A',strtotime($row['arrival_date'])) : date('M d,Y h:i A',strtotime($row['arrival_date'])) ?></b></small></p>
						 <p><small>Adult price: <b><?php echo  $row['adult_price']?></b></small></p>
                         <p><small>Child price: <b><?php echo  $row['child_price']?></b></small></p>
                         <p>Available Seats : <b><h4><?php echo $row['seats'] - $booked ?></h4></b></p>
					</div>
				
				</div>
				<hr class="divider" style="max-width: 60vw">
				<?php } ?>
				<?php }else{ ?>
					<div class="row align-items-center">
						<h5 class="text-center"><b>No result.</b></h5>
					</div>
				<?php } ?>
                <?php } ?>



				</div>
				</div>
        	</div>
        </div>
    </section>


 

  
    <style>
    	#flight img{
    		max-height: 300px;
    		max-width: 200px; 
    	}
    	#flight p{
    		margin: unset
      	}
    </style>
