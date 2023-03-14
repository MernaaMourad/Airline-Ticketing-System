<?php 
session_start();

include 'db_connect.php'; 
if (!isset($_SESSION["customer_id"])) {
      
    echo '<script >';
    echo 'window.location="greeting.php"';
    echo '</script>';
    exit;}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    foreach($_POST as $k => $v){
        $$k = $v;
    }
}

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


$ticket_id=$_GET['id'];
$customer_id=$_SESSION['customer_id'];
$sql1="SELECT  * FROM ticket_details  WHERE ticket_id = '$ticket_id' and  customer_id = '$customer_id' "; 
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result); 
$flight_id=$row['flight_id'];
$date=$row['date_created'];



     
    $sqll ="DELETE FROM booked_flight WHERE date_booked = '$date' and flight_id = '$flight_id' and customer_id = '$customer_id' "; 
    $rss = mysqli_query($conn, $sqll); 
    $sql ="DELETE FROM ticket_details WHERE ticket_id = '$ticket_id' "; 
    $rss = mysqli_query($conn, $sql);
    


?>




<script >
	$('#ticket_details').click(function(){

		
	    window.location="index.php?page=yourtickets"
        	
	    }
	)
          
		   </script>




<style>

    #uni_modal .modal-footer{
        display: none
    }
</style>