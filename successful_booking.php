<?php 
session_start();
include 'db_connect.php'; 
if (!isset($_SESSION["customer_id"])) {
      
    echo '<script >';
    echo 'window.location="greeting.php"';
    echo '</script>';
    exit;}
   if(!isset($_GET["id"])){echo '<script >';
    echo 'window.location="greeting.php"';
    echo '</script>';
    exit;}
    if (!isset($_SESSION["date"])) {
      
        echo '<script >';
        echo 'window.location="greeting.php"';
        echo '</script>';
        exit;}
    if (!isset($_SESSION["flight_id"])) {
      
            echo '<script >';
            echo 'window.location="greeting.php"';
            echo '</script>';
            exit;}
    if (!isset($_SESSION["flight_id"])) {
      
            echo '<script >';
            echo 'window.location="greeting.php"';
            echo '</script>';
            exit;}

?>
<div class="container-fluid">
    <div class="col-lg-12">
     <form action="" name="Form"  id="book-flight"> 
    <!-- <form id="book-flight" name="Form" method="POST" action="" onsubmit="; >-->
        <input type="hidden" name="arrival_id" value="<?php echo $_GET['id'] ?>">
        </form>
            <div class="col-md-2">

            <label for="" class="control-label">&nbsp;</label>
            <!-- <button class="btn btn-primary btn-block" type="button" id="go" onclick ='window.location="index.php?page=home"'>Go</button> -->
           
         </div>	<button class="btn btn-primary btn-block" type="button" id="ticket_details">Review Ticket</details></button>
            </div>
            </div>
            </form>		
        
</div>
</div>

<?php
$way=$_SESSION["way"];
$date=$_SESSION["date"];
$flight_id=$_SESSION["flight_id"];
$customer_id=$_SESSION["customer_id"];
$arrival_flight_id=$_GET['id'];

if($way==2){


    $sql="SELECT  * FROM booked_flight  WHERE date_booked = '$date' and flight_id = '$flight_id' and customer_id = '$customer_id' "; 
    $result = mysqli_query($conn, $sql);
    $count =  mysqli_num_rows($result);
    while ($count>0){
    $row = mysqli_fetch_assoc($result); 
        $name= $row['name'];  
        $passport_no= $row['passport_no'] ;
        $contact=$row['contact'];        
         
        $sqll ="INSERT INTO booked_flight (customer_id, flight_id, passport_no, name,contact,date_booked) VALUES ('$customer_id','$arrival_flight_id','$passport_no','$name','$contact','$date')";
        $rss = mysqli_query($conn, $sqll); 
        $count=$count-1;      
      
    }
    $sql2="SELECT no_child,no_adult FROM ticket_details  WHERE date_created = '$date' and flight_id = '$flight_id' and customer_id = '$customer_id' ";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2); 
   
    
    $no_child = $row2['no_child'];
    $no_adult = $row2['no_adult'];

    $sql3="SELECT adult_price,child_price FROM flight_details  WHERE  flight_id = '$arrival_flight_id' ";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3); 

    $child_price = $row3['child_price'];
    $adult_price = $row3['adult_price'];

    $ticket_price=($no_child*$child_price)+($no_adult*$adult_price);

    
    $sql4 = "INSERT INTO ticket_details (flight_id, customer_id, ticket_price,no_child,no_adult,date_created) VALUES ('$flight_id','$customer_id','$ticket_price','$no_child','$no_adult','$date')";

    $rs = mysqli_query($conn, $sql4);




    }



?>

<script >
	$('#ticket_details').click(function(){

		
	    window.location="index.php?page=ticket_details"
        	
	    }
	)
          
		   </script>




<style>

    #uni_modal .modal-footer{
        display: none
    }
</style>


