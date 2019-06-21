<?php 

include_once "../../../DBConnector.php";

class ApiHandler
{
    private $meal_name;
    private $meal_units;
    private $unit_price;
    private $status;
    private $user_api_key;
    private $db;

    function __construct()
    {
        $this->db = new DBConnector();
        
    }
    public function setMealName($meal_name)
    {
        $this->meal_name = $meal_name;
    }
    public function getMealName()
    {
        return $this->meal_name;
    }

    public function setMealUnits($meal_units)
    {
        $this->meal_units = $meal_units;
    }
    public function getMealUnits()
    {
        return $this->meal_units;
    }

    public function setUnitPrice($unit_price)
    {
        $this->unit_price = $unit_price;
    }
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getStatus()
    {
        return $this->status;
    }

    public function setUserApiKey($user_api_key)
    {
        $this->user_api_key = $user_api_key;
    }
    public function getUserApiKey()
    {
        return $this->user_api_key;
    }
    
    public function createOrder()
    {
        //save the incoming order
        $con = $this->db->DBConnect();
        $res = mysqli_query($con,"INSERT INTO orders(order_name,units,unit_price,order_status) VALUES('$this->meal_name','$this->meal_units','$this->unit_price','$this->status')");
     
    }
    public function checkOrderStatus($id)
    {
        $con = $this->db->DBConnect();
        $query = "SELECT order_status FROM orders WHERE order_id=?";
        $stmt = $con->prepare($query);

        $stmt->bind_param('i',$id);
        $stmt->execute();

        $order_status = $stmt->get_result()->fetch_assoc()['order_status'];
        return $order_status;

    }

    public function fetchAllOrders()
    {

    }

    public function checkApiKey()
    {
        //checks if the supplied api key is in db
        //if yes give true else false
        return true;
    }

    public function checkContentType()
    {

    }

}


?>