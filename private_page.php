<?php 
session_start();
if (!isset($_SESSION['username']))
 {
	# code...
	header("Location:login.php");
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
	<p>This is a private page</p>
	<p>We want to protect it</p>
	<p><a href="logout.php">Logout</a></p>
</body>
</html>