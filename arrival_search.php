<?php 
session_start();
include 'db_connect.php'; 
if (!isset($_SESSION["customer_id"])) {
    echo '<script >';
    echo 'window.location="greeting.php"';
    echo '</script>';
    exit;
}
else if(!isset($_SESSION['way'])){


    echo '<script >';
    echo 'window.location="greeting.php"';
    echo '</script>';
    exit;
}
if($_SERVER['REQUEST_METHOD'] == "POST"){
    foreach($_POST as $k => $v){
        $$k = $v;
    }
}

?>

        <section class="page-section" id="flight" >
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12 text-center">
                              
                         
                <?php if(isset($_SESSION['way']) && $_SESSION['way'] ==2){ ?>
                <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2><b><?php echo  "Arrival Searched Flight results..."  ?></b></h2>
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
                $x=$_SESSION["departure_airport_id"];
                $y=$_SESSION['arrival_airport_id'];
                $count=$_SESSION['count'];

                
                
                $where .= " and f.departure_airport_id ='$y' and f.arrival_airport_id = '$x' and date(f.departure_date) = '".date('Y-m-d',strtotime($_SESSION['date_return']))."'  ";
            
                $flight = $conn->query("SELECT f.*,a.airlines,a.logo_path FROM flight_details f inner join airlines_list a on f.airline_id = a.airline_id $where order by rand()");
                $flights=array();
                if($flight->num_rows > 0){
                while($row=$flight->fetch_assoc()){

                   

                    $booked = $conn->query("SELECT * FROM booked_flight where flight_id = ".$row['flight_id'])->num_rows;
                
                     if ($count <= $row['seats'] - $booked){
                      $flights[] = $row['flight_id'];}
                              
                    }
                
            
                if(empty($flights)){?>
                    <div class="row align-items-center">
                        <h5 class="text-center"><b>No result.</b></h5>
                        <?php }else{ ?>
                
                        
                      


                </div>

               <?php 
                 
                foreach ($flights as $flightt){
                     $query = "SELECT * FROM flight_details f inner join airlines_list a ON a.airline_id=f.airline_id WHERE flight_id = '$flightt' ";
                     
                     $res = $conn->query($query);
                     $rw = $res->fetch_array();
                     
                     if ($res == TRUE) {
                        
                     

                    
                ?>
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <img src="assets/img/<?php echo $rw['logo_path'] ?>" alt="">
                    </div>
                    <div class="col-md-6">
                         <p><b><?php echo $aname[$rw['departure_airport_id']].' - '.$aname[$rw['arrival_airport_id']] ?></b></p>
                         <p><small>Airline: <b><?php echo $rw['airlines'] ?></b></small></p>
                         <p><small>Departure: <b><?php echo date('h:i A',strtotime($rw['departure_date'])) ?></b></small></p>
                         <p><small>Arrival: <b><?php echo (date('M d,Y',strtotime($rw['departure_date'])) == date('M d,Y',strtotime($rw['arrival_date']))) ? date('h:i A',strtotime($rw['arrival_date'])) : date('M d,Y h:i A',strtotime($rw['arrival_date'])) ?></b></small></p>
                         <p><small>Adult price: <b><?php echo  $rw['adult_price']?></b></small></p>
                         <p><small>Child price: <b><?php echo  $rw['child_price']?></b></small></p>
                         </div>
                    <div class="col-md-3 text-center align-self-end-sm">
                        <button class="btn-outline-primary  btn  mb-4 book_flight" type="button" data-name=" Successfully booked" data-id="<?php echo $rw['flight_id'] ?>">Confirm</button>
                    </div>
                </div>
                <hr class="divider" style="max-width: 60vw">
                <?php } }}?>
                <?php }else{ ?>
                    <div class="row align-items-center">
                        <h5 class="text-center"><b>No result.</b></h5>
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
    <script>
        
      
        $('.book_flight').click(function(){
           
            uni_modal($(this).attr('data-name'),"successful_booking.php?id="+$(this).attr('data-id'),'mid-large')
        })




        
    </script>












       
