<?php
require_once('config/db.class.php');
class OrderProduct
{
    public $orderID;
    public $orderDate;
    public $shipDate;
    public $shipName;
    public $shipAddress;
    public function __construct($order_date, $ship_date, $ship_name,$ship_address){
        $this->orderDate = $order_date;
        $this->shipDate = $ship_date;
        $this->shipName = $ship_name;
        $this->shipAddress = $ship_address;
    }
    public function save(){
        $db = new Db();
        $sql = "INSERT INTO orderproduct (OrderDate, ShipDate, ShipName, ShipAddress) VALUES ('".mysqli_real_escape_string($db->connect(),
        $this->orderDate). "','".mysqli_real_escape_string($db->connect(),$this->shipDate)."','".mysqli_real_escape_string($db->connect(),$this->shipName)."','".mysqli_real_escape_string($db->connect(),$this->shipAddress)."')";
        $result = $db->query_execute($sql);
        return $result;
    }
    
}
?>