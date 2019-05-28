<?php 
 session_start();

 include_once "DBConnector.php";
 function fetchUserApiKey()
        {
            $db = new DBConnector();
           // $con = $this->db->DBConnect();
            $username = $_SESSION['username'];
            $res = mysqli_query($db->DBConnect(), "SELECT id from user where user.username='$username'") or die("ERROR ON SAVE:" . mysqli_error($db));
            $row = mysqli_fetch_array($res);
            $user_id = $row['id'];
            if ($user_id) {
                $res = mysqli_query($db->DBConnect(), "SELECT api_key from api_keys where api_keys.user_id='$user_id'") or die("ERROR ON SAVE:" . mysqli_error($db));
                $row = mysqli_fetch_array($res);
                return $row[0];
            } else {
                echo 'No such user exists';
                return null;
            }}

// if (!isset($_SESSION['username']))
//  {
// 	# code...
// 	header("Location:login.php");
// }
// include_once 'DBConnector.php';

// if ($_SERVER['REQUEST_METHOD'] !== 'POST' )
// {
	
	
// 	//$api_key = null;
// 	$api_key = generateApiKey(64);//will be 64 characters long
// 	header('Content-type: application/json');
// 	echo generateApiKey($api_key);
// 	exit(generateResponse($api_key));

	
// }
// 	function generateApiKey($str_length)
// 	{
// 		//base 62 map
// 		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

// 		$bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

// 		$repl = unpack('C2', $bytes);

// 		$first = $chars[$repl[1] % 62];
// 		$second = $chars[$repl[2] % 62];
// 		return strtr(substr(base64_encode($bytes), 0, $str_length),'+/',"$first$second");

// 	}

// 	function saveApiKey($api_key)
// 	{
// 		//will save the api key for the user, true if saved else false
// 		$db = new DBConnector();
// 		$db = $this->db->DBConnect();
// 		$username = $_SESSION['username'];
// 		$res = mysqli_query($db, "SELECT id from user where user.username='$username'") or die("ERROR ON SAVE:" . mysqli_error($db));
// 		$row = mysqli_fetch_array($res);
// 		$user_id = $row['id'];
// 		if ($user_id) {
// 			$q = mysqli_query($db, "SELECT 1 FROM api_keys WHERE user_id = '$user_id'");
// 			$exists = count(mysqli_fetch_array($q)) > 0;
// 			if ($exists) {
// 				$res = mysqli_query($db, "UPDATE api_keys SET api_key='$api_key' WHERE user_id='$user_id'") or die("ERROR ON SAVE:" . mysqli_error($db));
// 			} else {
// 				$res = mysqli_query($db, "INSERT INTO api_keys(user_id, api_key) VALUES('$user_id', '$api_key') ") or die("ERROR ON SAVE:" . mysqli_error($db));
// 			}
// 			return $res;
// 		} else {
// 			return false;
// 		}
// 	}

// 	function generateResponse($api_key)
// 	{
// 		if (saveApiKey($api_key))
// 		 {
// 			# code...
// 			$res = ['success' => 1, 'message' => $api_key];
// 		}else {
// 			# code...
// 			$res = ['success' => 0, 'message' => 'Something is wrong.Please generate the api key again.'];
// 		}
// 		return json_encode($res);
// 	}

// 	function fetchUserApiKey()
// 	{
// 		$db = new DBConnector();
// 		$db = $this->db->DBConnect();
// 		$username = $_SESSION['username'];
// 		$res = mysqli_query($db, "SELECT id from user where user.username='$username'") or die("ERROR ON SAVE:" . mysqli_error($db));
// 		$row = mysqli_fetch_array($res);
// 		$user_id = $row['id'];
// 		if ($user_id) {
// 			$res = mysqli_query($db, "SELECT api_key from api_keys where api_keys.user_id='$user_id'") or die("ERROR ON SAVE:" . mysqli_error($db));
// 			$row = mysqli_fetch_array($res);
// 			return $row[0];
// 		} else {
// 			echo 'No such user exists';
// 			return null;
// 		}
// 	}
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

<body style="margin:5px;">
	<p id="line1">Welcome, <?php echo $_SESSION['username']; ?></p>
	<p id="line1">This is a private page</p>
	<p id="line1">We want to protect it</p>
	<a href="logout.php" class="btn btn-primary">Logout</a><br><br>

	Create an api for users to order items from external systems.
	Feature for users to generate api key by clicking a button.<br>

	<button class="btn btn-primary" id="api-key-btn">Generate api key</button><br><br>

	<!-- text area to hold api key	-->
	<strong>You API KEY:</strong>
	if your api key is already in use by running applications, generating a new api key will 
	stop the application from running.<br>

	<textarea name="api_key" id="api_key" cols="100" rows="4" readonly><?php echo fetchUserApiKey(); ?></textarea>

	<br>
	Service description
	We have a service/API that allows external applications to order food and also pull all order status by using order id.
</body>
</html>