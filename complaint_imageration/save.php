<?php
session_start();
include "init.php";

$id = isset($_GET['complain_id']) && is_numeric($_GET['complain_id']) ? intval($_GET['complain_id']) : 0;
if(isset($id)){
$stmt = $con->prepare("SELECT * FROM complain_rec WHERE complain_id = $id");
$stmt->execute();
$fetch = $stmt->fetch();

if(isset($stmt)){
    $complain_id = $fetch['complain_id'];
    $complain_name = $fetch['complaint_name'];
    $complain_desc = $fetch['complain_desc'];
    $complain_number = $fetch['complain_number'];
    $complain_country = $fetch['complain_country'];
    $complain_nat = $fetch['complain_nat'];
    $Complain_position = $fetch['Complain_position'];
    $complain_riplay = $fetch['complain_riplay'];
    $complain_status = $fetch['complain_status'];
    $attachment = $fetch['attachment'];
    $complain_user = $fetch['complain_user'];
    $Efforts = $fetch['Efforts'];
    $complain_date = $fetch['complain_date'];
    $complain_entity = $fetch['complain_entity'];
    $complain_personal = $fetch['complain_personal'];
    $tag = $fetch['tag'];
    $complain_save = $con->prepare("INSERT INTO 
    saving(complain_id, complaint_name, complain_desc, complain_number, complain_country, complain_nat, Complain_position, complain_riplay, complain_status, attachment, complain_user, Efforts, complain_date, complain_entity, complain_personal, tag, date) 
    VALUES(:zid, :zname, :zdesc, :znumber, :zcountry, :znat, :zposition, :zriplay, :zstatus, :zattach, :zuser, :zeffort, :zdate, :zentity, :zpersonal, :ztag, NOW())");
    $complain_save->execute(array(
        'zid' => $complain_id,
        'zname' => $complain_name,
        'zdesc' => $complain_desc,
        'znumber' => $complain_number,
        'zcountry' => $complain_country,
        'znat' => $complain_nat,
        'zposition' => $Complain_position,
        'zriplay' => $complain_riplay,
        'zstatus' => $complain_status,
        'zattach' => $attachment,
        'zuser' => $complain_user,
        'zeffort' => $Efforts,
        'zdate' => $complain_date,
        'zentity' => $complain_entity,
        'zpersonal' => $complain_personal,
        'ztag' => $tag
    ));
    $complain_delete = $con->prepare("DELETE FROM complain_rec WHERE complain_id = :zid");
    $complain_delete->bindParam('zid', $id);
    $complain_delete->execute();
    header('location: complaint.php');
    exit();

}
}
$stmt2 = $con->prepare("SELECT * FROM saving ");
$stmt2->execute();
$cont = $stmt2->fetch();
if($cont > 0){
    echo "<h1>" . $cont['complaint_name'] . "</h1>";
}


?>



<?php
include $tpl . 'footer.php';
?>