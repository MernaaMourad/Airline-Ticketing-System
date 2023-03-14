<?php //session_start();
if (!isset($_SESSION["administrative_id"])) {
      
	echo '<script >';
	echo 'window.location="../greeting.php"';
	echo '</script>';
	exit;}
 if(!isset($_SESSION['date_created'])){echo '<script >';
	echo 'window.location="../greeting.php"';
	echo '</script>';
	exit;}
 include '../db_connect.php' ?>
<?php 


    if(isset($_SESSION['date_created'])){
        $date_created= $_SESSION['date_created'];

        $query = "SELECT ticket_price FROM ticket_details where date(date_created) ='$date_created' ";
$res=mysqli_query($conn, $query);

$count = mysqli_num_rows($res);

$dayincome=0;                
 While ($count>0){
$row = mysqli_fetch_assoc($res);
$dayincome=$dayincome+$row['ticket_price'];
$count=$count-1;}




$query2 = "SELECT ticket_price FROM ticket_details ";
$res2=mysqli_query($conn, $query2);

$count2 = mysqli_num_rows($res2);

$totalincome=0;                
 While ($count2>0){
$row2 = mysqli_fetch_assoc($res2);
$totalincome=$totalincome+$row2['ticket_price'];
$count2=$count2-1;}
                               


?>

   
   <div class="containe-fluid">
   
       <div class="row">
           <div class="col-lg-12">
               
           </div>
       </div>
   
       <div class="row mt-3 ml-3 mr-3">
               <div class="col-lg-12">
               <div class="card">
                   <div class="card-body">
                 <p><?php echo "Income for  ".$_SESSION['date_created'].' = '.$dayincome  ?></p>
                 <p><?php echo "Total income =  ".$totalincome  ?></p>
                 
                   
 <style>
                   p {
    display: block;
    text-align: center;
    color: black;
    font: 40px Times , bold;
   

    }
</style>


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
<?php  }?>