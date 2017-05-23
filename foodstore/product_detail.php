<?php
require_once("D:/xampp/htdocs/foodstore/Entities/product.class.php");
require_once("D:/xampp/htdocs/foodstore/Entities/category.class.php");
?>
<?php
include_once("pageheader.php");
if(!isset($_GET["id"])){
    header('Location: not_found.php');
}
else{
    $id=$_GET["id"];
    $prod = reset(Product::get_product($id));	
    $prods_relate = Product::list_product_relate($prod["CateID"], $id);
}
$cates = Category::list_category();
?>
<!-- gallery -->
	<div class="gallery">
	<div class="container">
		<h2 class="tittle-w3">Gallery</h2>
<div class="col-sm-12 panel panel-info">
<h3 class="panel-heading">Chi tiết sản phẩm</h3>
<div class="row">
	<div class="col-sm-6">
		<img  src="<?php echo "/foodstore/".$prod["Picture"];?>" class="img-responsive" style="width:100%" alt="Image">
	</div>
	
	<div class="col-sm-6">
		<div style="padding-left:10px">
			<h3 class="text-info">
				<?php echo $prod["ProductName"]; ?>
			</h3>
			<p>
				Giá: <?php echo $prod["Price"];?>
			</p>
			
			<p>
				Giá: <?php echo $prod["Description"];?>
			</p>
			
			<p>				
				<button type="button" class="btn btn-danger" onclick="location.href='/foodstore/shopping_cart.php?id=<?php echo
                $prod["ProductID"];?>'" >Mua Hàng</button>
			</p>
		</div>
	</div>
</div>
</div>
</div>
<?php include_once("footer.php"); ?>
