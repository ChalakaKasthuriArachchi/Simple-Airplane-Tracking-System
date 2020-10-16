<?php
$servername = "localhost";
$username = "root";
$password = "21164";
$database = 'assignment';

// Create Connection
$conn = mysqli_connect($servername,$username,$password);

//Check Connection
if(!$conn)
	die("Connection Failed : ".mysqli_connect_error());

$result = mysqli_select_db ($conn ,$database);
if(!$result){
	echo "Unable to Create";
	die("Connection Failed : ".mysqli_connect_error());
}

?>
