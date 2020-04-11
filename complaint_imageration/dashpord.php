<?php
    session_start();
    if(isset($_SESSION['name'])){
        include "init.php"; 
        
    }
        ?>
        
        <div class="header">
            <h2 class="text-center">برنامج الشكاوي ومتابعة المصريين بالخارج</h2>
        </div>
        <div class="report">
        <div class="container home-stat text-center">
        
            <h1> لوحة التحكم <i class="fas fa-tachometer-alt fa-1x"></i></h1>
            <div class="row">
                    <div class="col-md-3">
                        <div class="stat memmber">
                            <i class="fas fa-users fa-4x"></i>
                            <span><a href="personal.php"><?php echo countAll('personal_id', 'personal_record')?></a></span>
                            اجمالي المواطنون المقدمون للشكاوي
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="stat items">
                                <i class="fas fa-layer-group fa-4x"></i>
                                <span><a href="complaint.php"><?php echo countAll('complain_id', 'complain_rec')?></a></span>
                             شكاوي لم يتم الرد عليها
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat entities">
                            <i class="fas fa-gopuram fa-4x"></i>
                            <span><a href="#">0</a></span>
                             الكيانات المسجلة بوزارة الهجرة
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat saving">
                            <i class="fas fa-save fa-4x"></i>
                            <span><a href="saveing.php"><?php echo countAll('complain_id', 'saving')?></a></span>
                            الشكاوي المحفوظة والتي تم الرد عليها
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="container latest">
                <h1 class="text-center char">احصائيات</h1>
                <hr>
                <hr class="h_r">
                <hr class="h_r2">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card card-defualt ">
                            <div class="card-header info">
                            <h2> <i class="fas fa-users"></i> جهات تقديم الشكوي</h2>
                            </div>
                            <table class="table-bordered table text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>اسم الجهة</th>
                                        <th>عدد الشكاوي المقدمة</th>
                                    </tr>
                                </thead>
                            <?php
                                $getentity = $con->prepare("SELECT entity_id , entity_name , count(complain_id) as complains from entity_rec 
                                                            left join complain_rec on complain_rec.complain_entity = entity_rec.entity_id
                                                            group by entity_rec.entity_id");
                                            $getentity->execute();
                                            $cont = $getentity->fetchAll();
                                                         
                                foreach($cont AS $cone){
                                    echo "<tbody class='entity_complaint'> 
                                            <tr> 
                                                <td>" . $cone['entity_id'] ."</td>
                                                <td class='after' id='charts'><a href='entity.php?entity_id=" . $cone['entity_id'] . "'>". $cone['entity_name'] ."</a></td>
                                                <td>". $cone['complains'] ."</td>" ."
                                            </tr>
                                        </tbody>";
                                }
                                echo "<tfooter class='table_footer'>
                                    <tr>
                                    <td>11</td>
                                        <td>اجمالي الشكاوي</td>
                                        <td>" . countAll('complain_id', 'complain_rec') . "</td>
                                    </tr>
                                </tfooter>";
                            ?>
                            </tabel>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            
<?php
include $tpl . 'footer.php';
//     // $dataPoints1 = array(
//     //     array("label"=> $cone['entity_name'], "y"=> $cone['complains'])
//     // );
//     $dataPoints = array();
// //Best practice is to create a separate file for handling connection to database
// try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
//     $link = new \PDO(   'mysql:host=localhost;dbname=complain;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
//                         'root', //'root',
//                         '', //'',
//                         array(
//                             \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//                             \PDO::ATTR_PERSISTENT => false
//                         )
//                     );
	
//     $handle = $con->prepare('SELECT entity_id , entity_name , count(complain_id) as complains from entity_rec 
//     left join complain_rec on complain_rec.complain_entity = entity_rec.entity_id
//     group by entity_rec.entity_id'); 
//     $handle->execute(); 
//     $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
//     foreach($result as $row){
//         array_push($dataPoints, array("x"=> $row['entity_name'], "y"=> $row['complains']    ));
//     }
// 	$con = null;
// }
// catch(\PDOException $ex){
//     print($ex->getMessage());
// }
?>
<script>
//     window.onload = function () {
 
//  var chart = new CanvasJS.Chart("chartContainer", {
//      animationEnabled: true,
//      exportEnabled: true,
//      theme: "light1", // "light1", "light2", "dark1", "dark2"
//      title:{
//          text: "PHP Column Chart from Database"
//      },
//      data: [{
//          type: "column", //change type to bar, line, area, pie, etc  
//          dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
//      }]
//  });
//  chart.render();
  
//  }
</script>