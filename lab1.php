<?php 
include_once 'user.php';

//include_once 'fileUploader.php';

session_start();

	$con = new DBConnector();
	$db = $con->DBConnect();
//code to insert data
if (isset($_POST['btn-save'])) {
	# code...
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city_name = $_POST['city_name'];
	$username = $_POST['Username'];
	$password = $_POST['Password'];
	$name = $_FILES['fileToUpload']['name'];



  
	//user object
	$user = new User($first_name,$last_name,$city_name,$username,$password,$name);

	if ($user->validateForm())
	 {
		# code...
	
		if(!$user->userExists()){
			$sql = $user->save();
			// Check extension

 
	

		
			//check if save works
			if ($sql) {
				# code...
				echo "Save operation was successful";
			}
			else
			{
					echo "Please choose an image!";
					echo mysqli_error($con->DBConnect());
			}
		
		} 
		
	} else {
		$user->createFormErrorSessions();
		header("Refresh:0");
		die();
	}	


}


	function getUsers()
	{
		$user = new User;
		$result = $user->readAll("user");

		echo "<table>";
		
		while($row = $result->fetch_array()) {

			echo "<tr>";
			echo "<td> ".$row['id']. "</td>";
			echo "<td> ".$row['username']."</td>";
			echo "<td> ".$row['first_name']."</td>";
			echo "<td> ".$row['last_name']."</td>";
			echo "<td> ".$row['user_city']."</td>";
			echo "<td> ".$row['myFileName']."</td>";

			echo "</tr>";
		}

		echo "</table>";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Title goes here</title>

	<script type="text/javascript" src="validate.js" ></script>

	<link rel="stylesheet" type="text/css" href="validate.css">
	
	<!--include the jquery file for timezone thingys -->
	<script src="jquery-3.3.1.js"></script>

	<script type="text/javascript" src="timezone.js"></script>

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">

	<span class="span"><h1>Enter Data in the table below</h1></span>


	<form  method="post" name="user_details" id="user_details" enctype="multipart/form-data" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>" >
		<table class="table table-sm">

			<tr>
				<td>
					<div id="form-errors">
						<?php 

							if(session_status() == PHP_SESSION_NONE) 
							{
								session_start();
							}

							if(!empty($_SESSION['form-errors']))
							{
								echo "".$_SESSION['form-errors'];
								unset($_SESSION['form-errors']);
							}
						?>
						
					</div>
				</td>
			</tr>

			<tr>
				<td><input type="text" name="first_name" placeholder="First Name" autocomplete="off" /></td>
			</tr>

			<tr>
				<td><input type="text" name="last_name" placeholder="Last Name" autocomplete="off" /></td>
			</tr>

			<tr>
				<td><input type="text" name="city_name" placeholder="City" autocomplete="off" /></td>
			</tr>

			<tr>
				<td><input type="text" name="Username" placeholder="Username"></td>
			</tr>

			<tr>
				<td><input type="password" name="Password" placeholder="Password"></td>
			</tr>
			<tr>
				<td>Profile Image: <input type="file" name="fileToUpload" id="fileToUpload"></td>
			</tr>

			<tr>
				<td><button class="btn btn-primary" type="submit" name="btn-save"><strong>SAVE</strong></button></td>
			</tr>

				<input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""/>
				<input type="hidden" name="time_zone_offset" id="time_zone_offset" value=""/>
		
			<tr>
				<td><a href="login.php">Click here to check your account</a></td>
			</tr>
		</table>
		
	</form>


	</table>
</div>
	
		<?php getUsers(); ?>

</body>

</html>