<?php if (!isset($_SESSION["administrative_id"])) {
	  echo '<script >';
	  echo 'window.location="../greeting.php"';
	  echo '</script>';
	  exit;}
 include '../db_connect.php' ?>
<div class="container-fluid">
<div class="col-lg-6">
<div class="form-group">
<form class="form-horizontal" action="" method="post" >
						<label for="" class="control-label">Income</label>
						<select name="date_created" id="date_created" >
							<?php 
							$book = $conn->query("SELECT distinct date(date_created) as test FROM ticket_details order by date_created asc");
							while($row = $book->fetch_assoc()):
							?>
								<option><?php echo $row['test']?></option>
								 
				


							<?php endwhile; ?>

						</select>
                        <input class="btn btn-primary" type="submit" name="create" value="Search">
                            </form>     
                            
                </div>
                <?php if(isset($_POST['create'])){
                    $date_created=$_POST['date_created'];
                    $_SESSION['date_created']=$date_created;
                    echo '<script >';
    echo 'window.location="index.php?page=manage_ticketing"';
    echo '</script>';


                }
                
                
                
                ?>

</div>
</div>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Tickets </b>
				</large>
				</div>
			<div class="card-body">
				<table class="table table-bordered" id="ticketing">
					<colgroup>
						<col width="10%">
						<col width="35%">
						<col width="10%">
						<col width="10%">
						<col width="10%">
						<col width="10%">
						<col width="15%">
					</colgroup>
					<thead>
						<tr>
							<th class="text-center">Ticket ID</th>
							<th class="text-center">Plane number</th>
							<th class="text-center">Airline </th>
							<th class="text-center">Location </th>
							<th class="text-center">Ticket Price</th>
							<th class="text-center">Number of Adult </th>
							<th class="text-center">Number of Children</th>
							<th class="text-center">Date Created</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$airport = $conn->query("SELECT * FROM airport_list ");
							while($row = $airport->fetch_assoc()){
								$aname[$row['airport_id']] = ucwords($row['airport'].', '.$row['location']);
							}
							$qry = $conn->query("SELECT t.*,f.plane_no,f.airline_id,f.arrival_airport_id,f.flight_id,f.departure_airport_id,a.airlines,a.logo_path FROM flight_details f inner join airlines_list a on f.airline_id = a.airline_id  inner join ticket_details t on t.flight_id=f.flight_id order by ticket_id asc");
							while($row = $qry->fetch_assoc()):
								//$booked = $conn->query("SELECT * FROM booked_flight where flight_id = ".$row['flight_id'])->num_rows;

						 ?>
						 <tr>
						 	
						 	
						 	<td class="text-right"><?php echo $row['ticket_id'] ?></td>
						 	<td class="text-right"><?php echo $row['plane_no'] ?></td>
						 	<td class="text-right"><?php echo $row['airlines'] ?></td>
							<td class="text-right"> <?php echo $aname[$row['departure_airport_id']].' - '.$aname[$row['arrival_airport_id']] ?></td>
						 	<td class="text-right"><?php echo number_format($row['ticket_price'],2) ?></td>
							 <td class="text-right"><?php echo $row['no_adult'] ?></td>
							 <td class="text-right"><?php echo $row['no_child'] ?></td>
							 <td><?php echo $row['date_created'] ?></td>

							<td><?php/* echo date('M d,Y',strtotime($row['date_created'])) */?></td>

						 </tr>

						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<style>
	td p {
		margin:unset;
	}
	td img {
	    width: 8vw;
	    height: 12vh;
	}
	td{
		vertical-align: middle !important;
	}
</style>	
<script>
	$('#ticketing').dataTable()
	$('#income').click(function(){
		uni_modal("Income","manage_ticketing.php?id="+$(this).attr('data-id'),'mid-large')
	})
	

</script>