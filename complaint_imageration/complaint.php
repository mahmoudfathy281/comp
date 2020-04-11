<?php
    ob_start();
    session_start();
    $pagetitle = "الشكاوي";
    if(isset($_SESSION['name'])){
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
        if($do == 'manage'){

            $sort = 'DESC';
            $sort_array = array('ASC','DESC');
            if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){
                $sort = $_GET['sort'];
            }
            if(!isset($_GET['page'])){
                $page = 1;
            }else{
                $page = $_GET['page'];
            }
                $stmt2 = $con->prepare("SELECT complain_rec.*, entity_rec.entity_name AS e_name, personal_record.personal_name AS p_name FROM complain_rec INNER JOIN entity_rec ON entity_id = complain_rec.complain_entity INNER JOIN personal_record ON personal_id = complain_rec.complain_personal ");
                $stmt2->execute();
                $complain = $stmt2->fetchAll();
                ?>
                <h1 class="text-center">الشكاوي</h1>
                <div class="container category ">
                <div class="card card-defualt">
                    <form class="form-inline my-4 my-lg-0 form_search complain_search" action="complain_searching.php" method="GET" id="searchform">
                        <input type="text" placeholder="البحث عن الشكوي" value="" name="search" id="search" aria-label="Search">
                        <input class="btn btn-outline-primary my-2 my-sm-0 click" type="submit" id="searchsubmit" value="بحث" class="submit">
                        <input type="hidden" name="do" value="query">
                    </form>
                    <div class="card-header info">
                    
                    <h2>
                        الشكاوي المقدمة
                        </h2>
                        <div class="option float-right">
                            ترتيب الشكوي: 
                            
                            <a class="<?php if($sort == DESC){echo 'active';}?>" href='?sort=DESC'>  ترتيب الاحدث للاقدم |</a>
                            <a class="<?php if($sort == ASC){echo 'active';}?>" href='?sort=ASC'>  ترتيب الاقدم للحدث </a>
                            
                        </div>
                        
                    </div>
                    <div class="card-body">
                    <div id="data">
                    </div>   
                        <div id="pagination"></div>	
                        <?php
$dsn = 'mysql:host=localhost;dbname=complain';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
    $con = new PDO($dsn, $user, $pass, $option);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo 'no conect' . $e->getMessage();
}
$perPage = 4;
$sqlQuery = $con->prepare("SELECT * FROM complain_rec");
$sqlQuery->execute();
$totalRecords = $sqlQuery->rowCount();
$totalPages = ceil($totalRecords/$perPage)
?>
<input type="hidden" id="totalPages" value="<?php echo $totalPages; ?>">
                    
                    
                </div>
                                    </div>
                                    

                <?php
                echo "<div class='container'>";
                /*  $next = $page + 1;
                 $priv = $page - 1;
                
                 if($priv > 0 ){
                     echo "<a class='page_count' href='complaint.php?page=" . $priv . "'><i class='fas fa-arrow-right'></i> السابق </a>";
                 }
                     for($i = 1; $i <= $page_count; $i++){
                        if($page == $i){
                             echo "<a class='page_count'>" . $page . "</a>";
                             }else{
                                 echo "<a class='page_count' href='complaint.php?page=" . $i . "'>" . $i . "</a>";
                             }
                                         }
                                         if($next <= $page_count){
                                             echo "<a class='page_count' href='complaint.php?page=" . $next . "'> التالي <i class='fas fa-arrow-left'></i></a>";
                                         } */
                                        
                     echo "</div>";
                
        }elseif($do == 'Add'){
            ?>
        <h1 class="text-center">ِاضافة شكوي جديدة</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=insert" method= "POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">عنوان الشكوي</label>
                    <input type="text" name="complain_name" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">وصف الشكوي</label>
                    <textarea name="complain_desc" class="form-control" autocomplete="off"></textarea>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">البلد</label>
                    <input type="text" name="complain_country" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">طبيعة الشكوي</label>
                    <input type="text" name="complain_nat" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">موقف الشكوي</label>
                    <input type="text" name="Complain_position" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">الرد علي الشكوي</label>
                    <input type="text" name="complain_riplay" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">حالة الشكوي</label>
                    <input type="text" name="complain_status" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">مقدم الشكوي</label>
                    <input type="text" name="complain_user" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">المجهودات</label>
                    <input type="text" name="Efforts" class="form-control" autocomplete="off">
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">الجهة الوارد منها الشكوي</label>
                    <select name="perso_entity">
                        <option value="0">.....</option>
                        <?php
                            $entity_personal = $con->prepare("SELECT * FROM entity_rec");
                            $entity_personal->execute();
                            $personal = $entity_personal->fetchAll();
                            foreach($personal as $perso){
                                echo "<option value='" . $perso['entity_id'] . "'>" . $perso['entity_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">صاحب الشكوي</label>
                    <input type="text" name="complain_personal" class="form-control" autocomplete="off">
                </div>
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="اضافة شكوي" class="btn btn-primary btn-lg" />  
                </div>            
            </form>
        </div>

<?php
        }elseif($do == 'insert' ){
            echo "<h1 class='text-center'>اضافة شكوي</h1>";
            echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $complain_name      = $_POST['complain_name'];
                $complain_desc      = $_POST['complain_desc'];
                $complain_country   = $_POST['complain_country'];
                $complain_nat       = $_POST['complain_nat'];
                $Complain_position  = $_POST['Complain_position'];
                $complain_riplay    = $_POST['complain_riplay'];
                $complain_status    = $_POST['complain_status'];
                $complain_user      = $_POST['complain_user'];
                $Efforts            = $_POST['Efforts'];
                $complain_entity    = $_POST['complain_entity'];
                $complain_personal  = $_POST['complain_personal'];
                $check = chekItem("complaint_name", "complain_rec", $complain_name);
                
                    $stmt = $con->prepare("INSERT INTO complain_rec(complaint_name, complain_desc, complain_country, complain_nat, Complain_position, complain_riplay, complain_status, complain_user, Efforts, complain_entity, complain_personal, date) 
                            VALUES(:zname, :zdesc, :zcountry, :znat, :zposition, :zriplay, :zsatatus, :zuser, :zefforts, :zentity, :zpersonal, NOW()");
                    $stmt->execute(array(
                        'zname'     => $complain_name,
                        'zdesc'     => $complain_desc,
                        'zcountry'  => $complain_country,
                        'znat'      => $complain_nat,
                        'zposition' => $Complain_position,
                        'zriplay'   => $complain_riplay,
                        'zsatatus'  => $complain_status,
                        'zuser'     => $complain_user,
                        'zefforts'  => $Efforts,
                        'zentity'   => $complain_entity,
                        'zpersonal' => $complain_personal
                    ));
                    $msg = "<div class='container'>
                                <div class='alert alert-success'>congrat add new categore</div>
                            </div>";
                    redirctHome($msg, '?do=Add') ;
                
            }
        }elseif($do == "Edit"){
            $complain_id = isset($_GET['compid']) && is_numeric($_GET['compid']) ? intval($_GET['compid']) : 0;
            $complain_stmt = $con->prepare("SELECT * FROM complain_rec WHERE complain_id = ?");
            $complain_stmt->execute(array($complain_id));
            $complaint = $complain_stmt->fetch();
            $count = $complain_stmt->rowCount();
            if($count > 0){
            ?>
            <h1 class="text-center">تعديل بيانات الشكوي</h1>
            <div class="container">
                <form class="form-horizontal info" action="?do=update" method="POST">
                    <input type="hidden" name="complain_id" value="<?php echo $complain_id ?>" />
                    <div class="form-group">
                        <labal>الرد علي الشكوي</labal>
                        <input type="text" name="complain_rip" class="form-control"  value="<?php echo $complaint['complain_riplay']?>">
                    </div>
                    <div class="form-group">
                        <labal>المجهودات</labal>
                        <input type="text" class="form-control" name="forword"  value="<?php echo $complaint['Efforts']?>">
                    </div>
                    <div class="form-group">
                        <labal>جهات اخري لتقديم الشكوي</labal>
                        <input type="text" class="form-control" name="complain_other"  value="<?php echo $complaint['complain_user']?>">
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" value="تحديث البيانات" class="btn btn-primary btn-lg" />  
                        </div> 
                    </div>
                </form>
            </div>
            
       <?php } }elseif($do == "update"){
            echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $complain_id  = $_POST['complain_id'];
                $complain_rip = $_POST['complain_rip'];
                $forword      = $_POST['forword'];
                $complain_other  = $_POST['complain_other'];
                $edit = $con->prepare("UPDATE complain_rec SET complain_riplay = ?, Efforts = ?, complain_other = ?, date = NOW() WHERE complain_id = ?");
                $edit->execute(array( $complain_rip, $forword, $complain_other, $complain_id));
                    $msg = "<div class='alert alert-success'>تم تحديث البيانات بنجاح</div>";
       
                    redirctHome($msg, 'complaint.php') ; 
            }else{
                $msg = "<div class='alert alert-danger'>thres no cant page dirctly</div></div>";
       
                    redirctHome($msg, 'complaint.php') ; 
            }
            echo "</div>";
        }elseif($do == "delete"){
            $complain_id = isset($_GET['compid']) && is_numeric($_GET['compid']) ? intval($_GET['compid']) : 0;
            $check_comp = chekItem("complain_id", 'complain_rec', $complain_id);
            if($check_comp > 0){
                $comp_stmt = $con->prepare("DELETE FROM complain_rec WHERE complain_id = :zid");
                $comp_stmt->bindParam("zid", $complain_id);
                $comp_stmt->execute();
                header('location: complaint.php');
                exit();
            }
        }
    }
?>
</div>
<?php
    include $tpl . 'footer.php';
?>
    <script>
$(function(){
    var totalPage = parseInt($('#totalPages').val());	
	var pag = $('#pagination').simplePaginator({
		totalPages: totalPage,
		nextLabel: 'Next',
		prevLabel: 'Prev',
		firstLabel: 'First',
		lastLabel: 'Last',
		clickCurrentPage: false,
		pageChange: function(page) {			
			$("#data").html('<p><strong>loading...</strong></p>');
            $.ajax({
				url:"php/complain.php",
				method:"POST",
				dataType: "json",		
				data:{page:	page},
				success:function(responseData){
					$('#data').html(responseData.html);
				}
			});
		}
	});
});
</script>
                                    
                