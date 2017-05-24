<?php
@ob_start();
?>
  <?php include_once("pageheader.php"); ?>
      <!-- gallery -->
      <div class="gallery">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <h2>Login</h2>

                      <br/>

                      <form class="form-horizontal" method="post" action="./auth.php" enctype="multipart/form-data">                        
                                                
                        <div class="form-group">
                          <div class="col-lg-12">
                            <input type="text" class="form-control" name="txtname" placeholder="User name">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-12">
                            <input type="password" class="form-control" name="txtpass" placeholder="Password">
                          </div>
                        </div>


                        <div class="form-group">
                          <div class="col-lg-12">
                            <input type="submit" name="btnSubmitAuth" value="Login" class="btn btn-success" />
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