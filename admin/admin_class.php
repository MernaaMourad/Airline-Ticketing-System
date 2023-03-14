<?php
session_start();
ini_set('display_errors', 1);
include '../db_connect.php';

Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include '../db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	
	function save_user(){
		
		extract($_POST);
		if($first_name==''||$last_name==''||$gender==''||$email==''||$pwd==''||$phone_no==''||$address==''){return 0;}
		

	
		if(empty($id)){
		$found =$this->db->query("SELECT * FROM customer where email= '$email' ");
		$found = mysqli_fetch_assoc($found);
		if ($found)
	   {return 3;}
			$save = $this->db->query("INSERT INTO customer (first_name, last_name, gender,email,pwd,phone_no,`address`) VALUES ('$first_name','$last_name','$gender','$email','$pwd','$phone_no','$address')");
		return 1;
		}else{
			$save = $this->db->query("UPDATE customer set first_name = '$first_name', last_name = '$last_name', gender = '$gender', email = '$email', pwd = '$pwd', phone_no = '$phone_no', `address` = '$address'  where customer_id = '$id' ");
		return 2;
		}
		
	}
	



	function delete_user(){
		extract($_POST);
		$found = $this->db->query("SELECT * FROM ticket_details where customer_id = '$id' ");

		if (mysqli_num_rows($found)>0)
	   {return 0;}
		
		$delete = $this->db->query("DELETE FROM customer where customer_id = '$id' ");
		if($delete)
			return 1;
		
	}

	
	function save_airlines(){
		extract($_POST);
		//return 1;
		$data = " airlines = '$airlines' ";
		if(!empty($_FILES['img']['tmp_name'])){
			$fname = strtotime(date("Y-m-d H:i"))."_".$_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], '../assets/img/'.$fname);
			if($move){
				$data .=", logo_path = '$fname' ";
			}
			
		} 
		if(empty($id)){
			$save = $this->db->query("INSERT INTO airlines_list (`airlines`,`logo_path`, `package_weight`, `package_width`, `package_height`) VALUES
			('$airlines','$fname','$package_weight','$package_width' ,'$package_height')");
	        return 1;
    
		
	}}

	
		


	function edit_airline(){
		extract($_POST);
		
		$data = " airlines = '$airlines' ";
	
		
		
         
			$save = $this->db->query("UPDATE airlines_list set airlines = '$airlines', package_weight = '$package_weight', package_width = '$package_width', package_height= '$package_height'  where airline_id= '$id' ");
	        if($save)
			{return 1;}
		}
		
	

	function delete_airlines(){
		extract($_POST);

		$found = $this->db->query("SELECT * FROM flight_details where airline_id= '$id' ");
       // $found = mysqli_fetch_assoc($found);
		if (mysqli_num_rows($found)>0)
	      {return 0;}
          
		$delete = $this->db->query("DELETE FROM airlines_list where airline_id = '$id' ");
		
		if($delete)
			return 1;
	}

	function save_airports(){
		extract($_POST);
		
		//if(empty($id)){
			$save = $this->db->query("INSERT INTO airport_list (`airport`,`location`) VALUES ('$airport', '$location')");
			return 1;
		/*else{
			$save = $this->db->query("UPDATE airport_list set  airport = '$airport', `location` = '$location' where airport_id ='$id' ");
		}*/
			
	}
	
	function save_flight(){		
		extract($_POST);
		/*return $adult_price;*/
		if($airline_id==''||$plane_no==''||$departure_airport_id==''||$arrival_airport_id==''||$departure_date==''||$arrival_date==''||$seats==''||$adult_price==0||$child_price==0){return 0;}

		if(empty($id)){
			
		$save = $this->db->query("INSERT INTO flight_details (`airline_id`, `plane_no`, `departure_airport_id`, `arrival_airport_id`, `departure_date`, `arrival_date`, `seats`, `adult_price`, `child_price`) VALUES
		('$airline_id', '$plane_no','$departure_airport_id', '$arrival_airport_id', '$departure_date' , '$arrival_date','$seats', '$adult_price', '$child_price')");
			{return 1;}
		}else{
			$found =$this->db->query("SELECT t.* FROM ticket_details t where t.flight_id='$id' ");
			//$found2 = mysqli_fetch_assoc($found);
			
		if (mysqli_num_rows($found)>0)
	   {return 3;}
		$save = $this->db->query("UPDATE flight_details set airline_id = '$airline_id', plane_no = '$plane_no', departure_airport_id = '$departure_airport_id', arrival_airport_id = '$arrival_airport_id', departure_date = '$departure_date', arrival_date = '$arrival_date', seats = '$seats' , adult_price = '$adult_price' , child_price = '$child_price' where flight_id='$id'");
		{return 2;}
	}
		
	}
	function delete_flight(){
		extract($_POST);
		$found =$this->db->query("SELECT  FROM ticket_details where flight_id= '$id' ");

		if ($found)
	   {return 0;}
		
		$delete = $this->db->query("DELETE FROM flight_details where flight_id= '$id' ");
		if($delete)
			return 1;
	}
	function update_booked(){
		extract($_POST);
		if($name==''||$passport_no==''||$contact==''){return 0;}
		
			$save= $this->db->query("UPDATE booked_flight set name = '$name',passport_no = '$passport_no', contact = '$contact' where id='$id'");
		if($save)
			return 1;
	}

}