<?php
@ob_start();
session_start();
?>
  <?php
require_once('Entities/product.class.php');
require_once('Entities/category.class.php');
require_once('Entities/orderproduct.class.php');
require_once('Entities/orderdetail.class.php');


if(isset($_POST["btnPay"])){
    #$orderDate = $_POST["today"];
    #$shipDate = $_POST["today+1"];
    $shipName = $_POST["txtReceiver"];
    $shipAddress = $_POST["txtAddress"];
    
    
    
    $orderDate = date("d/m/Y");
    
    $today = date("d/m/Y");
    $shipDate = $today;
    #$shipDate = date_create($today);
    #$shipDate = date_modify($shipDate,"+3 days");
    #$shipDate = date_format($shipDate,"d/m/Y") ;
    
    $newOrderProduct = new OrderProduct($orderDate,$shipDate,$shipName,	$shipAddress);
    $result = $newOrderProduct->save();
    
    if(!$result){
        header("Location: payment.php?failure");
    }
    
    else{
        header("Location: payment.php?inserted");
    }
}


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


    <?php include_once("pageheader.php"); ?>
      <?php
if(isset($_SESSION['user'])!="")
{
    header("Location: index.php");
}
require_once("Entities/user.class.php");
?>

        <style>
          .input-hidden {
            position: absolute;
            left: -9999px;
          }
          
          input[type=radio]:checked + label>img {
            border: 1px solid #fff;
            box-shadow: 0 0 3px 3px #090;
          }
          /* Stuff after this is only to make things more pretty */
          
          input[type=radio] + label>img {
            #border: 1px dashed #444;
            width: 150px;
            height: 150px;
            transition: 500ms all;
          }
          
          input[type=radio]:checked + label>img {
            transform: rotateZ(-10deg) rotateX(10deg);
          }
          /*
| //lea.verou.me/css3patterns
| Because white bgs are boring.
*/
          
          html {
            background-color: #fff;
            background-size: 100% 1.2em;
            background-image: linear-gradient( 90deg, transparent 79px, #abced4 79px, #abced4 81px, transparent 81px), linear-gradient( #eee .1em, transparent .1em);
          }

          .text-center {
    text-align: right;
}
        </style>
        <!-- gallery -->
        <div class="gallery">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <h3>Địa chỉ giao hàng của quý khách</h3>

                <br/>
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                  <div class="form-group">                    
                    <label  class="col-sm-3 control-label">Ten người nhận</label>
                    <div class="col-sm-9">                    
                      <input type="text" class="form-control" name="txtReceiver" placeholder="Receiver">
                    </div>
                  </div>

                  <div class="form-group">
                    <label  class="col-sm-3 control-label">Địa chỉ giao hàng</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="txtAddress" placeholder="Address">
                    </div>
                  </div>

                  <div class="form-group">
                  <label class="col-sm-3 control-label">Số điện thoại</label>
                    <div class="col-sm-9">
                      
                      <input type="text" class="form-control" name="txtPhone" placeholder="Phone Number">
                    </div>
                  </div>
                  
                  <!--
                  <div class="form-group">
                    <div class="col-lg-12">
                      <label>Payment Method</label>
                      </br>
                      </br>
                      <div class="col-sm-6">

                        <input type="radio" name="emotion" id="happy" class="input-hidden" />
                        <label for="happy">
                          <img src="images/ship.png" alt="" /></br>
                          Cash
                        </label>
                      </div>
                      <div class="col-sm-6">
                        <input type="radio" name="emotion" id="sad" class="input-hidden" />
                        <label for="sad">
                          <img src="images/visa.png" alt="" /></br>
                          Credit
                        </label>
                      </div>


                    </div>
                  </div> -->

                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input"> Thông tin thanh toán khác địa chỉ giao hàng
                    </label>
                  </div>

                  </br>
                  <div class="form-group">
                   <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                      <input type="submit" name="btnPay" value="Thanh Toán" class="btn btn-success" />
                    </div>
                  </div>

                </form>
              </div>

              <div class="col-md-6">
              <form class="form-horizontal" method="post" enctype="multipart/form-data">
                <h3>Thông tin đơn hàng</h3>
                <br>
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>Tên sản phẩm</th>                      
                      <th>Số lượng</th>
                      <th>Đơn giá</th>
                      
                    </tr>
                  </thead>
                  <form  method="post" enctype="multipart/form-data">
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
        echo "<tr>
        <td>
        ".$prod["ProductName"]." </br>
        ".$prod["Description"]."</td>        
        <td>
        <input type=number required value='".$item["quantity"]."'/>
        </td>
        
        <td>".$prod["Price"]."</td>
        
        </tr>";
    }
    echo "<tr> <td colspan=5><p class='text-right text-danger'>Tổng tiền: ".$total_money."</p></td> </tr>";
    #echo "<tr> <td colspan=3><p class='text-right'><button type='button' class='btn btn-primary' onclick=location.href=/foodstore/index.php >Tiếp tục mua hàng</button></p></td>
    #<td colspan=2><p class='text-right'><button type='button' class='btn btn-success'>Thanh toán</button></p></td></tr>";
}
else{
    echo "Không có sản phẩm nào trong giỏ hàng!!!";
}
?>

                  </tbody>
                  </form>
                </table>
                </form>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
              </div>
            </div>
          </div>
        </div>
        <?php include_once("footer.php"); ?>