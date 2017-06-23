<?php

session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
require_once('Entities/product.class.php');
require_once('Entities/category.class.php');
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM product WHERE code='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["code"]=>array('ProductName'=>$productByCode[0]["ProductName"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'Price'=>$productByCode[0]["Price"]));
                
                if(!empty($_SESSION["cart_items"])) {
                    if(in_array($productByCode[0]["code"],$_SESSION["cart_items"])) {
                        foreach($_SESSION["cart_items"] as $k => $v) {
                            if($productByCode[0]["code"] == $k)
                            $_SESSION["cart_items"][$k]["quantity"] = $_POST["quantity"];
                    }
                } else {
                    $_SESSION["cart_items"] = array_merge($_SESSION["cart_items"],$itemArray);
                }
            } else {
                $_SESSION["cart_items"] = $itemArray;
            }
        }
        
        break;
}
}
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

  <?php
$session_items = 0;
if(!empty($_SESSION["cart_items"])){
    $session_items = count($_SESSION["cart_items"]);
}
?>
    <!-- gallery -->
    <div class="gallery">
      <!--test -->
        <!--<br> Total Items =-->
        <!--<?php echo $session_items; ?>-->

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
?>

</h3>
<form method="post" action="product_detail.php?id=<?php echo $id ?>&action=add&code=<?php echo $prod["code"]; ?>">
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

                  <input type="hidden" name="quantity" value="1" size="2" />
                  <input type="submit" value="CHỌN" class="btn btn-danger" />
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
          </form>
          <h3 class="panel-heading">Sản phẩm liên quan</h3>
          <div class="row">
            <?php
foreach($prods_relate as $item){
    ?>
              <form method="post" action="product_detail.php?id=<?php echo $item["ProductID"] ?>&action=add&code=<?php echo $prod["code"]; ?>">
              <div class="col-sm-4">
                <a href="product_detail.php?id=<?php echo $item["ProductID"]; ?>">
    <img  src="<?php echo "".$item["Picture"];?>" class="img-responsive" style="width:100%" alt="Image">
    </a>
                <p class="text-danger">
                  <?php echo $item["ProductName"]; ?>
                </p>
                <p class="text-info">
                  <?php echo $item["Price"]; ?>
                </p>

                <p>
                <input type="hidden" name="quantity" value="1" size="2" />
                  <input type="submit" value="CHỌN" class="btn btn-danger" />
    </p>
    </div>
    </form>
<?php }?>
<div class="clearfix "> </div>
</div>
</div>
</div>
</div>


<?php include_once("footer.php "); ?>