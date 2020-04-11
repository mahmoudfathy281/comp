<?php
    ob_start();
    session_start();
    $pagetitle = "الاعضاء";
    if($_SESSION['name']){
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
        if(!isset($_GET['page'])){
            $page = 1;
        }else{
            $page = $_GET['page'];
        }
        if($do == 'manage'){
            $personal_count = 15;
            $personal_fetch = $con->prepare("SELECT * FROM personal_record");
            $personal_fetch->execute();
            $person = $personal_fetch->fetchAll();
            $count = $personal_fetch->rowCount();
            $page_count = ceil($count / $personal_count);
            if($page > $page_count || $page <= 0){
                echo "<div class='alert alert-danger'>عفوا لا يوجد صفحات الرجاء العودة الي الصفحة الرئيسية</div>";
            }
            $start = ($page - 1) * $personal_count;
            $end = $personal_count;
            
            ?>
            <h1 class="text-center">قائمة بالاشخاص المقدمون للشكاوي</h1>
            <div class="container">
                <?php 
                if($count > 0){ ?>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center main-table table-dark">
                            <tr>
                                <td>م</td>
                                <td>الاسم</td>
                                <td>الايميل</td>
                                <td>الرقم القومي</td>
                                <td>الوظيفة</td>
                                <td>التحكم</td>
                            </tr>
                    <?php
                    if($personal_fetch->rowCount() != 0){
                        $personal_countr = $con->prepare("SELECT * FROM personal_record LIMIT $start, $end");
                        $personal_countr->execute();
                        $count = $personal_fetch->rowCount();
                        while($person = $personal_countr->fetch()){
                            echo "<tr class='tbody'>";
                                echo "<td>" . $person['personal_id'] . "</td>";
                                echo "<td>" . $person['personal_name'] . "</td>";
                                echo "<td>" . $person['personal_email'] . "</td>";
                                echo "<td>" . $person['id_local'] . "</td>";
                                echo "<td>" . $person['personal_jop'] . "</td>";
                                echo "<td> ";
                                echo " 
                                <a href='profile.php?personalid=" . $person['personal_id'] . "' class='btn btn-primary'><i class='fas fa-eye'></i> مشاهدة</a></td>";      
                                        
                            echo "</tr>";
                        }
                    }
                }
            
                    ?>
                    </table>
            </div>
            <a href="personal.php?do=Add" class="btn btn-primary col-md-3 Add_cat"><i class="fas fa-plus "></i>اضافة شخص جديد</a>
            <?php
            $next = $page + 1;
            $last = $page - 1;
            if($last > 0 ){
                echo "<a class='page_count' href='personal.php?page=" . $last . "'><i class='fas fa-arrow-right'></i> السابق </a>";
                }
                for($i = 1; $i <= $page_count; $i++){
                    if($page == $i){
                        echo "<a class='page_count'>" . $page . "</a>";
                    }else{
                        echo "<a class='page_count' href='personal.php?page=" . $i . "'>" . $i . "</a>";
                    }
                }
            if($next <= $page_count){
                echo "<a class='page_count' href='personal.php?page=" . $next . "'> التالي <i class='fas fa-arrow-left'></i></a>";
            }
            
            ?>  
        </div>
            
        <?php
        }elseif($do == 'Add'){
            ?>
            <h1 class="text-center">اضافة شخص اخر</h1>
            <div class="container">
                <form class="form-horizontal info" method="POST" action="?do=insert">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">اسم الشخص</label>
                        <input type="text" name="perso_name" class="form-control col-sm-9" placeholder="اسم الشخص" auto-complete="off">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">الايميل</label>
                        <input type="" name="perso_email" class="form-control col-sm-9" placeholder="الايميل" auto-complete="off">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">رقم الهاتف المحلي</label>
                        <input type="text" name="perso_phone_in" class="form-control col-sm-9" placeholder="رقم الهاتف المحلي" auto-complete="off">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">رقم الهاتف بالخارج</label>
                        <input type="text" name="perso_phone_out" class="form-control col-sm-9" placeholder="رقم الهاتف بالخارج" auto-complete="off">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">العنوان بالداخل</label>
                        <input type="text" name="perso_address_in" class="form-control col-sm-9" placeholder="العنوان بالداخل" auto-complete="off">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">العنوان بالخارج</label>
                        <input type="text" name="perso_address_out" class="form-control col-sm-9" placeholder="العنوان بالخارج" auto-complete="off">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">الرقم القومي</label>
                        <input type="number" name="perso_id_in" class="form-control col-sm-9" placeholder="الرقم القومي" auto-complete="off">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">رقم جواز السفر</label>
                        <input type="text" name="perso_passport" class="form-control col-sm-9" placeholder="رقم جواز السفر" auto-complete="off">
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">الرقم القومي بالخارج</label>
                        <input type="text" name="perso_id_out" class="form-control col-sm-9" placeholder="الرقم القومي بالخارج" auto-complete="off">
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-2 control-label">التعليم</label>
                        <select name="perso_edu" class="col-sm-9">
                            <option class='info col-sm-9' value="0">.....</option>
                            <?php
                                $entity_personal = $con->prepare("SELECT * FROM personal_edu_rec");
                                $entity_personal->execute();
                                $personal = $entity_personal->fetchAll();
                                foreach($personal as $perso){
                                    echo "<option class='info col-sm-9' value='" . $perso['edu_rec_id'] . "'>" . $perso['edu_rec_name'] . "</option>";
                                }
                            ?>
                        </select> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">الجهة </label>
                        <select name="perso_entity" class="col-sm-9">
                            <option class='info col-sm-9' value="0">.....</option>
                            <?php
                                $entity_personal = $con->prepare("SELECT * FROM entity_rec");
                                $entity_personal->execute();
                                $personal = $entity_personal->fetchAll();
                                foreach($personal as $perso){
                                    echo "<option class='info col-md-9' value='" . $perso['entity_id'] . "'>" . $perso['entity_name'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">الوظيفة</label>
                        <input type="text" name="perso_jop" class="form-control col-sm-9" placeholder="الوظيفة" auto-complete="off">
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="submit" value="اضافة شخص جديد" class="btn btn-primary btn-lg" />  
                    </div> 
                </form>
            </div>
            
            <?php
        }elseif($do == 'insert'){
            echo "<h1 class='text-center'>اضافة عميل</h1>";
            echo "<div class='container'>";
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $perso_name         = $_POST['perso_name'];
                $perso_email        = $_POST['perso_email'];
                $perso_phone_in     = $_POST['perso_phone_in'];
                $perso_phone_out    = $_POST['perso_phone_out'];
                $perso_address_in   = $_POST['perso_address_in'];
                $perso_address_out  = $_POST['perso_address_out'];
                $perso_id_in        = $_POST['perso_id_in'];
                $perso_passport     = $_POST['perso_passport'];
                $perso_id_out       = $_POST['perso_id_out'];
                $perso_edu          = $_POST['perso_edu'];
                $perso_entity       = $_POST['perso_entity'];
                $perso_jop          = $_POST['perso_jop'];
                $check_personal = chekItem('personal_name', 'personal_record', $perso_name);
                if($check_personal > 0){
                    echo "<div class='alert alert-danger'>تم اضافة العميل من قبل </div>";
                }else{
                    $personal_stmt = $con->prepare("INSERT INTO personal_record(personal_name, personal_email, phone_local, phone_outside, address_local, address_outside, id_local, passport, id_outside, edu_rec, personal_entity, personal_jop) 
                                                    VALUES(:zpname, :zemail, :zphonelocal, :zphoneoutside, :zaddresslocal, :zaddressoutside, :zidlocal, :zpassport, :zidoutside, :zedu, :zentity, :zjop)");
                    $personal_stmt->execute(array(
                        'zpname'            => $perso_name,
                        'zemail'            => $perso_email,
                        'zphonelocal'       => $perso_phone_in, 
                        'zphoneoutside'     => $perso_phone_out,
                        'zaddresslocal'     => $perso_address_in,
                        'zaddressoutside'   => $perso_address_out,
                        'zidlocal'          => $perso_id_in,
                        'zpassport'         => $perso_passport,
                        'zidoutside'        => $perso_id_out,
                        'zedu'              => $perso_edu,
                        'zentity'           => $perso_entity,
                        'zjop'              => $perso_jop
                    ));
                    $msg = "<div class='container'>
                                      <div class='alert alert-success info'>تم اضافة عميل بنجاح</div>
                                  </div>";
                      redirctHome($msg, '?do=Add') ;
                }
            }
            echo "</div>";
        }elseif($do == 'delete'){
            $personal_id = isset($_GET['personalid']) && is_numeric($_GET['personalid']) ? intval($_GET['personalid']) : 0;
            $check_personal = chekItem("personal_id", 'personal_record', $personal_id);
            if($check_personal > 0){
                $personal_stmt = $con->prepare("DELETE FROM personal_record WHERE personal_id = :zid");
                $personal_stmt->bindParam("zid", $personal_id);
                $personal_stmt->execute();
                header('location: personal.php');
                exit();
            }
        }
    }

?>



<?php
include $tpl . 'footer.php';
?>