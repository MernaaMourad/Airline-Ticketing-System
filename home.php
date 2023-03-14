
<?php 
session_start();
include 'db_connect.php';
if (!isset($_SESSION["customer_id"])) {
      
    echo '<script >';
    echo 'window.location="greeting.php"';
    echo '</script>';
    exit;}

?>
<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
</style>
<head>
<script type="text/javascript">
        function validateForm() {
           // alert("departure");

            $date_departure = document.forms["Form"]["date_departure"].value;
            $date_return = document.forms["Form"]["date_return"].value;
            $trip = document.forms["Form"]["trip"].value;
            
            var varnow = new Date();
            var var2 = varnow.toISOString().split('T')[0];
            if (new Date($date_departure).getTime() < new Date(var2).getTime()) {
                alert_toast("departure date must be greater than current date","success");
                return false;
            }
            if ($trip==2){
            if ($date_departure >= $date_return) {
               // alert("return date must be after pick-up date and time");
                alert_toast("return date must be after pick-up date and time","success");
                return false;
            }}
        }

    </script>
</head>
        <header class="masthead">
            <div class="container-fluid h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4 page-title">
                    	<h3 class="text-white">Welcome to <?php echo $_SESSION['setting_name']; ?></h3>
                        <hr class="divider my-4" />
                    <div class="col-md-12 mb-2 text-left">
                        <div class="card">
                            <div class="card-body">
                                
                                <form id="manage-filter" name="Form" method="POST" action="" onsubmit="return validateForm();">
                                    <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label for="" class="control-label">From</label>
                                            <select name="departure_airport_id" id="departure_location" class="custom-select browser-default select2">
                                                
                                            <?php
                                                $airport = $conn->query("SELECT * FROM airport_list order by airport asc");
                                            while($row = $airport->fetch_assoc()):
                                            ?>
                                                <option value="<?php echo $row['airport_id'] ?>" <?php echo isset($departure_airport_id) && $departure_airport_id == $row['id'] ? "selected" : '' ?>><?php echo $row['location'].", ".$row['airport'] ?></option>
                                            <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="" class="control-label">To</label>
                                            <select name="arrival_airport_id" id="arrival_airport_id" class="custom-select browser-default select2">

                                                

                                            <?php
                                                $airport = $conn->query("SELECT * FROM airport_list order by airport asc");
                                            while($row = $airport->fetch_assoc()):
                                            ?>
                                                <option value="<?php echo $row['airport_id'] ?>" <?php echo isset($arrival_airport_id) && $arrival_airport_id == $row['airport_id'] ? "selected" : '' ?>><?php echo $row['location'].", ".$row['airport'] ?></option>
                                            <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="" class="control-label">Departure Date</label>
                                            <input type="date" class="form-control " name="date_departure"  >
                                        </div>
                                        <div class="col-sm-3" id="rdate" style="display: none">
                                            <label for="" class="control-label">Return Date</label>
                                            <input type="date" class="form-control " name="date_return"   >
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-2 text-center">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="trip" id="onewway" value="1" checked>
                                              <label class="form-check-label" for="onewway">
                                                One-way
                                              </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2 text-center">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="trip" id="rtrip" value="2">
                                              <label class="form-check-label" for="rtrip">
                                               Round Trip
                                              </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 offset-sm-5">
                                        <input class="btn-sm btn-primary"  type="submit" name="create" value="Find Flights" >

                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>                        
                    </div>
                    
                </div>
            </div>
            

    
        </header>

      
	<section class="page-section" id="menu">
  
    <div id="portfolio" class="container">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-12 text-center">
                    <form id="manage-filter" name="Form2" method="POST" action="" onsubmit="; >
                    <h2 class="mb-4">Airline of your choice</h2>
                    <hr class="divider">

                    </div>
                </div>
                <div class="row no-gutters">
                    <?php
                    $cats = $conn->query("SELECT * FROM airlines_list order by airlines asc");
                                while($row=$cats->fetch_assoc()){
                    ?>
                    
                    <div class="col-lg-4 col-sm-6">
                    
                    <a href="airline_search.php?id=<?php  echo  $row['airline_id']; ?> ">
                        
                            <img class="img-fluid" src="assets/img/<?php echo $row['logo_path'] ?>" alt="" />
                            
                                </a>

                        
                        
                    </div>
                    <?php } ?>
                                  
                </div>
            </div>
        </div>
    <script>
        
       
        $('.select2').select2({
            placeholder:'Select Departure',
            width:'100%'
        })
        $('[name="trip"]').on("keypress change keyup",function(){
            if($(this).val() == 1){
                $('#rdate').hide()
            }else{
                $('#rdate').show()
            }
        })
    </script>
   
    </section>

   <?php 
   if (isset($_POST['create'])) {
       
    $date_return = $_POST['date_return'];
    $date_departure = $_POST['date_departure'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departure_airport_id = $_POST['departure_airport_id'];
    $way= $_POST['trip'];
  if(!empty($date_departure)){
    if($way==1){
    
        $_SESSION['date_departure'] = $date_departure;
        $_SESSION['arrival_airport_id'] = $arrival_airport_id;
        $_SESSION['departure_airport_id'] = $departure_airport_id;
        $_SESSION['way'] = $way;
        
        echo '<script >';
                echo 'window.location="index.php?page=flights"';
                echo '</script>';
                exit;
    }
    else if($way==2 ){
        if(!empty($date_return)){
        $_SESSION['date_departure'] = $date_departure;
        $_SESSION['date_return'] = $date_return;
        $_SESSION['arrival_airport_id'] = $arrival_airport_id;
        $_SESSION['departure_airport_id'] = $departure_airport_id;
        $_SESSION['way'] = $way;
            echo '<script >';
            echo 'window.location="index.php?page=flights"';
            echo '</script>';
    
            exit;}
            else {
            echo '<script language="javascript">';
            echo 'alert("please fill return date")';
            echo '</script>';
            echo '<script >';
            echo 'window.location="index.php?page=home"';
            echo '</script>';
            }
        }
  }else{
    echo '<script language="javascript">';
    echo 'alert("please fill departure date")';
    echo '</script>';
    echo '<script >';
    echo 'window.location="index.php?page=home"';
    echo '</script>';
  }
   
    
    
    
    
    }
    ?>  
    
   



   




  