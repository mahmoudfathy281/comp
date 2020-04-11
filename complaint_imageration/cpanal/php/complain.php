<?php
    include '../conect.php';
    // $result= $con->prepare("SELECT complain_rec.*, entity_rec.entity_name AS e_name, personal_record.personal_name
    //  AS p_name FROM complain_rec INNER JOIN entity_rec ON entity_id = complain_rec.complain_entity 
    //  INNER JOIN personal_record ON personal_id = complain_rec.complain_personal");
    // $result->execute();
    // $data = array();
    // while($rows = $result->fetch()){
    //     $data[] = $rows;
    // }
    
    // echo json_encode($data);
	$perPage = 4;
if (isset($_POST["page"])) { 
	$page  = $_POST["page"]; 
} else { 
	$page=1; 
};  
$startFrom = ($page - 1) * $perPage;  
$sqlQuery = $con->prepare("SELECT 
complain_rec.*, entity_rec.entity_name 
AS 
e_name, personal_record.personal_name 
AS 
p_name 
FROM 
complain_rec 
INNER JOIN entity_rec 
ON entity_id = complain_rec.complain_entity 
INNER JOIN personal_record 
ON personal_id = complain_rec.complain_personal 
LIMIT $startFrom, $perPage");  
$sqlQuery->execute(); 
$paginationHtml = '';
while ($row = $sqlQuery->fetch()) { 
    $paginationHtml.="<div class='cat'>";
    $paginationHtml.="<div class='hidden-button'>";
    $paginationHtml.="<a href='complaint.php?do=Edit&compid=". $row['complain_id'] ."' class='btn btn-primary'><i class='fas fa-edit'></i> Edit</a>";
    $paginationHtml.="<a href='complaint.php?do=delete&compid=". $row['complain_id'] ."' class='btn btn-danger confirm'><i class='fas fa-trash'></i> Delete</a>";
    $paginationHtml.="</div>";
    $paginationHtml.="<span>الشكوي : </span><a class='complainte' href='complain_view.php?item_id=" . $row['complain_id'] . "'>" . $row['complaint_name'] . '</a>';
    $paginationHtml.="<p class='serial'><span>رقم الشكوي : </span>" . $row['complain_id'] . "</p>";
    $paginationHtml.="<p><span>وصف الشكوي : </span>" . $row['complain_desc'] . "</p>";
    $paginationHtml.="</div>";
} 
$jsonData = array(
	"html"	=> $paginationHtml,	
);
echo json_encode($jsonData);
// $paginationHtml.="<p class='serial'><span>رقم الشكوي : </span>" . $row['complain_id'] . "</p>";
// 	$paginationHtml.="<span>الشكوي : </span><a class='complainte' href='complain_view.php?item_id=" . $row['complain_id'] . "'>" . $row['complaint_name'] . '</a>';
//     $paginationHtml.="<div class='full-viwe'>";
//     $paginationHtml.="<p><span>وصف الشكوي : </span>"; if($row['complain_desc'] == ''){echo "this category is empty";}else{echo substr($row['complain_desc'],0,253);} "</p>";
//     $pagination     Html.="<p><span>رقم الصادر : </span>" . $row['complain_number'] . "</p>";
//     $paginationHtml.="<p><span>جهة تقديم الشكوي : </span>" . $row['e_name'] . "</p>";
//     $paginationHtml.="<span>صاحب الشكوي : </span><a class='complainte' href='profile.php?personalid=" . $row['complain_personal'] . "'>" . $row['p_name'] . "</a> <br>";
//     $paginationHtml.="<p class='complainte'><span>تاريخ تقديم الشكوي : </span>" . $row['complain_date'] . "</p>";
//     $paginationHtml.="<span>التاجات : </span>";
//     $alltag = explode(",", $row['tag']); 
//      foreach($alltag AS $tag){ 
//          if(! empty($tag)){
//             $paginationHtml.="<a class='complain_tag' href='tags.php?name={$tag}'>" . $tag . "</a>";
//          }
//      }
//      $paginationHtml.="</div>";
?>