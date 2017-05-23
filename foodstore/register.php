<?php
@ob_start();
?>
<?php include_once("pageheader.php"); ?>
<?php
if(isset($_SESSION['user'])!="")
{
    header("Location: index.php");
}
require_once("/sun/xampp/htdocs/foodstore/Entities/user.class.php");
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
        <script>alert('có lỗi, kiểm tra lại!!!');</script>
        <?php
    }
    else{
        $_SESSION['user'] = $u_name;
        header("Location: index.php");
    }
}
?>
<!-- gallery -->
	<div class="gallery">
	<div class="container">
        <div class="container text-center">
  <h2>Register</h2>
  <br/>
<form  class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="txtname" class="col-sm-2 form-control-label">UserName</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="txtname" placeholder="User name">
        </div>
    </div>

    <div class="form-group">
        <label for="txtemail" class="col-sm-2 form-control-label">Email</label>
       <div class="col-sm-10">
            <input type="email" class="form-control" name="txtemail" placeholder="Email">
        </div>
    </div>

    <div class="form-group">
        <label for="txtpass" class="col-sm-2 form-control-label">Password</label>
       <div class="col-sm-10">
            <input type="password" class="form-control" name="txtpass" placeholder="Password">
        </div>
    </div>
    
     <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="btn-signup" value="Sign Up" class="btn btn-default" />
        </div>
    </div>

</form>
</div>
</div>
    </div>
    </div>
    <?php include_once("footer.php"); ?>