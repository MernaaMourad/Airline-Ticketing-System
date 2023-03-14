<?php session_start(); 
//include 'index.html'?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online Airline Ticketing System</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oswald:400'><link rel="stylesheet" href="./styless.css">
 <!-- <link rel="stylesheet" type="text/css" href="styless.css"> -->
  <!--<link rel="stylesheet" type="text/css" href="style.css">
  <script> src="script.js"   </script> -->



<?php 

 include('../db_connect.php'); 
/*if(isset($_SESSION['administrative_id']))
/*header("location:index.php?page=home");*/
?>

</head>


<body>
<!-- partial:index.partial.html -->
<div id="box"></div>
<!-- partial -->

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

if (isset($_POST['Login'])) {
         
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email != '' && $password != '') {

        $query = "SELECT * FROM administrative WHERE email='$email'";
		$results = mysqli_query($conn, $query);
		$roww=mysqli_fetch_assoc($results);



		$queryy = "SELECT * FROM customer WHERE email='$email' ";
		$result = mysqli_query($conn, $queryy);
		$row = mysqli_fetch_array($result);
	   
        
			if($results->num_rows > 0){
				//$roww = $results->fetch_array();
				
			$db_passs = $roww['password'];
            if ($db_passs === md5($password) || $db_passs == ($password)) {
                $administrative_id = $roww['administrative_id'];
                $_SESSION['administrative_id'] = $administrative_id;

				$_SESSION['firstname'] =  $roww['firstname'];
				$_SESSION['lastname'] =  $roww['lastname'];
                
                echo $administrative_id;

                
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
           
			   
			else if($result->num_rows > 0){
			
			$db_pass = $row['pwd'];
            if ($db_pass === md5($password) || $db_pass == ($password)) {
                $customer_id = $row['customer_id'];
                $_SESSION['customer_id'] = $customer_id;

                
                echo '<script >';
                    echo 'window.location="../index.php"';
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
		  	echo 'window.location="login.php"';  
			echo '</script>';
			exit;
		
	}

}}
?>

<div id="preloader"></div>
        <footer class="bg-info py-5">
            <br>
            <div class="container"><div class="small text-center text-muted"> 
				<p> Don't have an account ! </p>
			<a href="registration.php">CLick to signup</a> </div></div>
        </footer>
        


</html>

