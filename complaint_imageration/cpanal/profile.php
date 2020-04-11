<?php
    ob_start();
    session_start();
    if(isset($_SESSION['name'])){
        include 'init.php';
        $id = isset($_GET['personalid']) && is_numeric($_GET['personalid']) ? intval($_GET['personalid']) : 0;
        $getpersona = $con->prepare("SELECT personal_record.*, entity_rec.entity_name AS p_name, personal_edu_rec.edu_rec_name AS edu_name FROM personal_record INNER JOIN entity_rec ON entity_id = personal_record.personal_entity INNER JOIN personal_edu_rec ON edu_rec_id = personal_record.edu_rec WHERE personal_id = $id");
        $getpersona->execute(array($id));
        $info = $getpersona->fetch();
        $count = $getpersona->rowCount();
    }
    if($count> 0){
    ?>
    <div class="container block">
        <div class="row">
            <div class="col-sm-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <div class="card card-default sidebar-menu">
                        <div class="card-header personal">
                            <img src="layout/img/index.png" alt="">
                            <br>
                            <h3 class="card-title text-right">
                                 <p><?php echo $info['personal_name'];  ?></p>
                                عدد الشكاوي المقدمة<p class="complaint_count"> <?php echo countItems('complain_personal', 'complain_rec', $id)?></p>
                            </h3>
                        </div>
                        <div class="card-body">
                            <ul class="nav-pills nav-stacked nav">
                                <li class="">
                                    <a href="#v-pills-home" class="nav-link active" id="v-pills-home-tab" data-toggle="pill" role="tab" aria-controls="v-pills-home" aria-selected="false"><i class="fas fa-home"></i>المعلومات الرئيسية</a>
                                </li>
                                <li class="">
                                    <a href="#v-pills-profile" class="nav-link" id="v-pills-profile-tab" data-toggle="pill" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                        <i class="fas fa-list"></i> الشكاوي
                                    </a>
                                </li>
                                <li class="">
                                    <a class="nav-link" href='newcomplaint.php?personalid=<?php echo $info['personal_id'];?>' aria-selected="false">
                                        <i class="fas fa-plus"></i> اضافة شكوي جديده
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="card tab-pane fade show active info" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <div class="card-header"><h1><?php echo $info['personal_name'] ?></h1></div>
                    <div class="card-body">
                        <p><i class="fas fa-envelope"></i> الايميل : <?php echo $info['personal_email'] ?></p>
                        <p><i class='fas fa-phone fa-1x'></i> رقم الهاتف المحلي : <?php echo $info['phone_local'] ?></p>
                        <p><i class='fas fa-phone fa-1x'></i> رقم الهاتف بالخارج : <?php echo $info['phone_outside'] ?></p>
                        <p><i class='fas fa-map-marker-alt fa-1x'></i> العنوان بالداخل : <?php echo $info['address_local'] ?></p>
                        <p><i class='fas fa-map-marker-alt fa-1x'></i> العنوان بالخارج : <?php echo $info['address_outside'] ?></p>
                        <p><i class='fas fa-id-card fa-1x'></i> الرقم القومي : <?php echo $info['id_local'] ?></p>
                        <p><i class='fas fa-passport fa-1x'></i> رقم الباسبور : <?php echo $info['passport'] ?></p>
                        <p><i class='fas fa-id-card fa-1x'></i> رقم القومي بالخارج : <?php echo $info['id_outside'] ?></p>
                        <p><i class='fas fa-graduation-cap fa-1x'></i> التعليم : <?php echo $info['edu_name'] ?></p>
                        <p><i class='fas fa-cannabis fa-1x'></i> الجهة : <?php echo $info['p_name'] ?></p>
                        <p><i class='fas fa-briefcase fa-1x'></i> الوظيفة : <?php echo $info['personal_jop'] ?></p>
                    </div>
                </div>
                <div class="card tab-pane fade info" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <div class="card-header"><h1>الشكاوي المقدمة</h1></div>
                    <div class="card-body">
                        <?php
                            $getpersonalid = $info['personal_id'];
                            $item = getItem('complain_personal', $getpersonalid);
                            
                            if($item > 0){
                                foreach($item as $ite){
                                    echo "<div class='col-sm-6 col-md-6'>";
                                        echo "<div class='thumbnail item-box'>";
                                            echo "<div class='caotion'>";
                                                echo "<h2>" . $ite['complaint_name'] ."</h2>";
                                                echo "<p> تاريخ تقديم الشكوي : " . $ite['complain_date'] ."</p>";
                                                echo "<a class='btn btn-primary' href='complain_view.php?item_id=" . $ite['complain_id'] . "'>المزيد </a>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                    echo "<hr>";
                                }
                            }
                        
                            
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    }else{
        $msg = "<div class='container'><div class='alert alert-danger'>عفوا لايوجد عميل بهذا الرقم</div></div>";
        redirctHome($msg, 'dashpord.php') ;
    }
?>

<?php


    include $tpl . 'footer.php';
    