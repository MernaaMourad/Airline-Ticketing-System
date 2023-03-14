<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();



if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}


if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_airlines"){
	$save = $crud->save_airlines();
	if($save)
		echo $save;
}
if($action == "delete_airlines"){
	$save = $crud->delete_airlines();
	if($save)
		echo $save;
}
if($action == "edit_airline"){
	$save = $crud->edit_airline();
	if($save)
		echo $save;
}
if($action == "save_airports"){
	$save = $crud->save_airports();
	if($save)
		echo $save;
}
if($action == "delete_airports"){
	$save = $crud->delete_airports();
	if($save)
		echo $save;
}
if($action == "save_flight"){
	$save = $crud->save_flight();
	if($save)
		echo $save;
}
if($action == "delete_flight"){
	$save = $crud->delete_flight();
	if($save)
		echo $save;
}
if($action == "set_appointment"){
	$save = $crud->set_appointment();
	if($save)
		echo $save;
}
if($action == "delete_appointment"){
	$save = $crud->delete_appointment();
	if($save)
		echo $save;
}
if($action == "update_appointment"){
	$save = $crud->update_appointment();
	if($save)
		echo $save;
}
if($action == "book_flight"){
	$save = $crud->book_flight();
	if($save)
		echo $save;
}

if($action == "update_booked"){
	$save = $crud->update_booked();
	if($save)
		echo $save;
}


