<?php 
session_start();
include 'db_connect.php'; 

?>

<section class="page-section" id="flight" >
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-12 text-center">
                               <?php if ((isset($_SESSION['way'])&&$_SESSION['way'] == 1)||!isset($_SESSION['way'])){ ?>
                                <h2><b><?php echo "One way ticket: Departure ticket details..." ?></b></h2>
                            
                            </div>
                        </div>
                        <hr class="divider">

                        <?php
                        $date=$_SESSION["date"];
                        $flight_id=$_SESSION["flight_id"];
                        $customer_id=$_SESSION["customer_id"];
                        $sql="SELECT t.*,c.first_name,c.last_name FROM ticket_details t INNER join customer c ON t.customer_id = c.customer_id  WHERE t.date_created = '$date' and t.customer_id = '$customer_id' and t.flight_id = '$flight_id' ";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result); 
                        if (mysqli_num_rows($result)>0){ ?> 
                         <div class="row align-items-center">
                  
                         <div class="col-md-6">
                             <p><small>Your Name : <b><?php echo $row['first_name']." " .$row['first_name'] ?></b></small></p>
                              <p><small>flight Number: <b><?php echo $row['flight_id'] ?></b></small></p>
                              <p><small>ticket price: <b><?php echo  $row['ticket_price']?></b></small></p>
                              <p><small>Number of child : <b><?php echo  $row['no_child']?></b></small></p>
                              <p>Number of adult  : <b><?php echo $row['no_adult']?></b></p>
                         </div>
                     </div>
                     <hr class="divider" style="max-width: 60vw">
                    
                     <?php }else{ ?>
                         <div class="row align-items-center">
                             <h5 class="text-center"><b>No booked tickets yet.</b></h5>
                         </div>
                         <?php }} /*else{ echo No booked tickets yet.}*/ ?>
                <?php if(isset($_SESSION['way']) && $_SESSION['way'] ==2){ ?>
                <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2><b><?php echo "Two Way Ticket: Departure ticket details..." ?></b></h2>
                        </div>
                    </div>
                        <hr class="divider">
                        <?php
                         $date=$_SESSION["date"];
                         $flight_id=$_SESSION["flight_id"];
                        $customer_id=$_SESSION["customer_id"];
                       
                         $sql2="SELECT t.*,c.first_name,c.last_name FROM ticket_details t INNER join customer c ON t.customer_id = c.customer_id  WHERE t.date_created = '$date' and t.customer_id = '$customer_id' and t.flight_id = '$flight_id' ";
                         $result2 = mysqli_query($conn, $sql2);
                         $row2 = mysqli_fetch_assoc($result2); 
                         if (mysqli_num_rows($result2)>0){ ?> 
                         <div class="row align-items-center">
                  
                         <div class="col-md-6">
                             <p><small>Your Name : <b><?php echo $row2['first_name']." " .$row2['first_name'] ?></b></small></p>
                              <p><small>flight Number: <b><?php echo $row2['flight_id'] ?></b></small></p>
                              <p><small>ticket price: <b><?php echo  $row2['ticket_price']?></b></small></p>
                              <p><small>Number of child : <b><?php echo  $row2['no_child']?></b></small></p>
                              <p>Number of adult  : <b><?php echo $row2['no_adult']?></b></p>
                         </div>
                      
                     </div>
                     <hr class="divider" style="max-width: 60vw">
                     
                     <?php }else{ ?>
                         <div class="row align-items-center">
                             <h5 class="text-center"><b>No booked tickets yet.</b></h5>
                         </div>
                         <?php }}  ?>
                       

                        <?php if(isset($_SESSION['way']) && $_SESSION['way'] ==2){ ?>
                <hr>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h2><b><?php echo "Two Way Ticket: Arrival ticket details..." ?></b></h2>
                        </div>
                    </div>
                        <hr class="divider">
                        <?php
                          $date=$_SESSION["date"];
                          $flight_id=$_SESSION["flight_id"];
                         $customer_id=$_SESSION["customer_id"];
                         $sql="SELECT t.*,c.first_name,c.last_name FROM ticket_details t INNER join customer c ON t.customer_id = c.customer_id  WHERE t.date_created = '$date' and t.flight_id = '$flight_id' ";
                         $result = mysqli_query($conn, $sql);
                         $row = mysqli_fetch_assoc($result); 

                         if (mysqli_num_rows($result)>0){ ?>
                         <div class="row align-items-center">
                  
                         <div class="col-md-6">
                              <p><small>flight Number: <b><?php echo $row['flight_id'] ?></b></small></p>
                              <p><small>ticket price: <b><?php echo  $row['ticket_price']?></b></small></p>
                              <p><small>Number of child : <b><?php echo  $row['no_child']?></b></small></p>
                              <p>Number of adult  : <b><?php echo $row['no_adult']?></b></p>
                         </div>
                         
                     </div>
                     <hr class="divider" style="max-width: 60vw">
                     
                     <?php }else{ ?>
                         <div class="row align-items-center">
                             <h5 class="text-center"><b>No booked tickets yet.</b></h5>
                         </div>
                         <?php } ?>
                        <?php } /*else{ echo No booked tickets yet.}*/?>
                        
                        <a href="index.php?page=yourtickets"><center><input class="btn-sm btn-block btn-wave col-md-4 btn-primary" type="submit" name="Your tickets" value="Your tickets"></center></a>
    
                </div>
                </div>
            </div>
        </div>
                         </section>
                 
                     
                        