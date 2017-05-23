<?php
    //luu thong tin nguoi dung thong qua session
    session_start();
    require './services/authServices.php';
    if(isset($_POST['btnSubmitAuth'])){
        $username = trim($_POST['txtname']);
        $password = $_POST['txtpass'];
        //goi vao csdl de check dang nhap
        $isLogin = checkLogin($username,$password);
        //mo phong neu su dung cookie luu thong 
        //tin dang nhap cua nguoi dung 
        //thi se khong bao mat
        if($isLogin == true){
            //setcookie('memberCode','admin',time() + 5*60);
            $_SESSION["memberCode"] = $username;
            //la admin, thi tra ve trang quan ly
            require './index.php';
        }
       
        else{
            //tra ve trang thong bao khong co
            //quyen truy cap
            require './notFound.php';
        }
    }
?>