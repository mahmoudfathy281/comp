<?php
session_start();
include 'init.php';
if(isset($_GET['name'])){
    $tage_name = $_GET['name'];
    echo "<h1 class='text-center'>" . $tage_name . "</h1>";
?>

<div class="container">
    <div class="row">
        <?php
            
                $alltages = $con->prepare("SELECT complain_rec.*, 
                                                personal_record.personal_name 
                                            AS c_name 
                                            FROM complain_rec 
                                            INNER JOIN
                                                personal_record
                                            ON
                                                personal_record.personal_id = complain_rec.complain_personal
                                            WHERE tag LIKE '%$tage_name%'");
                $alltages->execute(['%$tags_name%']);
                foreach($alltages AS $tage){
                    echo "<div class='info thubminal_2 col-md-4'>";
                        echo "<div class=''>";
                            echo "<p><span>الشكوي : </span>" . $tage['complaint_name'] . "</p>";
                            echo "<p><span class='complain_desc'>وصف الشكوي : </span>" . $tage['complain_desc'] . "</p>";
                            echo "<p><span>مقدم الشكوي : </span>" . $tage['complain_user'] . "</p>";
                            echo "<p><span>صاحب الشكوي : </span>" . $tage['c_name'] . "</p>";
                        echo "</div>";
                    echo "</div>";
                }
            }else{
                echo "<div class='alert alert-danger info'>برجاء كتابة اسم تاج</div>";
            }
        ?>
    </div>
</div>

<?php
include $tpl . 'footer.php';
?>