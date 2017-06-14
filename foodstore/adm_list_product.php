<?php

require_once('Entities/product.class.php');
require_once('Entities/category.class.php');

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
        <table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Price</th>
      <th>Image</th>
      <th>Quantity</th>
      <th>Update</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
   <?php foreach($prods as $item){?>
    <tr>    
      <th scope="row">1</th>
      <td><?php echo $item["ProductName"];?></td>
      <td><?php echo $item["Price"];?></td>
      <td><img src="<?php echo " ".$item["Picture"];?>" alt="" width=20% height=20%></td>
      <td><?php echo $item["Quantity"];?></td>
      <td> <button type="button" class="btn btn-danger" onclick="location.href='adm_update_product.php?id=<?php echo
    
    $item["ProductID"];?>'">Update</button></td>
      <td><span class="glyphicon glyphicon-remove"></td>
    </tr>
     <?php } ?>
  </tbody>
</table>
      </div>
    </div>


    <?php	include_once("footer.php");?>