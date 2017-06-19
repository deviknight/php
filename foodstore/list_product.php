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
if(!isset($_GET["cateid"])){
    #$prods = Product::list_product();
    $product_array = Product::list_product();
}
else{
    $cateid = $_GET["cateid"];
    #$prods = Product::list_product_by_cateid($cateid);
    $product_array = Product::list_product_by_cateid($cateid);
}
$cates = Category::list_category();
?>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <!-- gallery -->
    <?php
$session_items = 0;
if(!empty($_SESSION["cart_items"])){
    $session_items = count($_SESSION["cart_items"]);
}
?>

      <div class="gallery">        
        <!--<br> Total Items =
        <?php echo $session_items; ?>-->
          <div class="container">
            <h2 class="tittle-w3">Gallery</h2>
            <div class="gallery-grids">

              <?php
#$product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY id ASC");
#$product_array = Product::list_product();
if (!empty($product_array)) {
    foreach($product_array as $key=>$value){
        ?>
                <div class="col-md-4 gallery-grid wow fadeInUp animated" data-wow-delay=".5s">
                  <form method="post" action="list_product.php?cateid=<?php echo $cateid ?>&action=add&code=<?php echo $product_array[$key]["code"]; ?>" >
                    <div class="grid">
                      <figure class="effect-apollo">

                        <?php
        echo "<a class=example-image-link href=product_detail.php?id=".$product_array[$key]["ProductID"]." data-lightbox=example-set data-title=>";
        ?>
                          <img src="<?php echo " ".$product_array[$key]["Picture"];?>" alt="">
                          <figcaption>
                            <?php echo "<h3> ".$product_array[$key]["ProductName"]."</h3>";?>
                              <?php echo $product_array[$key]["Price"];?>
                          </figcaption>
                          </a>
                      </figure>
                      <input type="hidden" name="quantity" value="1" size="2" />
                      <input type="submit" value="Chọn" class="btn btn-danger" />
                    </div>
                  </form>
                </div>
                <?php
    }
}
?>
                  <div class="clearfix"> </div>
            </div>
          </div>
      </div>


      <?php	include_once("footer.php");?>