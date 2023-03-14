<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online Airline Ticketing System</title>
  <link rel="stylesheet" type="text/css" href="styless.css">



<?php 

//  include('../db_connect.php'); 
/*if(isset($_SESSION['administrative_id']))
/*header("location:index.php?page=home");*/
?>

</head>


<body>


  <main id="main" class=" bg-dark">

  			<!-- <div class="logo">
  				<span class="fa fa-plane-departure"></span>
  			</div> -->
  		</div>
  		<div class="container">
		  <h2>LOGIN</h2>
  			<div class="card col-md-8">
  				<div class="card-body">
  					<form method="post" >
				
  						<div class="form-group">
						  

						  <label for="email" class="control-label">Email</label>
  							<center><input type="text" id="email" name="email" class="form-control"></center>
  						</div>
  						<div class="form-group">
						  <label for="password" class="control-label">Password</label>
  							<center><input type="password" id="password" name="password" class="form-control"></center>
  						</div>
  						<center><input class="btn-sm btn-block btn-wave col-md-4 btn-primary" type="submit" name="Login" value="Login"></center>
  					</form>
  				</div>
  			</div>
  		</div>
  </main>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</body>




<?php

echo `1`;
$sname= 'localhost';
$uname= 'root';
$password = '';
$db_name = `airline-ticketing`;
$conn = mysqli_connect($sname, $uname, $password, $db_name);
if (!$conn) {

    echo "Connection failed!";

}
else{
	echo "tmam";
}
if (isset($_POST['Login'])) {
         
    $email = $_POST['email'];
    $password = $_POST['password'];
	$result= mysqli_query($conn,"select * from administrative ");
	echo $email;
	$user=mysqli_fetch_assoc($result);
	//$results = $conn->query($query);
	echo $results;
	echo "hello";
	
    if ($email != '' && $password != '') {

        $query = "SELECT * FROM administrative WHERE email='admin@yahoo.com'";
		$results = mysqli_query($conn, $query);
		//$results = $conn->query($query);
		echo $results;
       //$roww = $results->fetch_array(); 
	//    $roww = mysqli_fetch_array($results);
	   $roww=mysqli_fetch_assoc($results);
	  /* $count =  mysqli_num_rows($results);*/
      foreach( $roww as $value)
	  {echo $value;}


		$queryy = "SELECT * FROM customer WHERE email='$email' ";
		$result = mysqli_query($conn, $queryy);
		//$result = $conn->query($queryy);
        //$row = $result->fetch_array();
		//$countt =  mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
	   
        
			if($results){
				//$roww = $results->fetch_array();
				
			$db_passs = $roww['password'];
            if ($db_passs === md5($password) || $db_passs == ($password)) {
                $administrative_id = $roww['administrative_id'];
                $_SESSION['administrative_id'] = $administrative_id;
                echo 'test1';

                
                echo '<script >';
                    echo 'window.location="../admin/index.php"';
                    echo '</script>';


                exit;
            } else {
                
                echo '<script language="javascript">';
            echo 'alert("email or password is incorrect !!")';
            echo '</script>';
            echo '<script >';
                echo 'window.location="login.php"';
                echo '</script>';
                exit;
            }
        }  
           
			   
			else if($result){
				//$row = $result->fetch_array();
			
			$db_pass = $row['pwd'];
            if ($db_pass === md5($password) || $db_pass == ($password)) {
                $customer_id = $row['customer_id'];
                $_SESSION['customer_id'] = $customer_id;

                
                echo '<script >';
                    echo 'window.location="index.php"';
                    echo '</script>';


                exit;
            
        } else {
                
			echo '<script language="javascript">';
		echo 'alert("email or password is incorrect !!")';
		echo '</script>';
		echo '<script >';
		 	echo 'window.location="login.php"'; 
			echo '</script>';
			exit;
		}

    
        }else {
           
		echo '<script language="javascript">';
	echo 'alert("No users with such login found in the database! !!")';
		echo '</script>';
		echo '<script >';
		  //	echo 'window.location="login.php"';  
			echo '</script>';
			exit;
		
	}

}}
?>