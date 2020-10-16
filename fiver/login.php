<!DOCTYPE>
<html>
<head>
<style>
.my{
	border : solid 1px black;
	border-collapse : collapse;
}
</style>
</head>

<body>
<?php
session_start();
include('conn.php');
extract($_POST);
extract($_SESSION);
if(isset($user_id)){
	header("Location: index.php");
}
if(isset($submit)){
	$hashedpass = md5($password);
	$query = "SELECT * FROM user WHERE username = '$username' AND password = '$hashedpass' LIMIT 1 ;";
	if ($result = mysqli_query($conn, $query)) {
	  	if($row = mysqli_fetch_row($result)) {
			$_SESSION['user_id'] = $row[0];
			$_SESSION['username'] = $username;
			header("Location: index.php");
		}
	}	
}
?>
<form action="login.php" method="post">
	<center>
	<div style="border: solid 1px; Width:500px"> 
	<h1><i>Login</i></h1>
	<?php if(isset($submit))
			echo '<p>Invalid Username or Password</p>';
		?>
	<table>
		<tr>
			<td><p>User Name</p></td>		
			<td><input type="text" name="username"> </td></tr>
		<tr>
			<td><p>Password</p></td>		
			<td><input type="password" name="password"> </td></tr>	
		<tr>	
			<td></td>
			<td><input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset"></td></tr>	
	</table>
	<p>If you are a new user create a account from <a href="signup.php">here</a></p>
	</div>
	</center>
</form>
<?php
?>
</body>

</html>
