<!DOCTYPE html>
<?php
session_start();
extract($_SESSION);
if(!isset($user_id))
	header("Location: login.php");	
include('conn.php');
?>
<html>
<head>
	<title>Bookings</title>
</head>
<body>
	<?php include('navbar.php');?>
	<h3> Bookings </h3>
	<?php
		$query = "SELECT * FROM assignment.bookings left join flyies ON flyID = ID LEFT JOIN routes ON flyies.routeID = routes.routeID LEFT JOIN aircraft ON flyies.craftID = aircraft.craftID WHERE user_id = $user_id";
		if($result = mysqli_query($conn, $query)){
			echo '<table>';
			echo '<tr><th>Aircraft</th><th>Date & Time</th><th>Start</th><th>Destination</th><th></th></tr>';
			while($row = mysqli_fetch_assoc($result)){
				$flyID = $row['flyID'];
				$query = "SELECT airport FROM flyies LEFT JOIN aircraft ON flyies.craftID = aircraft.craftID LEFT JOIN routes ON routes.routeID = flyies.routeID LEFT JOIN destinations ON `code` = point1 or `code` = point2 WHERE flyies.ID = $flyID";
				$result2 = mysqli_query($conn, $query);
				echo '<tr>';
				echo '<td>'.$row['model'].'</td>';
				echo '<td>'.$row['dateTime'].'</td>';
				$row2 = mysqli_fetch_assoc($result2);
				echo '<td>'.$row2['airport'].'</td>';
				$row2 = mysqli_fetch_assoc($result2);
				echo '<td>'.$row2['airport'].'</td>';
				echo '<td><form action="cancelbooking.php" method="POST">';
				echo '<input type="text" name ="bookingID" value="'.$row['bookingID'].'" hidden>';
				echo '<input type="submit" name ="submit" value="Cancel">';
				echo "</form></td>";
				echo '</tr>';
			}
			echo '</table>';
		}
		else
			echo "<h2>No Bookings Found</h2>";
	?>
</body>
</html>