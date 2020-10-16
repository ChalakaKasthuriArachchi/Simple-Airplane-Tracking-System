<?php
session_start();
extract($_SESSION);
extract($_POST);
if(!isset($user_id))
	header("Location: login.php");	
include('conn.php');

if(isset($bookingID)){
		$query = "DELETE FROM assignment.bookings WHERE user_id = $user_id AND bookingID=$bookingID";
		$result = mysqli_query($conn, $query);
		echo $query;
}
header("Location: bookings.php");	
?>