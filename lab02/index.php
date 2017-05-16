<!DOCTYPE html>
<html lang="vi>
<head>
    <meta charset="utf-8"/>
    <meta name="author" content="Huynh Minh Nhut"/>
    <link href="/lab02/site.css" rel="stylesheet"/>
    <title>OOP PHP</title>
</head>
<body>
<div id="wrapper">
    <?php 
        require_once("userclass.php");        
        //create new user
        $nguyenanh = new User('nguyen an', 'dinhanhvnn@gmail.com');
        
        // output user info
        echo "<h2>-- User info --</h2>";
        echo "UserID: ".$nguyenanh->GetUserID()."<br/>";
        echo "UserName: " .$nguyenanh->GetUserName()."<br/>";

        $nguyenanhmore = new User('nguyen anh 9', 'dinhanhvnn@gmail.com');
        echo "UserID: ".$nguyenanhmore->GetUserID()."<br/>";
        echo "UserName: " .$nguyenanhmore->GetUserName()."<br/>";
    ?>
</div>

<footer>
    &#169; 2017 Nhut Huynh - Student of Information Technology
</footer>
</body>
</html>
