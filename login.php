<?php 

include_once "user.php";

$con = new DBConnector();

if (isset($_POST['btn-Login']))
 {
	# code...
	$username = $_POST['username'];
	$password = $_POST['password1'];
	$instance = User::create();
	$instance->setPassword($password);
	$instance->setUsername($username);

	if ($instance->isPasswordCorrect())
	 {
		# code...
		$instance->login();
		$con->closeDatabase();
		$instance->createUserSession();
	}else
	{
		$con->closeDatabase();
		header("Location:login.php");

	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>

	<script type="text/javascript" src="validate.js" ></script>

	<link rel="stylesheet" type="text/css" href="validate.css">
</head>
<body>

	<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="login" id="login">
		<table align="center">
			<tr>
				<td><input type="text" name="username" placeholder="Username" required></td>
			</tr>

			<tr>
				<td><input type="password" name="password1" placeholder="Password" required>		
			</td>
		</tr>

		<tr><td><button type="submit" name="btn-Login">LOGIN</button></td></tr>
		</table>
		
	</form>
	
</body>
</html> 