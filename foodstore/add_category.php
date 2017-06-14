<?php
require_once('Entities/product.class.php');
require_once('Entities/category.class.php');


if(isset($_POST["btnSubmit"])){
	$catName = $_POST["txtName"];
	$description = $_POST["txtDesc"];
	$picture = $_FILES["txtPicture"];
	
	
	$newCategory = new Category($catName,$description,$picture);	
	$result = $newCategory->save();
	
	if(!$result){
		header("Location: add_category.php?failure");
	}
	
	else{
		header("Location: add_category.php?inserted");
	}
}

?>

<?php include_once("pageheader.php");?>
<?php
	if(isset($_GET["inserted"])){
		echo "<h2>Thêm sản phẩm thành công</h2>";
	}
?>

 <!-- gallery -->
    <div class="gallery">
<div class="container text-center">
  <h2>Thêm loại sản phẩm</h2>
<form  class="form-horizontal" method="post" enctype="multipart/form-data">
	<div class="form-group">		
			<label class="control-label col-sm-2">Loại sản phẩm</label>						
			 <div class="col-sm-10">
			<input class="form-control" required type="text" name="txtName" value="<?php echo isset($_POST["txtName"]) ? $_POST["txtName"] : "" ;?>"/>
			</div>
	</div>
	
	<div class="form-group">		
			<label class="control-label col-sm-2">Mô tả loại sản phẩm</label>				
		<div class="col-sm-10">
			<textarea  class="form-control" rows="5" name="txtDesc" required value="<?php echo isset($_POST["txtDesc"]) ? $_POST["txtDesc"] : "" ;?>"></textarea>			
		</div>
	</div>
								
	<div class="form-group">
			<label class="control-label col-sm-2 ">Hình</label>		
	
		<div class="col-sm-10">
			<span class="btn btn-default btn-file col-sm-12">	
			<input type="file" id="txtPicture" name="txtPicture" accept=".PNG,.GIF,.JPG">
			</span>			
		</div>
	</div>
	
	<div class="form-group">
		 <div class="col-sm-offset-2 col-sm-10">
			<input type="submit" name="btnSubmit" class="btn btn-warning" value="Thêm"/>
		</div>			
	</div>
</form>
</div>
</div>
<?php include_once("footer.php");?>