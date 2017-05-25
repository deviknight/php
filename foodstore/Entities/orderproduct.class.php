<?php
require_once('config/db.class.php');
require_once('product.class.php');
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
        $con=mysqli_connect("localhost","root","","ecommerce");
        
        $sql = "INSERT INTO orderproduct (OrderDate, ShipDate, ShipName, ShipAddress) VALUES ('".mysqli_real_escape_string($db->connect(),
        $this->orderDate). "','".mysqli_real_escape_string($db->connect(),$this->shipDate)."','".mysqli_real_escape_string($db->connect(),$this->shipName)."','".mysqli_real_escape_string($db->connect(),$this->shipAddress)."')";
        #$result = $db->query_execute($sql);
        mysqli_query($con,$sql);
                        
        $orderID = mysqli_insert_id($con);
            
            echo "ketqua:" + $orderID;
            
            if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"])>0)
            {
                foreach($_SESSION["cart_items"] as $item){
                    $id = $item["pro_id"];                    
                    $total_money +=$item["quantity"]*$prod["Price"];
                    $quantiy = $item["quantity"];                    
                    $sql1 = "INSERT INTO orderdetail (OrderID,ProductID,Quantity) VALUES ('".$orderID."','".$id."', '".$quantiy."')";
					 $result1 = $db->query_execute($sql1);

                    
                                                            
                }
                
            }       
        return $result1;
    }
    
}
?>