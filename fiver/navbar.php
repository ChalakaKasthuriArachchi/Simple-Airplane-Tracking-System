<?php
	if(isset($user_id))
		$log = '<a href="logout.php">'.$username.' | Log Out</a>';
	else
		$log = '<a href="login.php">Log In</a>';
	echo '<p><a href="index.php">Home</a> &nbsp;&nbsp;<a href="bookings.php">Bookings</a> &nbsp;&nbsp;'.$log.'</p>';
?>