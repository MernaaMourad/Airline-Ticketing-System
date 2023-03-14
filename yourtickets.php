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
        <section class="page-section" id="flight" >
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">                      
                               <?php If (isset($_SESSION['customer_id'])){
                        $customer_id=$_SESSION["customer_id"];
                        $sql="SELECT * FROM ticket_details t INNER join customer c ON t.customer_id = c.customer_id  INNER join flight_details f On t.flight_id = f.flight_id  WHERE  t.customer_id = '$customer_id' and date(f.departure_date) > '".date("Y-m-d")."'" ;
                        $result = mysqli_query($conn, $sql); 
                        $count = mysqli_num_rows($result);
                        $flag=$count;
                        $i=1;
                        While ($count>0){
                            $row = mysqli_fetch_assoc($result);
                              ?> 
                         <div class="row">
                            <div class="col-md-12 text-center"> 
                        <h2><b><?php echo "Ticket $i ..." ;?></b></h2>

                        </div>
                        </div>
                        <hr class="divider">
                        <?php
                     /*   $customer_id=$_SESSION["customer_id"];
                        /*"SELECT * FROM flight_details WHERE (flight_id=$flight_id)"*/
                       /* $sql2="SELECT * FROM ticket_details t INNER join customer c ON t.customer_id = c.customer_id  INNER join flight_details f On t.flight_id = f.flight_id  WHERE  t.customer_id = '$customer_id' and date(f.departure_date) > '".date("Y-m-d")."'" ;
                       
                        
                        $result2 = mysqli_query($conn, $sql2);
                         
                        if (mysqli_num_rows($result2)>0){ */
                               ?> 
                        <div class="row align-items-center">
                  
                  <div class="col-md-6">
                      <p><small>Your Name : <b><?php echo $row['first_name']." " .$row['last_name'] ?></b></small></p>
                      <p><small>Plane : <b><?php echo $row['plane_no'] ?></b></small></p>
                      <p><small>date_created : <b><?php echo $row['date_created'] ?></b></small></p>
                       <p><small>flight Number: <b><?php echo $row['flight_id'] ?></b></small></p>
                       <p><small>ticket price: <b><?php echo  $row['ticket_price']?></b></small></p>
                       <p><small>Number of child : <b><?php echo  $row['no_child']?></b></small></p>
                       <p><small>Number of adult : <b><?php echo $row['no_adult']?></small></b></p>
                  </div>
                  <div class="col-md-3 text-center align-self-end-sm">
                  <button class="btn-outline-primary  btn  mb-4 book_flight" type="button" data-name=" Successfully Deleted your booking" data-id="<?php echo $row['ticket_id'] ?>">Cancel</button>
                  </div>
              </div>
              <hr class="divider" style="max-width: 60vw">
                            
                        <?php $i=$i+1;
                        $count=$count-1;} 
                        if($flag==0){?>
                     
                        
                        <div class="row align-items-center">
                             <h5 class="text-center"><b>No booked tickets yet.</b></h5>
                         </div>
                       <?php }}?>                                        
                </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        
      
        $('.book_flight').click(function(){
           
            uni_modal($(this).attr('data-name'),"delete_ticket.php?id="+$(this).attr('data-id'),'mid-large')
        })
       
    </script>







                        

                        


