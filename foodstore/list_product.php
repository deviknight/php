<?php

require_once("D:/xampp/htdocs/foodstore/Entities/product.class.php");
require_once("D:/xampp/htdocs/foodstore/Entities/category.class.php");

?>
  <?php
include_once("pageheader.php");
if(!isset($_GET["cateid"])){
    $prods = Product::list_product();
}
else{
    $cateid = $_GET["cateid"];
    $prods = Product::list_product_by_cateid($cateid);
}
$cates = Category::list_category();
?>
<!-- gallery -->
	<div class="gallery">
	<div class="container">
		<h2 class="tittle-w3">Gallery</h2>
						<div class="gallery-grids">
            <?php foreach($prods as $item){?>
					<div class="col-md-4 gallery-grid wow fadeInUp animated" data-wow-delay=".5s">
						<div class="grid">
							<figure class="effect-apollo">
								<?php
										echo "<a class=example-image-link href=/foodstore/product_detail.php?id=".$item["ProductID"]." data-lightbox=example-set data-title=>";										
								?>
								<!-- <a class="example-image-link" href="google.com" data-lightbox="example-set" data-title=""> -->
								
                   <img src="<?php echo "".$item["Picture"];?>" alt="">									 
                  <!-- <img src="images/g9.jpg" alt="" /> -->
									<figcaption>										
                    <?php echo "<h3> ".$item["ProductName"]."</h3>";
										?>										
                    <?php echo $item["Price"];?>                    
									</figcaption>										
								</a>
								
							</figure>
							<button type="button" class="btn btn-primary" onclick="location.href='/foodstore/shopping_cart.php?id=<?php echo

                $item["ProductID"];?>'">Mua Hàng</button>

						</div>
					</div>
          <?php } ?>                
    										
					<div class="clearfix"> </div>
				</div>
					</div>
				</div>
<!-- //gallery -->
<?php	include_once("footer.php");?>