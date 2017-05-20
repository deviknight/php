<?php
require_once("/xampp/htdocs/lab05/Entities/product.class.php");
require_once("/xampp/htdocs/lab05/Entities/category.class.php");


if(isset($_POST["btnSubmit"])){
	$productName = $_POST["txtName"];
	$cateID = $_POST["txtCateID"];
	$price = $_POST["txtPrice"];
	$quantity = $_POST["txtQuantity"];
	$description = $_POST["txtDesc"];
	$picture = $_FILES["txtPicture"];
	
	
	$newProduct = new Product($productName,$cateID,$price,$quantity,$description,$picture);	
	$result = $newProduct->save();
	
	if(!$result){
		header("Location: add_product.php?failure");
		echo $productName;
		echo $cateID;
		echo $price;
		echo $quantity;
		echo $description;
		echo $picture;
	}
	
	else{
		header("Location: add_product.php?inserted");
	}
}

?>

<?php include_once("header.php");?>
<?php
	if(isset($_GET["inserted"])){
		echo "<h2>Thêm sản phẩm thành công</h2>";
	}
?>
<div class="container text-center">
  <h2>Thêm sản phẩm</h2>
<form  class="form-horizontal" method="post" enctype="multipart/form-data">
	<div class="form-group">		
			<label class="control-label col-sm-2">Tên sản phẩm</label>						
			 <div class="col-sm-10">
			<input class="form-control" type="text" name="txtName" value="<?php echo isset($_POST["txtName"]) ? $_POST["txtName"] : "" ;?>"/>
			</div>
	</div>
	
	<div class="form-group">		
			<label class="control-label col-sm-2">Mô tả sản phẩm</label>				
		<div class="col-sm-10">
			<textarea  class="form-control" rows="5" name="txtDesc" value="<?php echo isset($_POST["txtDesc"]) ? $_POST["txtDesc"] : "" ;?>"></textarea>			
		</div>
	</div>
					
	<div class="form-group">		
			<label class="control-label col-sm-2">Số lượng</label>		
		
		<div class="col-sm-10">
			<input class="form-control" type="number" name="txtQuantity" value="<?php echo isset($_POST["txtQuantity"]) ? $_POST["txtQuantity"] :"";?>"/>
		</div>
	</div>
	
	<div class="form-group">
		
			<label class="control-label col-sm-2">Giá</label>
		
		
		<div class="col-sm-10">
			<input class="form-control" type="number" name="txtPrice" value="<?php echo isset($_POST["txtPrice"]) ? $_POST["txtPrice"] :"";?>"/>
		</div>
	</div>
	<!-- loại sản phẩm -->
	<div class="form-group">	
	<label class="control-label col-sm-2">Chọn loại sản phẩm</label>	
	<div class="col-sm-10">	
	<select name="txtCateID" class="form-control" >
	<option value="" selected>--Chọn loại--</option>
	<?php
	$cates= Category::list_category();
	foreach($cates as $item) {
		echo "<option value=".$item["CateID"].">".$item["CategoryName"]."</option>";
	}
	?>
	</select>
	</div>
	</div>
	<div class="form-group">
			<label class="control-label col-sm-2">Hình</label>		
		
		<div class="col-sm-10">
			<input type="file" id="txtPicture" name="txtPicture" accept=".PNG,.GIF,.JPG">			
		</div>
	</div>
	
	<div class="form-group">
		 <div class="col-sm-offset-2 col-sm-10">
			<input type="submit" name="btnSubmit" class="btn btn-default" value="Thêm sản phẩm"/>
		</div>			
	</div>
</form>
</div>
<?php include_once("footer.php");?>