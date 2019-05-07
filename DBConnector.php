<?php 

define('DB_SERVER','localhost'); //local db
define('DB_USER','root'); //user
define('DB_PASS',''); //user pass
define('DB_NAME','btc3205'); // my db name

/**
* 
*/
class DBConnector 
{
	public $conn;

	public function DBConnect() //has no argumnets, so i cannot give the property my own values at will
	{
		# code...

		$this->conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME) or die("Error:" .mysqli_connect_error());

		return $this->conn;

	}

	public function closeDatabase() //after done with db
	{
		mysqli_close($this->DBConnect());
	}

	


}

// $conn = DBConnector::getConnection();
// echo $conn->get_client_info();


?>