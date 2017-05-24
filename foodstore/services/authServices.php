<?php
require_once("config/db.class.php");
    function checkLogin($username, $password){        
        $password = md5($password);
        $db = new Db();
        $sql = "SELECT * FROM users where UserName='$username' AND Password = '$password'";
        $result = $db->query_execute($sql);
        if($result -> num_rows > 0){
            return true;
        }
        return false;
        #return $result;
        //vao csdl de check
        #if($username=='admin' && $password =='admin'){
        #    return true;
        #}
        #if($username=='user' && $password =='user'){
            ##return true;
        #}
        #return false;
    }
?>