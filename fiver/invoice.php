<?php
	session_start();
	extract($_POST);
	extract($_SESSION);
	if(!isset($user_id))
		header("Location: login.php");	
	include('conn.php');
	if(!isset($flyID) || !isset($depTime))
		header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
</head>
<body>
	<?php
		//Check
		$query = "SELECT COUNT(`flyID`) AS 'reserved', capacity,distance,(pricemi * distance) AS 'price'  FROM assignment.bookings LEFT JOIN flyies ON flyID = ID LEFT JOIN aircraft ON flyies.craftID = aircraft.craftID LEFT JOIN routes ON flyies.routeID = routes.routeID  WHERE flyID = '$flyID' group by (`dateTime`);";
		if($result = mysqli_query($conn, $query)){
			if(!($row = mysqli_fetch_assoc($result)) OR ($row['reserved'] < $row['capacity'])){
					//Insert
					$query = "INSERT INTO bookings(flyID,`dateTime`,user_id) VALUES('$flyID','$depTime','$user_id');";
					if ($result = mysqli_query($conn, $query)){
						$query = "SELECT model,(distance/cruisekn) AS hrs,airport FROM flyies LEFT JOIN aircraft ON flyies.craftID = aircraft.craftID LEFT JOIN routes ON routes.routeID = flyies.routeID LEFT JOIN destinations ON `code` = point1 or `code` = point2 WHERE flyies.ID = $flyID";
						if($result = mysqli_query($conn, $query)){
							echo "<table>";
							echo '<tr><td colspan="2"><h3>Invoice</h3></td></tr>';
							
							echo '<tr>';
							echo '<td>Customer</td>';
							echo "<td>$username</td>";
							echo '</tr>';
							
							$row2 = mysqli_fetch_assoc($result);
							echo '<tr>';
							echo '<td>Aircraft</td>';
							echo "<td>".$row2["model"]."</td>";
							echo '</tr>';
							
							echo '<tr>';
							echo '<td>Start</td>';
							echo "<td>".$row2['airport']."</td>";
							echo '</tr>';

							echo '<tr>';
							echo '<td>Departure Time</td>';
							echo "<td>$depTime/td>";
							echo '</tr>';

							$row2 = mysqli_fetch_assoc($result);
							echo '<tr>';
							echo '<td>End</td>';
							echo "<td>".$row2['airport']."</td>";
							echo '</tr>';

							echo '<tr>';
							echo '<td>Arrival Time</td>';
							echo "<td>".date('Y-m-d H:m', strtotime($depTime. ' + '.round($row2['hrs'] * 60).' minutes'))."</td>";
							echo '</tr>';

							$query = "SELECT distance,(distance * pricemi) AS Price FROM assignment.flyies LEFT join routes ON routes.routeID = flyies.routeID LEFT JOIN aircraft ON aircraft.craftID = flyies.craftID WHERE ID = $flyID";
							$result3 = mysqli_query($conn, $query);
							$row3 = mysqli_fetch_assoc($result3);
							echo '<tr>';
							echo '<td>Distance</td>';
							echo "<td>".$row3['distance']."</td>";
							echo '</tr>';

							echo '<tr>';
							echo '<td>Price</td>';
							echo "<td>$".$row3['Price']."</td>";
							echo '</tr>';

							echo "</table>";
						}
					}
					else
						echo "Unble to Place Booking";
			}
			else
				echo '<h5>No Seats Available</h5>';
		}
		else
			echo "ERROR";
	?>
</body>
</html>