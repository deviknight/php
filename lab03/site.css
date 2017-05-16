<?php
require_once("/config/db.class.php");

class Product
{
	public $productID;
	public $productName;
	public $cateID;
	public $price;
	public $quantity;
	public $description;
	public $picture;
	
	public function __construct($pro_name,$cate_id,$price,$quantity,$desc,$picture){
		$this->productName = $pro_name;
		$this->cateID = $cate_id;
		$this->price = $price;
		$this->quantity = $quantity;
		$this->description = $description;
		$this->picture = $picture;
	}
	
	//luu san pham
	public function save(){
		$db = new Db();
		// them product vao co so du lieu
		$sql = "insert into product(ProductName,CateID,Price,Quantity,Description,Picture) values ('$this->productName','$this->CateID','$this->price','$this->quantity,'$this->description'','$this->picture')";
		
		$result = $db->query_execute($sql):
		return $result;
	}
}

?>