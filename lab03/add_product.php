<?php
require_once("/Entities/product.class.php");

if(isset($_POST["btnSubmit"])){
	$productName = $_POST["txtName"];
	$cateID = $_POST["txtCateID"];
	$price = $_POST["txtPrice"];
	$quantity = $_POST["txtQuantity"];
	$description = $_POST["txtDesc"];
	$picture = $_POST["txtPicture"];
	
	
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
			<input type="text" name="txtDesc" value="<?php echo isset($_POST["txtDesc"]) ? $_POST["txtDesc"] :"";?>"/>
		</div>
	</div>
		
	
	<div class="row">
		<div class="lblTitle">
			<label>Category</label>
		</div>
		
		<div class="lblInput">
			<input type="text" name="txtCateID" value="<?php echo isset($_POST["txtCateID"]) ? $_POST["txtCateID"] :"";?>"/>
		</div>
	</div>
	
	<div class="row">
		<div class="lblTitle">
			<label>So luong</label>
		</div>
		
		<div class="lblInput">
			<input type="text" name="txtQuantity" value="<?php echo isset($_POST["txtQuantity"]) ? $_POST["txtQuantity"] :"";?>"/>
		</div>
	</div>
	
	<div class="row">
		<div class="lblTitle">
			<label>Gia</label>
		</div>
		
		<div class="lblInput">
			<input type="text" name="txtPrice" value="<?php echo isset($_POST["txtPrice"]) ? $_POST["txtPrice"] :"";?>"/>
		</div>
	</div>
	
	<div class="row">
		<div class="lblTitle">
			<label>Hinh anh</label>
		</div>
		
		<div class="lblInput">
			<input type="text" name="txtPicture" value="<?php echo isset($_POST["txtPicture"]) ? $_POST["txtPicture"] :"";?>"/>
		</div>
	</div>
	
	<div class="row">
		<div class="submit">
			<input type="submit" name="btnSubmit" value="Them san pham"/>
		</div>			
	</div>
</form>

<?php include_once("footer.php");?>