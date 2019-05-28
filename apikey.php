<?php

include_once 'DBConnector.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST' )
    {
        header('HTTP/1.0 403 Forbidden');
        echo "You are forbidden";
        echo $_SERVER['REQUEST_METHOD'];

    }else{
        
        $api_key = null;
        $api_key = generateApiKey(64);//will be 64 characters long
        header('Content-type: application/json');
        echo generateResponse($api_key);
        //exit(generateResponse($api_key));

        
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

        function saveApiKey(/*$api_key*/)
        {
            // //will save the api key for the user, true if saved else false
            // $db = new DBConnector();
            // $db = $this->db->DBConnect();
            // $username = $_SESSION['username'];
            // $res = mysqli_query($db, "SELECT id from user where user.username='$username'") or die("ERROR ON SAVE:" . mysqli_error($db));
            // $row = mysqli_fetch_array($res);
            // $user_id = $row['id'];
            // if ($user_id) {
            //     $q = mysqli_query($db, "SELECT 1 FROM api_keys WHERE user_id = '$user_id'");
            //     $exists = count(mysqli_fetch_array($q)) > 0;
            //     if ($exists) {
            //         $res = mysqli_query($db, "UPDATE api_keys SET api_key='$api_key' WHERE user_id='$user_id'") or die("ERROR ON SAVE:" . mysqli_error($db));
            //     } else {
            //         $res = mysqli_query($db, "INSERT INTO api_keys(user_id, api_key) VALUES('$user_id', '$api_key') ") or die("ERROR ON SAVE:" . mysqli_error($db));
            //     }
            //     return $res;
            // } else {
            //     return false;
            // }
        }

        function generateResponse($api_key)
        {
            if (saveApiKey(/*$api_key*/))
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