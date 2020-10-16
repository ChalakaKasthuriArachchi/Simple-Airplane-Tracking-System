<!DOCTYPE html>
<?php
session_start();
extract($_SESSION);
if(!isset($user_id))
	header("Location: login.php");	
include('conn.php');
extract($_GET);
?>
<html>
<head>
	<title>Welcome</title>
</head>
<body>
	<?php include('navbar.php');?>
	<div>
		<form action="" method="GET">
			<!--First name-->
            <p>Start:</p>
            <select name="code_start" id="start">
            	<option value="0" selected hidden>Select the Starting Point</option>
            	<?php
            		$query = "SELECT * FROM `destinations` ORDER BY `region`;";
            		if($result = mysqli_query($conn, $query)){
            			while($row = mysqli_fetch_assoc($result)){
            				echo '<option value="'.$row['code'].'"'.($row['code'] == $code_start ? 'selected' : '').'>'.$row['airport'].','.$row['region'].'</option>';
            			}
            		}
            	?>
            </select>
            <p>End:</p>
            <select name="code_end" id="end">
            	<option value="0" selected hidden>Select the End Point</option>
            	<?php
            		if($result = mysqli_query($conn, $query)){
            			while($row = mysqli_fetch_assoc($result)){
            				echo '<option value="'.$row['code'].'"'.($row['code'] == $code_end ? 'selected' : '').'>'.$row['airport'].','.$row['region'].'</option>';
            			}
            		}
            	?>
            </select><br><br>
            <input type="submit" value="Find">
		</form>
	</div>
	<div>
		<?php 
			if(isset($code_start) && isset($code_end))
			{

				$query = "SELECT airport,region FROM `destinations` WHERE code = '".$code_start."';";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$name_start = $row['airport'].', <i>'.$row['region'].'</i>';

				$query = "SELECT airport,region FROM `destinations` WHERE code = '".$code_end."';";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$name_end = $row['airport'].', <i>'.$row['region'].'</i>';
				echo '<h3>'.$name_start.' - '.$name_end.'</h3>';
				$day_of_week = date('w');
				$time = date('H:i');
				$query = "SELECT ID,flyies.routeID, distance,day,`time`, model, capacity, rangenmi,cruisekn,(distance/cruisekn) as hrs
						  FROM assignment.flyies LEFT JOIN routes ON flyies.routeID = routes.routeID LEFT JOIN 
						  aircraft ON flyies.craftID = aircraft.craftID WHERE ((point1 = '$code_start' AND point2 = '$code_end' AND direction = 0) OR (point2 = '$code_start' AND point1 = '$code_end' AND direction = 1)) AND ((day > $day_of_week) OR (day = $day_of_week AND `time` > '$time'));";
				//echo $query;
				if($result = mysqli_query($conn, $query)){
					
					echo "<table>";
					echo "<tr><th>No</th><th>Aircraft</th><th>Capacity</th><th>Departure</th><th>Arrival</th><th>Booking</th></tr>";
					$n = 1;
					while($row = mysqli_fetch_assoc($result)){
						echo "<tr>";
						echo "<td>".$n."</td>";
						echo "<td>".$row['model']."</td>";
						echo "<td>".$row['capacity']."</td>";
						$dis = $row['day'] - $day_of_week;
						$departure = date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$dis.' days'))." ".$row['time'];
						echo "<td>".$departure."</td>";
						echo "<td>".date('Y-m-d H:m', strtotime($departure. ' + '.round($row['hrs'] * 60).' minutes'))."</td>";
						echo '<td><form action="invoice.php" method="POST">';
						echo '<input type="text" name ="flyID" value="'.$row['ID'].'" hidden>';
						echo '<input type="text" name ="depTime" value="'.$departure.'" hidden>';
						echo '<input type="submit" name ="submit" value="ADD">';
						echo "</form></td>";
						echo "</tr>";
						$n++;
					}
					$query = "SELECT ID,flyies.routeID, distance,day,`time`, model, capacity, rangenmi,cruisekn,(distance/cruisekn) as hrs
						  FROM assignment.flyies LEFT JOIN routes ON flyies.routeID = routes.routeID LEFT JOIN 
						  aircraft ON flyies.craftID = aircraft.craftID WHERE ((point1 = '$code_start' AND point2 = '$code_end' AND direction = 0) OR (point2 = '$code_start' AND point1 = '$code_end' AND direction = 1)) AND ((day < $day_of_week) OR (day = $day_of_week AND `time` < '$time'));";
					if($result = mysqli_query($conn, $query)){
							while($row = mysqli_fetch_assoc($result)){
							echo "<tr>";
							echo "<td>".$n."</td>";
							echo "<td>".$row['model']."</td>";
							echo "<td>".$row['capacity']."</td>";
							$dis = 7 + $row['day'] - $day_of_week;
							$departure = date('Y-m-d', strtotime(date('Y-m-d'). ' + '.$dis.' days'))." ".$row['time'];
							echo "<td>".$departure."</td>";
							echo "<td>".date('Y-m-d H:m', strtotime($departure. ' + '.round($row['hrs'] * 60).' minutes'))."</td>";
							echo '<td><form action="invoice.php" method="POST">';
							echo '<input type="text" name ="flyID" value="'.$row['ID'].'" hidden>';
							echo '<input type="text" name ="depTime" value="'.$departure.'" hidden>';
							echo '<input type="submit" name ="submit" value="ADD">';
							echo "</form></td>";
							echo "</tr>";
							$n++;
						}
					}
					if($n == 1)
						echo '<tr><td colspan="6"><h5>No Available Aircrafts</h5></td></tr>';
					echo "</table>";
				}
				else{
					
					;
				}
			}
		?>
	</div>
</body>
</html>