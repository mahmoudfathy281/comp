<?php
session_start();
include 'init.php';
?>
<div class='container'>
<?php

    if(isset($_GET['search'])){
        $search = $_GET['search'];
    }
    if(empty($search)){
        echo "<div class='alert alert-danger'> لم يتم العثور على اي نتيجة </div> ";
    }else{
        if(isset($_GET['do']) and $_GET['do'] == 'query'){
            $users = $con->query("SELECT * FROM complain_rec WHERE complain_id LIKE '%$search%' or tag LIKE '%$search%'");
            $users->execute( );
                $count = $users->rowCount();
                if($count == 0)
                {
                echo "<div class='alert alert-danger'> لم يتم العثور على اي نتيجة </div> ";
                }else{
                    echo "<p class='alert alert-success col-md-6 text-right'>تم العثور على عدد <strong>" . $count . "</strong> في قاعدة البيانات </p>";

            $users = $con->prepare("SELECT complain_rec.*, personal_record.personal_name AS C_name FROM complain_rec INNER JOIN
            personal_record
        ON
            personal_record.personal_id = complain_rec.complain_personal WHERE complain_id LIKE '%$search%' or tag LIKE '%$search%' or complain_other LIKE '%$search%'");
            $users->execute();
            while($rows = $users->fetch()){
                echo "<div class='cards col-md-6'>";
                echo "<a href='complain_view.php?item_id=" . $rows['complain_id'] . "' class='search'><i class='fas fa-user fa-1x'></i> الاسم : " . $rows['complaint_name'] . "</a>";
                echo "<p> رقم الصادر : " . $rows['complain_number'] . "</p>";
                echo "<p> تاريخ تقديم الشكوي : " . $rows['date'] . "</p>";
                echo "<p><i class='fas fa-user fa-1x'></i> صاحب الشكوي : " . $rows['C_name'] . "</p>";
                    echo "</div>";
                }
            }
        }
    }
?>
</div>
<?php
    include $tpl . 'footer.php' ?>