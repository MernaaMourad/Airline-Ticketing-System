<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Online Airline Ticketing System</title>
 <!-- <link rel="stylesheet" type="text/css" href="styless.css"> -->
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Oswald:400'><link rel="stylesheet" href="./styless.css">



<?php 

 include('../db_connect.php'); 
/*if(isset($_SESSION['customer_id']))
/*header("location:../index.php?page=home");*/
?>

</head>


<body>

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
		  <h2>Registration</h2>
  			<div class="card col-md-8">
  				<div class="card-body">
  					<form method="post" >
                      <div class="form-group">
						  <label for="first_name" class="control-label">First Name</label>
  							<center><input type="text" id="first_name" name="first_name" class="form-control" pattern="[a-zA-Z0-9]+" required></center>
  						</div>
                          <div class="form-group">
						  <label for="last_name" class="control-label">Last Name</label>
  							<center><input type="text" id="last_name" name="last_name" class="form-control" pattern="[a-zA-Z0-9]+" required></center>
  						</div>
						  <div class="form-group">
						  <label for="gender" class="control-label">Gender:
                        (M default)</label>
						</div>
						<div class="form-group">
						  <?php
                        if (!empty($_GET['gender'])) {
                            $selected = $_GET['gender'];
                        } else {
                            $selected = 'M';
                        }
                        ?>
                        <label>
                            <input type="radio" name="gender" value="M"/> M
                        </label>
                        <label>
                            <input type="radio" name="gender" value="F"/> F
                        </label></br>
						</div>
  						<div class="form-group">
						  <label for="email" class="control-label">Email</label>
  							<center><input type="email" id="email" name="email" class="form-control "required></center>
  						</div>
  						<div class="form-group">
						  <label for="pwd" class="control-label">Password</label>
  							<center><input type="password" id="pwd" name="pwd" class="form-control"required></center>
  						</div>
                          <div class="form-group">
						  <label for="phone_no" class="control-label">Phone number</label>
  							<center><input type="text" id="phone_no" name="phone_no" class="form-control"required></center>
  						</div>
                          <div class="form-group">
						  <label for="address" class="control-label">Address</label>
  							<center><input type="text" id="address" name="address" class="form-control"required></center>
  						</div>
  						<center><input class="btn-sm btn-block btn-wave col-md-4 btn-primary" type="submit" name="Register" value="Register"></center>
  					</form>
  				</div>
  			</div>
  		</div>
  </main>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
</body>


<?php

/* connect to MySQL database */


if (isset($_POST['Register'])) {

 
// Check db connection


    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
	$gender = $_POST['gender'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $phone_no = $_POST['phone_no'];
    $address = $_POST['address'];
    $pwd = md5($pwd);


    $query = "SELECT * FROM customer WHERE (email='$email')";
$res=mysqli_query($conn, $query);
if(mysqli_num_rows($res)>0){ //if email is already present in database

echo '<script language="javascript">';
echo 'alert("The email address is already registered!")';
echo '</script>';

echo '<script >';
echo 'window.location="registration.php"';
 echo '</script>'; 
 exit;

}else if(mysqli_num_rows($res)==0){
    $sql = "INSERT INTO customer (first_name, last_name, gender,email,pwd,phone_no,address) VALUES ('$first_name','$last_name','$gender','$email','$pwd','$phone_no','$address')";

// insert in database 
$rs = mysqli_query($conn, $sql);

if($rs)
{
    
	echo '<script >';
	echo 'window.location="login.php"';
	 echo '</script>';

 
}
else{
  
  echo '<script language="javascript">'; 
  echo 'alert("error!")'; 
  echo '</script>';
  echo '<script >';
  echo 'window.location="registration.php"';
   echo '</script>';
  exit;
}}}
?>

<div id="preloader"></div>
        <footer class="bg-info py-5">
            <br>
            <div class="container"><div class="small text-center text-muted"> 
				<p> Already have an account ! </p>
			<a href="login.php">Login</a> </div></div>
        </footer>
        


</html>
