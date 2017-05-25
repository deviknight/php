<?php
require_once('config/db.class.php');
class OrderDetail
{
    public $orderID;
    public $productID;
    public $quantiy;

    public function __construct($orderID, $productID, $quantiy){
        $this->orderID = $orderID;
        $this->productID = $productID;
        $this->quantiy = $quantiy;
    }
    public function save(){
        
    }
    
}
?>