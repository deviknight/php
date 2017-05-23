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
        <!-- gallery -->
        <div class="gallery">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
              <div class="panel panel-default">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <h2>Register</h2>

                      <br/>

                      <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="form-group">

                          <div class="col-lg-12">
                            <input type="text" class="form-control" name="txtname" placeholder="User name">
                          </div>
                        </div>

                        <div class="form-group">

                          <div class="col-lg-12">
                            <input type="email" class="form-control" name="txtemail" placeholder="Email">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-12">
                            <input type="password" class="form-control" name="txtpass" placeholder="Password">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-12">
                            <input type="password" class="form-control" name="txtconfirmpass" placeholder="Confirm Password">
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="col-lg-12">
                            <input type="submit" name="btn-signup" value="Sign Up" class="btn btn-success" />
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