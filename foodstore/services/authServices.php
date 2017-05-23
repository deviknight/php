<?php
require_once("config/db.class.php");
    function checkLogin($username, $password){        
        #$password = md5($password);
        $db = new Db();
        $sql = "SELECT * FROM users where UserName='$username' AND Password = '$password'";
        $result = $db->query_execute($sql);
        return $result;
    }
?>