<?php
$sname= 'localhost';
$uname= 'root';
$password = '';
$db_name = `airline_ticketing`;
$conn = mysqli_connect('localhost', 'root', '', 'airline_ticketing');
if (!$conn) {

    echo "Connection failed!";

}
?>



