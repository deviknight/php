<?php
@ob_start();
session_start();
?>
  <?php
require_once('Entities/product.class.php');
require_once('Entities/category.class.php');
require_once('Entities/orderproduct.class.php');


if(isset($_POST["btnPay"])){
    #$orderDate = $_POST["today"];
    #$shipDate = $_POST["today+1"];
    $shipName = $_POST["txtReceiver"];
    $shipAddress = $_POST["txtAddress"];
    
    
    
    $orderDate = date("d/m/Y");
    
    $today = date("d/m/Y");
    $shipDate = date_create($today);
    $shipDate = date_modify($shipDate,"+3 days");
    $shipDate = date_format($shipDate,"d/m/Y") ;
    
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
        </style>
        <!-- gallery -->
        <div class="gallery">
          <div class="container">
            <div class="col-lg-12">
                                   <div class="col-sm-6">
                                   
                        <h3>Thông tin giỏ hàng</h3>
                        <br>
                        <table class="table table-condensed">
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
        echo "<tr>
        <td>".$prod["ProductName"]."</td><td><img style='width:90px; height:80px' src=".$prod["Picture"]."
        </td>
        <td>
        <input type=number required value='".$item["quantity"]."'/>
        </td>
        
        <td>".$prod["Price"]."</td><td>".$prod["Price"]."</td>
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
                              <tr>
                                <td colspan=3>
                                  <p class="text-right">
                                    <button type="button" class="btn btn-primary" onclick="location.href='list_product.php';">Tiếp tục mua hàng</button>
                                  </p>
                                </td>
                                <td colspan=2>
                                  <p class='text-right'>
                                    <button type='button' class='btn btn-success' onclick="location.href='payment.php';" name="btnAddToCart">Thanh toán</button>
                                  </p>
                                </td>
                                <!-- https://www.codecademy.com/en/forum_questions/5314dc879c4e9d517a000d6d -->
                              </tr>
                          </tbody>
                        </table>
                      </div>

                      <div class="col-sm-6">
                      <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <h2>Review Order</h2>

                        <br/>

                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                          <div class="form-group">

                            <div class="col-lg-12">
                              <input type="text" class="form-control" name="txtReceiver" placeholder="Receiver">
                            </div>
                          </div>

                          <div class="form-group">

                            <div class="col-lg-12">
                              <input type="text" class="form-control" name="txtAddress" placeholder="Address">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-lg-12">
                              <input type="text" class="form-control" name="txtPhone" placeholder="Phone Number">
                            </div>
                          </div>


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
                          </div>

                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input"> I agreed with above information
                            </label>
                          </div>

                          </br>
                          <div class="form-group">
                            <div class="col-lg-12">
                              <input type="submit" name="btnPay" value="Submit Order" class="btn btn-success" />
                            </div>
                          </div>

                        </form>

                      </div>
 
                    </div>


                  </div>
                </div>
                      </div>


            </div>
           <!-- <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-lg-12">
                        <h2>Review Order</h2>

                        <br/>

                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                          <div class="form-group">

                            <div class="col-lg-12">
                              <input type="text" class="form-control" name="txtReceiver" placeholder="Receiver">
                            </div>
                          </div>

                          <div class="form-group">

                            <div class="col-lg-12">
                              <input type="text" class="form-control" name="txtAddress" placeholder="Address">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-lg-12">
                              <input type="text" class="form-control" name="txtPhone" placeholder="Phone Number">
                            </div>
                          </div>


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
                          </div>

                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input"> I agreed with above information
                            </label>
                          </div>

                          </br>
                          <div class="form-group">
                            <div class="col-lg-12">
                              <input type="submit" name="btnPay" value="Submit Order" class="btn btn-success" />
                            </div>
                          </div>

                        </form>

                      </div>
 
                    </div>


                  </div>
                </div>
              </div>
            </div> -->
          </div>


        </div>
        <?php include_once("footer.php"); ?>