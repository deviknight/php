<?php
require_once("/xampp/htdocs/lab03/Entities/product.class.php");
require_once("/xampp/htdocs/lab03/Entities/category.class.php");


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
	}
	
	else{
		header("Location: add_product.php?inserted");
	}
}

?>

<?php include_once("header.php");?>
<?php
	if(isset($_GET["inserted"])){
		echo "<h2>Them san pham thanh cong</h2>";
	}
?>

<form method="post">
	<div class="row">
		<div class="lblTitle">
			<label>Ten san pham</label>
		</div>
		
		<div class="lblInput">
			<input type="text" name="txtName" value="<?php echo isset($_POST["txtName"]) ? $_POST["txtName"] : "" ;?>"/>
		</div>
	</div>
	
	<div class="row">
		<div class="lblTitle">
			<label>Mo ta san pham</label>
		</div>
		
		<div class="lblInput">
			<textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
		</div>
	</div>
		
	
	
	
	<div class="row">
		<div class="lblTitle">
			<label>So luong</label>
		</div>
		
		<div class="lblInput">
			<input type="number" name="txtQuantity" value="<?php echo isset($_POST["txtQuantity"]) ? $_POST["txtQuantity"] :"";?>"/>
		</div>
	</div>
	
	<div class="row">
		<div class="lblTitle">
			<label>Gia</label>
		</div>
		
		<div class="lblInput">
			<input type="number" name="txtPrice" value="<?php echo isset($_POST["txtPrice"]) ? $_POST["txtPrice"] :"";?>"/>
		</div>
	</div>
	<!-- loại sản phẩm -->
	<div class="row">
	<div class="lblTitle">
	<label>Chon loai san pham</label>
	</div>
	<div class="lblInput">
	<select name="txtCateID">
	<option value="" selected>--Chon loai--</option>
	<?php
	$cates= Category::list_category();
	foreach($cates as $item) {
		echo"<option value=".$item[CateID].">".$item["CategoryName"]."</option>";
	}
	?>
	</select>
	</div>
	</div>
	<div class="row">
		<div class="lblTitle">
			<label>Hinh anh</label>
		</div>
		
		<div class="lblInput">
			<input type="file" id="txtPicture" name="txtPicture" accept=".PNG,.GIF,.JPG">
		</div>
	</div>
	
	<div class="row">
		<div class="submit">
			<input type="submit" name="btnSubmit" value="Them san pham"/>
		</div>			
	</div>
</form>

<?php include_once("footer.php");?>