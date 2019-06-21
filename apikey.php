<?php
session_start();

// include_once 'DBConnector.php';
include_once 'user.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' )
    {
        header('HTTP/1.0 403 Forbidden');
        echo "You are forbidden";

    }else{
        
        $api_key = null;
        $api_key = generateApiKey(64);//will be 64 characters long
        header('Content-type: application/json');
        echo generateResponse($api_key);

        
    }
        function generateApiKey($str_length)
        {
            //base 62 map
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

            $repl = unpack('C2', $bytes);

            $first = $chars[$repl[1] % 62];
            $second = $chars[$repl[2] % 62];
            return strtr(substr(base64_encode($bytes), 0, $str_length),'+/',"$first$second");

        }

        function saveApiKey($api_key)
        {
            $con = new DBConnector();
            $conn = $con->DBConnect();
            $userid = $_SESSION['id'];
            $query = "INSERT INTO api_keys(user_id,api_key) VALUES(?,?)";

            if(!$stmt = $conn->prepare($query)) { //PREPARE THE QUERY IN PS
                die($conn->error);
            } 

            $stmt->bind_param("is",$userid,$api_key);//bind parameters and specify the data types

            // execute the query
            if($sql = $stmt->execute()) {
            } else {
                $conn->error;
            }
            return $sql;

        }

        function generateResponse($api_key)
        {
            if (saveApiKey($api_key))
            {
                # code...
                $res = ['success' => 1, 'message' => $api_key];
            }else {
                # code...
                $res = ['success' => 0, 'message' => 'Something is wrong.Please generate the api key again.'];
            }
            return json_encode($res);
        }

       
        
?>