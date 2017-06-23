<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
require_once('Entities/product.class.php');
require_once('Entities/category.class.php');
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "remove":
            if(!empty($_SESSION["cart_items"])) {
                foreach($_SESSION["cart_items"] as $k => $v) {
                    if($_GET["code"] == $k)
                    unset($_SESSION["cart_items"][$k]);
                    if(empty($_SESSION["cart_items"]))
                    unset($_SESSION["cart_items"]);
            }
        }
        break;
    case "empty":
        unset($_SESSION["cart_items"]);
        break;
    case "edit":
        $total_price = 0;
        foreach ($_SESSION['cart_items'] as $k => $v) {
            if($_POST["code"] == $k) {
                if($_POST["quantity"] == '0') {
                    unset($_SESSION["cart_items"][$k]);
            } else {
                $_SESSION['cart_items'][$k]["quantity"] = $_POST["quantity"];
            }
        }
        $total_price += $_SESSION['cart_items'][$k]["Price"] * $_SESSION['cart_items'][$k]["quantity"];
        
    }
    if($total_price!=0 && is_numeric($total_price)) {
        print "$" . number_format($total_price,2);
        exit;
    }
    break;
}
}
?>
  <?php include('pageheader.php');?>

    <!-- gallery -->
    <div class="gallery">
      <!--Thong tin tang shopping cart-->
      <div class="container text-center">
        <!-- need to add header menu-->

        <div class="col-sm-12">
          <h3>Thông tin giỏ hàng</h3>
          <br>
          <form name="frmCartEdit" id="frmCartEdit">
            <table class="table table-condensed" id="table">
              <thead>
                <tr>
                  <th>Tên sản phẩm</th>
                  <th>Hình ảnh</th>
                  <th>Số lượng</th>
                  <th>Đơn giá</th>
                  <!--<th>Thành tiền</th>-->
                  <th>Xóa</th>
                </tr>
              </thead>
              <tbody style="text-align:left">
                <?php
$total_price = 0.00;
if(isset($_SESSION["cart_items"])){
    ?>
                  <?php foreach ($_SESSION["cart_items"] as $item) {
        $product_info = $db_handle->runQuery("SELECT * FROM product WHERE code = '" . $item["code"] . "'");
        $total_price += $item["Price"] * $item["quantity"];
        
        ?>
                    <div class="product-item" onMouseOver="document.getElementById('remove<?php echo $item["code"]; ?>').style.display='block';" onMouseOut="document.getElementById('remove<?php echo $item["code"]; ?>').style.display='';">
                    </div>
                    <tr>
                      <td>
                        <?php echo $item["ProductName"]; ?>
                      </td>
                      <td><img style='width:90px; height:80px' src="<?php echo $product_info[0]["Picture"]; ?>"></td>
                      <td>
                        <input type="number" min="1" step="1" name="quantity" id="<?php echo $item["code"]; ?>" value="<?php echo $item["quantity"]; ?>" size="2" onBlur="saveCart(this);" />
                      </td>
                      <td>
                        <?php echo "$".$item["Price"]; ?>
                      </td>
                      <!--<td>
        <p id="total_price_item">
        <?php
        $current_price = $item["Price"];
        echo $current_price * $item["quantity"]?>
        </p>
        </td>-->
                      <td>
                        <div class="btnRemoveAction" id="remove<?php echo $item["code"]; ?>"><a href="shopping_cart.php?action=remove&code=<?php echo $item["code"]; ?>" title="Remove from Cart">x</a></div>
                      </td>
                    </tr>
                    <?php
    }
}
?>
                      <tr>
                        <td colspan=6>
                          <p id="total_price" class='text-right text-danger'>
                            <?php echo "$". number_format($total_price,2); ?>
                          </p>
                        </td>
                      </tr>
                      <tr>
                        <td colspan=3>
                          <p class="text-right">
                            <button type="button" class="btn btn-primary" onclick="location.href='list_product.php';">Tiếp tục mua hàng</button>
                          </p>
                        </td>
                        <td colspan=3>
                          <p class='text-right'>
                            <button type='button' class='btn btn-success' onclick="location.href='payment.php';" name="btnAddToCart">Thanh toán</button>
                          </p>
                        </td>
                        <!-- https://www.codecademy.com/en/forum_questions/5314dc879c4e9d517a000d6d -->

                      </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
    <?php include_once('footer.php');?>

      <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
      <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
      <script>
        function saveCart(obj) {
          var quantity = $(obj).val();
          var code = $(obj).attr("id");
          $.ajax({
            url: "?action=edit",
            type: "POST",
            data: 'code=' + code + '&quantity=' + quantity,
            success: function(data, status) {
              $("#total_price").html(data)
              $("#total_price_item").html(data)
            },
            error: function() {
              alert("Problem in sending reply!")
            }
          });
        }

        // just for the demos, avoids form submit
        jQuery.validator.setDefaults({
          debug: true,
          success: "valid"
        });
        $("#frmCartEdit").validate({
          rules: {
            field: {
              required: true,
              digits: true
            }
          }
        });
      </script>