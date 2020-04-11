<?php
ob_start();
session_start();
$pagetitle = "البحث";
if(isset($_SESSION['name'])){
    include "init.php"; 
    
}?>
<div class='container'>
<?php
        $search = $_GET['search'];
if(empty($search)){
  echo "<div class='alert alert-danger'> لم يتم العثور على اي نتيجة </div> ";
}else{
        
if(isset($_GET['do']) and $_GET['do'] == 'query')
{
      $users = $con->query("SELECT * FROM personal_record WHERE personal_name LIKE '%$search%' or id_local LIKE '%$search%' or passport LIKE '%$search%'");
       $users->execute( );
        $count = $users->rowCount();
        if($count > 0)
        {
           echo "<h1 class='text-center' style='color: #333'> نتائج البحث </h1>";
          
            echo "<p class='alert alert-success col-md-6 text-right'>تم العثور على عدد <strong>" . $count . "</strong> في قاعدة البيانات </p>";
              $users = $con->prepare("SELECT * FROM personal_record WHERE personal_name LIKE '%$search%' or id_local LIKE '%$search%' or passport LIKE '%$search%'");
              $users->execute();
              while($rows = $users->fetch()){
              echo "<div class='cards col-md-6'>";
                echo "<a href='profile.php?personalid=" . $rows['personal_id'] . "' class='search'><i class='fas fa-user fa-1x'></i> الاسم : " . $rows['personal_name'] . "</a>";
                echo "<p><i class='fas fa-id-card fa-1x'></i> الرقم القومي : " . $rows['id_local'] . "</p>";
                echo "<p><i class='fas fa-phone fa-1x'></i> رقم الهاتف : " . $rows['phone_local'] . "</p>";
                echo "<p><i class='fas fa-phone fa-1x'></i> رقم الهاتف بالخارج : " . $rows['phone_outside'] . "</p>";
                echo "<p><i class='fas fa-briefcase fa-1x'></i> نوع العمل : " . $rows['personal_jop'] . "</p>";
              echo "</div>";
           }
        }else{
          echo "<div class='alert alert-danger'> لم يتم العثور على اي نتيجة </div> ";
         }
    }
  }
      
?>
</div>
<?php
include $tpl . 'footer.php';
ob_end_flush();
