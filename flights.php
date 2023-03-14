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
                               <?php if (isset($_SESSION['way'])){ ?>
                                <h2><b><?php echo   $_SESSION['way'] == 2 ? "Departure Searched Flight results..."  :"Searched Flight results..."?></b></h2>
                            
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
                $where .= " and f.departure_airport_id = $x  and f.arrival_airport_id = $y and date(f.departure_date) = '".date('Y-m-d',strtotime( $_SESSION['date_departure']))."'  ";
                //$test=$conn->query("SELECT f1.*,a.airlines,a.logo_path FROM flight_details f1 inner join airlines_list a on f.airline_id = a.airline_id ");
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
                    <div class="col-md-3 text-center align-self-end-sm">
                        <button class="btn-outline-primary  btn  mb-4 book_flight" type="button" data-id="<?php echo $row['flight_id'] ?>"  data-name="<?php echo $aname[$row['departure_airport_id']].' - '.$aname[$row['arrival_airport_id']] ?>" data-max="<?php echo $row['seats'] - $booked ?>">Book Now</button>
                    </div>
                </div>
                <hr class="divider" style="max-width: 60vw">
                <?php } ?>
                <?php }else{ ?>
                    <div class="row align-items-center">
                        <h5 class="text-center"><b>No result.</b></h5>
                    </div>
                <?php } ?>
                <?php if(isset($_SESSION['way']) && $_SESSION['way'] ==2){ ?>
                <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2><b><?php echo isset($_SESSION['way']) && $_SESSION['way'] == 2 ? "Arrival Searched Flight results..." : ( !isset($_SESSION['way'])? " Flights Available " :"Searched Flight results...")  ?></b></h2>
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
                
                
                $where .= " and f.departure_airport_id ='$y' and f.arrival_airport_id = '$x' and date(f.departure_date) = '".date('Y-m-d',strtotime($_SESSION['date_return']))."'  ";
            
                $flight = $conn->query("SELECT f.*,a.airlines,a.logo_path FROM flight_details f inner join airlines_list a on f.airline_id = a.airline_id $where order by rand()");
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
                        <?php } ?>
                
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
           if($(this).attr('data-max') <= 0){
               alert("There is no Available Seats for the selected flight");
               return false;
           }
            uni_modal($(this).attr('data-name'),"book_flight.php?id="+$(this).attr('data-id')+"&max="+$(this).attr('data-max'),'mid-large')
        })
        $('[name="trip"]').on("keypress change keyup",function(){
            if($(this).val() == 1){
                $('#rdate').hide()
            }else{
                $('#rdate').show()
            }
        })
    </script>












        <?php 
 /*  if (isset($_POST['create'])) {
       
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
   
    
    
    
    
    } */?>
