<?php
@ob_start();
?>
  <?php include_once("pageheader.php"); ?>
    <?php
if(isset($_SESSION['user'])!="")
{
    header("Location: index.php");
}
require_once("Entities/user.class.php");
if(isset($_POST['btn-signup']))
{
    $u_name = $_POST['txtname'];
    $u_email = $_POST['txtemail'];
    $u_pass = $_POST['txtpass'];
    $account = new User($u_name, $u_email, $u_pass);
    $result = $account->save();
    if(!$result)
    {
        ?>
      <script>
        alert('có lỗi, kiểm tra lại!!!');
      </script>
      <?php
    }
    else{
        $_SESSION['user'] = $u_name;
        header("Location: login.php");
    }
}
?>
        <style>
          .big-btn-b {
            backface-visibility: hidden;
            background: #1286bc;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            color: #fff;
            display: inline-block;
            font-size: 16px;
            font-weight: 500;
            moz-border-radius: 2px;
            moz-osx-font-smoothing: grayscale;
            padding: 10px 30px;
            position: relative;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            transform: translateZ(0);
            transition-duration: .5s;
            transition-property: color;
            vertical-align: middle;
            webkit-backface-visibility: hidden;
            webkit-border-radius: 2px;
            webkit-transform: translateZ(0);
            webkit-transition-duration: .5s;
            webkit-transition-property: color;
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
                        <h1 class="atc-headline">Đăng ký thành viên</h1>

                        <br/>

                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                          <div class="form-group">

                            <div class="col-lg-12">
                              <input type="text" class="form-control" name="txtname" placeholder="User name" required>
                            </div>
                          </div>

                          <div class="form-group">

                            <div class="col-lg-12">
                              <input type="email" class="form-control" name="txtemail" placeholder="Email" required>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-lg-12">
                              <input type="password" class="form-control" name="txtpass" placeholder="Password" required id="password">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-lg-12">
                              <input type="password" class="form-control" name="txtconfirmpass" placeholder="Confirm Password" required id="confirm_password">
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="col-lg-12">
                              <input type="submit" name="btn-signup" value="Sign Up" class="big-btn-b" />
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
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>

        </div>    
        <?php include_once("footer.php"); ?>