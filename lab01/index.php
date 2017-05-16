<!DOCTYPE html>
<html lang="vi>
<head>
    <meta charset="utf-8"/>
    <meta name="author" content="Huynh Minh Nhut"/>
    <link href="/lab01/site.css" rel="stylesheet"/>
    <title>Xep loai ket qua tuyen sinh</title>
</head>
<body>

<div id="wrapper">
    <h2>Xep loa ket qua tuyen sinh</h2>
    <form action="#" method="post">
        <div class="row">
            <div class="lblTitle">
                <label>Điểm môn toán</label>
            </div>
             <div class="lblInput">
               <input type="number" name="Toan" 
               value="<?php echo isset($_POST["Toan"])?$_POST["Toan"]:"" ; ?>"/>
            </div>
        </div>

        <div class="row">
            <div class="lblTitle">
                <label>Điểm môn Lý</label>
            </div>
             <div class="lblInput">
               <input type="number" name="Ly" 
               value="<?php echo isset($_POST["Ly"])?$_POST["Ly"]:"" ; ?>"/>
            </div>
        </div>

        <div class="row">
            <div class="lblTitle">
                <label>Điểm môn Hóa</label>
            </div>
             <div class="lblInput">
               <input type="number" name="Hoa" 
               value="<?php echo isset($_POST["Hoa"])?$_POST["Hoa"]:"" ; ?>"/>
            </div>
        </div>


        <div class="row">
            <div class="submit">
                <input type="submit" name="btnsubmit" value="Xếp loại"/>
            </div>             
        </div>
    </form>

    <div id="result">
        <h2>Kết quả xếp loại</h2>
            <div class="row">
            <div class="lblTitle">
                <label>Tổng điểm</label>
            </div>
             <div class="lblOutput">
               <?php
                echo isset($_POST["btnsubmit"]) ? $_POST["Toan"] + $_POST["Ly"] + $_POST["Hoa"]:"";
               ?>
            </div>

            <div class="row">
            <div class="lblTitle">
                <label>Xếp loại</label>
            </div>
             <div class="lblOutput">
               <?php
               if(isset($_POST["btnsubmit"])){
                     $Tongdiem = $_POST["Toan"] + $_POST["Ly"] + $_POST["Hoa"];
                if($Tongdiem>24){
                    echo "Giỏi";
                }
                else if($Tongdiem>21){
                     echo "Giỏi";
                }

                 else if($Tongdiem>15){
                     echo "Trung Bình";
                }

                else{
                     echo "Yếu";
                }
               }
               
               ?>
            </div>  

             <div class="row">
            <div class="lblTitle">
                <label>
                    Điểm trung bình</label>
            </div>
             <div class="lblOutput">
               <?php
                if(isset($_POST["btnsubmit"])){
                //$Tongdiem1 = $_POST["Toan"] + $_POST["Ly"] + $_POST["Hoa"];               
                $Trungbinh = $Tongdiem/3;
                echo $Trungbinh +"";    
                }
                          
               ?>
            </div>
        </div>        
        </div>

       
</div>

</body>
</html>
