<?php

require_once('config/db.class.php');

require_once('config/db.class.php');


class Product
{
	public $productID;
	public $productName;
	public $cateID;
	public $price;
	public $quantity;
	public $description;
	public $picture;
	
	public function __construct($pro_name,$cate_id,$price,$quantity,$description,$picture){
		$this->productName = $pro_name;
		$this->cateID = $cate_id;
		$this->price = $price;
		$this->quantity = $quantity;
		$this->description = $description;
		$this->picture = $picture;
	}
	
	//luu san pham
	public function save(){
		//xu ly upload
		$file_temp=$this->picture['tmp_name'];
		$user_file = $this->picture['name'];
		$timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
		$filepath = "uploads/".$timestamp.$user_file;
		if(move_uploaded_file($file_temp, $filepath)==false)
		{
			return false;
		}
		$db = new Db();
		// them product vao co so du lieu
		$sql = "insert into product(ProductName,CateID,Price,Quantity,Description,Picture) values ('$this->productName','$this->cateID','$this->price','$this->quantity','$this->description','$filepath')";
		$result = $db->query_execute($sql);
		return $result;
	}

	// lấy danh sách sản phẩm
	public static function list_product(){
		$db = new Db();
		$sql = "select * from product";
		$result = $db->select_to_array($sql);
		return $result;
	}
	public static function list_product_by_cateid($cateid){
			$db = new Db();
			$sql = "select * from product where CateID='$cateid'";
			$result = $db->select_to_array($sql);
			return $result;
	}
	public static function list_product_relate($cateid, $id){
		$db = new Db();
		$sql = "select * from product where CateID='$cateid' and productID!='$id'";
		$result = $db->select_to_array($sql);
		return $result;
	}
	public static function get_product($id){
		$db = new Db();
		$sql="select * from product where productID='$id'";
		$result = $db->select_to_array($sql);
		return $result;
	}
}

?>