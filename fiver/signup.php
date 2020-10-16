<?php
session_start();
?>
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
include('conn.php');
extract($_POST);
if(isset($submit)){
	session_destroy();
	if(strlen($username) > 0 && strlen($password) > 0){
		$query = "SELECT * FROM user WHERE username = '$username' LIMIT 1 ;";
		$result = mysqli_query($conn, $query);
		if ($row = mysqli_fetch_row($result)) {
			$error = "Already Exists an Account with the User name you entered";	
		}
		else
		{
			$hashedpass = md5($password);
			$query = "INSERT INTO user (username,password) VALUE('$username','$hashedpass');";
			if ($result = mysqli_query($conn, $query))
				header("location:login.php");
			else
				$error = "Unable to Create Account At the Moment";
		}
	}
	else
		$error = "Username or Password not Entered";	
}
?>
<form action="signup.php" method="post">
	<center>
	<div style="border: solid 1px; Width:500px"> 
	<h1><i>Sign Up</i></h1>
	<?php if(isset($error))
			echo "<p>$error</p>";
		?>
	<table>
		<tr>
			<td><p>User Name</p></td>		
			<td><input type="text" name="username" <?php 
				echo isset($username) ? 'value="'.$username.'"' : '';?>> </td></tr>
		<tr>
			<td><p>Password</p></td>		
			<td><input type="text" name="password" <?php 
				echo isset($password) ? 'value="'.$username.'"' : '';?>> </td></tr>	
			<td></td>
			<td><input type="submit" name="submit" value="Submit">
			<input type="reset" name="reset"></td></tr>	
		
	</table>
	<p>If you have a user account Login <a href="login.php">here</a></p>
	</div>
	</center>
</form>
<?php
?>
</body>

</html>
