<?php
include_once "apiHandler.php";
include_once "../../../DBConnector.php";

$api = new ApiHandler();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    # code...
    $api_key_correct = false;
    $headers = apache_request_headers();
    $header_api_key = $headers['Authorization'];

    $api->setUserApiKey($header_api_key);
    $api_key_correct = $api->checkApiKey();

    if ($api_key_correct) {
        # code...
            $name_of_food = $_POST['name_of_food'];
            $number_of_units = $_POST['number_of_units'];
            $unit_price = $_POST['unit_price'];
            $order_status = $_POST['order_status'];
        
            $con = new DBConnector();
            $conn = $con->DBConnect();

            $api->setMealName($name_of_food);
            $api->setMealUnits($number_of_units);
            $api->setUnitPrice($unit_price);
            $api->setStatus($order_status);
            $res = $api->createOrder();

            if ($res) {
                # code...
                $response_array = ['success' => 1, 'message' => "Order has been placed"];
                    header('Content-Type: application/json');
                    echo json_encode($response_array);
            }
    }
    else{
        $response_array = ['success' => 1, 'message' => "Wrong API key"];
        header('Content-Type: application/json');
        echo json_encode($response_array);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    # code...
    
    $order_status = $api->checkOrderStatus($_GET["order_id"]);
    echo json_encode([
        'order_status' => $order_status
    ]);


    // sorry not supporting this for now

// function responseHandler($success, $message, $data = null)
// {
//     $response_array = ['success' => $success, 'message' => $message, 'data' => $data];
//     header('Content-Type: application/json');
//     echo json_encode($response_array);
// }

// $isPOST = $_SERVER['REQUEST_METHOD'] === 'POST';
// $isGET = $_SERVER['REQUEST_METHOD'] === 'GET';

// if ($isPOST || $isGET) {
//     $db = new DBConnector();
//     $api = new ApiHandler($db);
//     $api_key_correct = false;

//     $headers = apache_request_headers();
//     $header_api_key = $headers['Authorization'];
//     // Split this => "Basic the_long_api_key"
//     $key = explode(" ", $header_api_key)[1];
//     $api->setUserApiKey($key);

//     $api_key_correct = $api->checkApiKey($key);

//     if ($api_key_correct) {
//         if ($isPOST) {
//             $data = json_decode(file_get_contents('php://input'), true);
//             $name_of_food = $data['name_of_food'];
//             $units = $data['number_of_units'];
//             $unit_price = $data['unit_price'];
//             $order_status = $data['order_status'];

//             // TODO: server side check if all values exist
//             $api->setMealName($name_of_food);
//             $api->setMealUnits($units);
//             $api->setUnitPrice($unit_price);
//             $api->setStatus($order_status);
//             $res = $api->createOrder();

//             if ($res) {
//                 responseHandler(1, 'Order has been placed', $res);
//             } else {
//                 responseHandler(0, 'Something went terribly wrong');
//             }
//         } else if ($isGET) {
//             $res = $api->checkOrderStatus($_GET['order_id']);
//             if ($res) {
//                 responseHandler(1, "Order status is: $res");
//             } else {
//                 responseHandler(0, 'Something went terribly wrong');
//             }
//         }
//     } else {
//         responseHandler(0, 'Wrong Api key');
//     }
//     $db->closeDatabase();
// }

}
 else {
    responseHandler(0, 'No support for this at the moment');
}


