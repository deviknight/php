<?php
@ob_start();
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
	
  $orderDate = date_default_timezone_get();
  $shipDate = date_default_timezone_get();
	
	$newOrderProduct = new OrderProduct($orderDate,$shipDate,$shipName,	$shipAddress);	
	$result = $newOrderProduct->save();
	
	if(!$result){
		header("Location: payment.php?failure");		
	}
	
	else{
		header("Location: payment.php?inserted");
	}
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
          <div class="row">
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
          </div>
        </div>


      </div>
      <?php include_once("footer.php"); ?>