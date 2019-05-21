<?php 
session_start();
include_once 'DBConnector.php';

if (!isset($_SESSION['username']))
 {
	# code...
	header("Location:login.php");
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
 {

	# code...
	//do not allow users via a url
	header('HTTP/1.0 403 Forbidden');
	echo "Access is forbidden";
} else {
	$api_key = null;
	$api_key = generateApiKey(64);//will be 64 characters long
	header('Content-type: application/json');
	echo generateApiKey($api_key);
	
}
	function generateApiKey($str_length)
	{
		//base 62 map
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

		$repl = unpack("C2", $bytes);

		$first = $chars[$repl[1]%62];
		$second = $chars[$repl[2]%62];
		return strtr(substr(base64_encode($bytes),0,$str_length),'+/',"$first$second");

	}

	function saveApiKey()
	{
		//will save the api key for the user, true if saved else false

	}

	function generateResponse($api_key)
	{
		if (saveApiKey())
		 {
			# code...
			$res = ['success' => 1, 'message' => $api_key];
		}else {
			# code...
			$res = ['success' => 0, 'message' => 'Something is wrong.Please generate the api key again.'];
		}
		return json_encode($res);
	}

	function fetchUserApiKey()
	{

	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>

	<script src="jquery-3.3.1.js"></script>
	<script type="text/javascript" src="validate.js" ></script>
	<script type="text/javascript" src="apikey.js"></script>

	<link rel="stylesheet" type="text/css" href="validate.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<style>
#line1
{
	font-size:30px;
	text-align:center;
}
</style>
</head>

<body>
	<p id="line1">This is a private page</p>
	<p id="line1">We want to protect it</p>
	<button class="btn btn-primary">Logout<a href="logout.php"></a></button><br><br>

	Create an api for users to order items from external systems.
	Feature for users to generate api key by clicking a button.<br>

	<button class="btn btn-primary" id="api-key-btn">Generate api key</button><br><br>

	<!-- text area to hold api key	-->
	<strong>You API KEY:</strong>
	if your api key is already in use by running applications, generating a new api key will 
	stop the application from running.<br>

	<textarea name="api_key" id="api_key" cols="100" rows="2" readonly><?php echo fetchUserApiKey(); ?></textarea>

	<br>
	Service description
	We have a service/API that allows external applications to order food and also pull all order status by using order id.
</body>
</html>