
<?php
@ob_start();
session_start();
?>
<?php include('pageheader.php');?>
  <?php
require_once("Entities/product.class.php");
require_once("Entities/category.class.php");
$cates = Category::list_category();

#session_start();


error_reporting(E_ALL);

ini_set('display_errors','1');

if(isset($_GET["id"])){
    $pro_id = $_GET["id"];
    $was_found = false;
    $i = 0;
    if(!isset($_SESSION["cart_items"]) || count($_SESSION["cart_items"])<1){

        $_SESSION["cart_items"] = array(0=> array("pro_id" => $pro_id,"quantity"=>1));

    }
    else{
        foreach($_SESSION["cart_items"] as $item){
            $i++;
            while(list($key,$value)=each($item)){
                if($key=="pro_id" && $value==$pro_id)
                {
                    array_splice($_SESSION["cart_items"], $i-1,1, array(array("pro_id"=>$pro_id, "quantity"=>
                    $item["quantity"]+1)));
                    $was_found = true;
                }
            }
        }
        if($was_found==false){
            array_push($_SESSION["cart_items"], array("pro_id"=>$pro_id, "quantity"=>1));
        }
    }
    header("location: shopping_cart.php");
}
?>

<!-- gallery -->
	<div class="gallery">	
 <!--Thong tin tang shopping cart-->
<div class="container text-center">
    <!-- need to add header menu-->

    <div class="col-sm-12">
        <h3>Thông tin giỏ hàng</h3><br>
        <table class="table table-condensed" id="table" >
            <thead>
                <tr>
                <th>Tên sản phẩm</th>
                  <th>Hình ảnh</th>
                    <th>Số lượng</th>
                      <th>Đơn giá</th>
                        <th>Thành tiền</th>
                </tr>
            </thead>
              <tbody style="text-align:left">
        <?php
        $total_money = 0;
        if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"])>0)
        {
            foreach($_SESSION["cart_items"] as $item){
                $id = $item["pro_id"];
                $product = Product::get_product($id);
                $prod = reset($product);
                $total_money +=$item["quantity"]*$prod["Price"];
                $thanhtien = $item["quantity"]*$prod["Price"];
                echo "<tr>
                <td>".$prod["ProductName"]."</td><td><img style='width:90px; height:80px' src=".$prod["Picture"]."
                </td>                
                <td>
                <input type=number data-id=.$id. id=quantity required value='".$item["quantity"]."'/>
                </td>
                
                <td><span id=price>".$prod["Price"]."</span></td>
                 <td>
                 <span id=total_price>".$thanhtien."</span>
                 
                 </td>
                </tr>";
                }
                 echo "<tr> <td colspan=5><p class='text-right text-danger' id=total_money >Tổng tiền: ".$total_money."</p></td> </tr>";
                  #echo "<tr> <td colspan=3><p class='text-right'><button type='button' class='btn btn-primary' onclick=location.href=/foodstore/index.php >Tiếp tục mua hàng</button></p></td>
                  #<td colspan=2><p class='text-right'><button type='button' class='btn btn-success'>Thanh toán</button></p></td></tr>";
                 
                }
                else{
                    echo "Không có sản phẩm nào trong giỏ hàng!!!";
                }
                ?>
                <tr> 
                    <td colspan=3><p class="text-right"><button type="button" class="btn btn-primary" onclick="location.href='list_product.php';">Tiếp tục mua hàng</button></p></td>
                    <td colspan=2><p class='text-right'><button type='button' class='btn btn-success'  onclick="location.href='payment.php';"  name="btnAddToCart">Thanh toán</button></p></td>                   
                    <!-- https://www.codecademy.com/en/forum_questions/5314dc879c4e9d517a000d6d -->
                    
                </tr>
        </tbody>        
          </table>          
    </div>
    </div>
</div>
    <?php include_once('footer.php');?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script> 
            // var myTable = document.getElementById('table');
            // var rowLength = table.rows.length;

            // for(var i=0; i<rowLength; i+=1){
            //     var row = table.rows[i];
                  
            // }

             $("#quantity").on("change",function(){
             quantity=$(this).val();
             var price = $('#price').text();
             total_price=price*quantity;
            $("#total_price").html(total_price);
              
            })
            // $("#table > tr > td").change(function() {
            //         console.log("inside change event");
            // });
    </script>