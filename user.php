<?php 

include "Crud.php";
include "authenticator.php";
include "DBConnector.php";
/**
* 
*/
class User implements Crud,Authenticator
{
	
	private $user_id;
	private $first_name;
	private $last_name;
	private $city_name;

	private $username;
	private $password;

	private $imageUpload;

	private $utc_timestamp;
	private $offset;

	private $db;



	function __construct($first_name="",
	$last_name="",$city_name="",$username="",
	$password="",$imageUpload="",$utc_timestamp="",$offset="") //construct has arguments, means at some point i will give the properties values myself
	{
		# code...
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->city_name = $city_name;

		$this->username = $username;
		$this->password = $password;

		$this->imageUpload = $imageUpload;

		$this->utc_timestamp = $utc_timestamp;
		$this->offset = $offset;


		$this->db = new DBConnector();
	}

	//static constructor

	public static function create()
	{
		$instance = new self();
		return $instance;
	}

	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

	/*
	public function setTimeStamp($userTime)
	{
		$this->userTime = $userTime;
	}

	public function getTimeStamp()
	{
		return $this->userTime;
	}*/

	
	//set userid
	public function setUserId ($user_id)
	{
		$this->user_id = $user_id;
	}


	//get userid

	public function getUserId($user_id)
	{
		return $this->user_id;
	}

	//implement all methods from the Crud interface to avoid an int error

	public function save()
	{

		$fn = $this->first_name;// values to be entered
		$ln = $this->last_name;
		$city = $this->city_name; 
		$uname = $this->username;
		$this->hashPassword();
		$pword = $this->password;
		$img = $this->imageUpload;
		$name = $_FILES['fileToUpload']['name'];

		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	  
		// Select file type
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	  
		// Valid file extensions
		$extensions_arr = array("jpg","jpeg","png","gif");
		
		if( in_array($imageFileType,$extensions_arr) ){

		$query = "INSERT INTO user(first_name,last_name,user_city,username,password,myFileName,offset,date)
		 VALUES (?,?,?,?,?,?,?,NOW())"; //SQL QUERY TEMPLATE


		$db = $this->db->DBConnect();
		$stmt = $db->prepare($query); //PREPARE THE QUERY IN PS

		$stmt->bind_param("ssssssi",$fn,$ln,$city,$uname,$pword,$img,$this->offset);//bind parameters and specify the data types

		// execute the query
		if($sql = $stmt->execute()) {
			$db->error;
		}
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$target_dir.$name);

		return $sql;
		// Upload file

}
		
	}

	public function hashPassword()
	{
		//INBUILT FUNCTION CALLED PASSWORD_HASH
		// TO HASH THE PASSWORDS
		$this->password = password_hash($this->password,PASSWORD_DEFAULT);
	}

	public function isPasswordCorrect()
	{
		$conn = $this->db->DBConnect();
		$username = $this->getUsername();
		$found = false;

		$stmt = $conn->prepare("SELECT id,username,password FROM user WHERE username=?") or die("Error:".mysqli_error($conn));
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$res = $stmt->get_result();

		while ($row = mysqli_fetch_array($res))
		 {
			if (password_verify($this->getPassword(),$row['password']))
			 {
				# code...
				$found = true;
			}
		 }
		
		

		$this->db->closeDatabase();
		return $found;
	}

	public function login()
	{
		if ($this->isPasswordCorrect())
		 {
			# code...
			//password is correct so we load the protected page
			header("Location:private_page.php");
		}
	}

	public function createUserSession()
	{
		session_start();
		$_SESSION['username'] = $this->getUsername();

	}

	public function logout()
	{
		session_start();
		unset($_SESSION['username']);
		session_destroy();
		header("Location:lab1.php");
	}

	

	public function readAll($table)
	{
		$query = "SELECT * FROM ".$table;	
		

		$conn = $this->db->DBConnect();
		if($stmt = $conn->prepare($query))	
			$stmt->execute();
		else
			echo 'error .>...........';
			echo $conn->error;

		$result = $stmt->get_result();
		return $result;
	}

	public function readUnique()
	{

		return null;
	}

	public function search ()
	{
		return null;
	}


	public function update()
	{
		return null;
	}

	public function removeOne()
	{
		return null;
	}

	public function removeAll()
	{
		return null;
	}

	public function validateForm()
	{
		$fn = $this->first_name;
		$ln = $this->last_name;
		$city = $this->city_name;
		$uname = $this->username;
		$pword = $this->password;


		if($fn == "" || $ln = "" || $city = "" || $uname = "" || $pword = "")
		{
			return false;
		}

		return true;
	}

	public function userExists()
	{
		$conn = $this->db->DBConnect();
		$username = $this->getUsername();

		$stmt = $conn->prepare("SELECT * FROM user WHERE username=?") or die("Error:".mysqli_error($conn));

		$stmt->bind_param("s", $username);
		$stmt->execute();
		$res = $stmt->get_result();

		if($res->num_rows > 0)
		{
			$this->createFormErrorSessions2("That username exists!");
			return true;
		}
		return false;
	}

	public function createFormErrorSessions()
	{
		session_start();
		$_SESSION['form-errors'] = "Some fields are missing";

	}

	public function createFormErrorSessions2($error)
	{
		// session_start();
		$_SESSION['form-errors'] = $error;
	}

}


?>