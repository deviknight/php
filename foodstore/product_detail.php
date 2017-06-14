<?php
require_once('Entities/product.class.php');
require_once('Entities/category.class.php');
?>
  <?php
include_once("pageheader.php");
if(!isset($_GET["id"])){
    header('Location: not_found.php');
}
else{
    $id=$_GET["id"];
    $values = Product::get_product($id);
    $prod = reset($values);
    $prods_relate = Product::list_product_relate($prod["CateID"], $id);
    
}
$cates = Category::list_category();
?>
    <!-- gallery -->
    <div class="gallery">
      <!--test -->


      <!-- end test -->

      <div class="container">
        <h2 class="tittle-w3">Gallery</h2>
        <div class="col-lg-12 panel panel-warning ">
          <h3 class="panel-heading"><?php
$cateID = $prod["CateID"];
foreach ( $cates as $category ) {
    if($category["CateID"] == $cateID){
        echo $category["CategoryName"];
    }
}
?></h3>
          <div class="row">
            <div class="col-sm-6">
              <img src="<?php echo " ".$prod["Picture"];?>" class="img-responsive" style="width:100%" alt="Image">
            </div>

            <div class="col-sm-6">
              <div style="padding-left:10px">
                <h3 class="text-info">
<?php echo $prod["ProductName"]; ?>
</h3>
                <p>
                  Giá:
                  <?php echo $prod["Price"];?>
                </p>

                <p>
                  Giá:
                  <?php echo $prod["Description"];?>
                </p>

                <p>
                  <button type="button" class="btn btn-danger" onclick="location.href='shopping_cart.php?id=<?php echo
$prod["ProductID"];?>'">CHỌN</button>
                </p>


                <div class="agileits-social">

                  <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                    <li><a href="#"><i class="fa fa-vk"></i></a></li>
                  </ul>
                </div>


              </div>

            </div>

          </div>

          <h3 class="panel-heading">Sản phẩm liên quan</h3>
          <div class="row">
            <?php
foreach($prods_relate as $item){
    ?>
              <div class="col-sm-4">
                <a href="/foodstore/product_detail.php?id=<?php echo $item["ProductID"]; ?>">
    <img  src="<?php echo "".$item["Picture"];?>" class="img-responsive" style="width:100%" alt="Image">
    </a>
                <p class="text-danger">
                  <?php echo $item["ProductName"]; ?>
                </p>
                <p class="text-info">
                  <?php echo $item["Price"]; ?>
                </p>

                <p>
                  <button type="button" " class="btn btn-primary ">Mua hàng</p>
    </p>
    </div>
<?php }?>
<div class="clearfix "> </div>
</div>
</div>
</div>
</div>


<?php include_once("footer.php "); ?>