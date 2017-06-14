<?php //IDEA:
require_once('config/db.class.php');

class Category
{
    public $CateID;
    public $categoryName;
    public $description;
    public $picture;
    public function __construct($cate_name, $desc,$picture)
    {
        $this->categoryName = $cate_name;
        $this->description = $desc;
        $this->picture=$picture;
    }
    public static function list_category(){
        $db = new Db();
        $sql = "SELECT * FROM category";
        $result = $db->select_to_array($sql);
        return $result;
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
		// them category vao co so du lieu
		$sql = "insert into category(CategoryName,Description,Picture) values ('$this->categoryName','$this->description','$filepath')";
		$result = $db->query_execute($sql);
		return $result;
	}       
}
?>