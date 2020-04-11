<?php
    ob_start();
    session_start();
    include 'init.php';
    $do = isset($_GET['personalid']) && is_numeric($_GET['personalid']) ? intval($_GET['personalid']) : 0;
    
    if(isset($do)){
        if(isset($_FILES['attachment'])){
            $attachName = $_FILES['attachment']['name'];
            $attach_size = $_FILES['attachment']['size'];
            $attach_tmp = $_FILES['attachment']['tmp_name'];
            $attach_type = $_FILES['attachment']['type'];
        }
        
       /* $avataAlloextension = array("jpge", "jpg", "png", "pdf", "docx", "xlsx");
        $avatarextention = strtolower(end(explode('.', $attachName)));
        if(! in_array($avatarextention, $avataAlloextension)){
            echo "<div class='container'><div class='alert alert-danger'><p class='info'>عفوا الملف المرفق لا يحتوي الامتدادات المطلوبة وهيا (jpge, jpg, png, pdf, docx, xlsx)</p></div></div>";
        }else{*/
            
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $complain_name      = $_POST['complain_name'];
            $complain_desc      = $_POST['complain_desc'];
            $complain_number    = $_POST['complain_number'];
            $complain_country   = $_POST['complain_country'];
            $complain_nat       = $_POST['complain_nat'];
            $Complain_position  = $_POST['Complain_position'];
            $complain_riplay    = $_POST['complain_riplay'];
            $complain_status    = $_POST['complain_status'];
            $attach = rand(0, 1000000) . '_' . $attachName;
            move_uploaded_file($attach_tmp, "uplod\image_complaint\\" . $attach);
            $complain_user      = $_POST['complain_user'];
            $Efforts            = $_POST['Efforts'];
            $date               = $_POST['date'];
            $complain_entity    = $_POST['complain_entity'];
            $complain_tags      = $_POST['complain_tags'];
            
            $check = chekItem('complaint_name', 'complain_rec', $complain_name);
            if($check > 0){
                echo "<div class='container'><div class='alert alert-danger info'>تم اضافة الشكوي من قبل </div></div>";
            }else{
            $stmt = $con->prepare("INSERT INTO complain_rec(complaint_name, complain_desc, complain_number, complain_country, complain_nat, Complain_position, complain_riplay, complain_status, attachment, complain_user, Efforts, complain_date, complain_entity, complain_personal, complain_users, tag, date) 
            VALUES(:zname, :zdesc, :zc_number, :zcountry, :znat, :zposition, :zriplay, :zsatatus, :zattachment, :zuser, :zefforts, :zdate, :zentity, :zpersonal, :zusers, :ztag, NOW())");
            $stmt->execute(array(
                'zname'       => $complain_name,
                'zdesc'       => $complain_desc,
                'zc_number'   => $complain_number,
                'zcountry'    => $complain_country,
                'znat'        => $complain_nat ,
                'zposition'   => $Complain_position,
                'zriplay'     => $complain_riplay,
                'zsatatus'    => $complain_status,
                'zattachment' => $attach,
                'zuser'       => $complain_user,
                'zefforts'    => $Efforts ,
                'zdate'       => $date,
                'zentity'     => $complain_entity,
                'zpersonal'   => $do,
                'ztag'        => $complain_tags,
                'zusers'      => $_SESSION['id']
            ));
            if($stmt){
                echo "<div class='container'><div class='alert alert-success'><p class='info'> تم اضافة شكوي</p></div></div>";
            }else{
                echo "sorry";
            }
        }
        }
    
    }?>


<div class="container block">
    <div class="row">
        <div class="col-sm-12">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <div class="card card-default create_add">
                    <div class="card-header">
                        <h3 class="card-title info">
                            اضافة شكوي جديدة
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form class="form-horizontal info" method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">عنوان الشكوي</label>
                                        <input type="text" name="complain_name" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">ملخص الشكوي</label>
                                        <textarea name="complain_desc" class="form-control" autocomplete="off"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">رقم الصادر</label>
                                        <input type="number" name="complain_number" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                    <label class="col-sm-3 control-label">الدولة<label>
                                    <div id="testinput" style="width: 300px;" data-selectedcountry="US" data-showspecial="false"
                                        data-showflags="true" data-i18nall="All selected" data-i18nnofilter="No selection" 
                                        data-i18nfilter="Filter" data-onchangecallback="onChangeCallback" name="complain_country"/>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">طبيعة الشكوي</label>
                                        <select name="complain_nat">
                                            <option vlaue="....">....</option>
                                            <option value="مستحقات وقضايا عمالية">مستحقات وقضايا عمالية</option>
                                            <option value="مسجونين ومعاملات قضائية واحوال شخصية">مسجونين ومعاملات قضائية واحوال شخصية</option>
                                            <option vlaue="اجراءات واستخراج وثائق">اجراءات واستخراج وثائق</option>
                                            <option vlaue="تعليم">تعليم</option>
                                            <option vlaue="إجازات">إجازات</option>
                                            <option vlaue="معاملات قنصلية">معاملات قنصلية</option>
                                            <option vlaue="معاملات قنصلية ومشكلة إقامة">معاملات قنصلية ومشكلة إقامة</option>
                                            <option vlaue="فرص عمل بالخارج وهجرة">فرص عمل بالخارج وهجرة</option>
                                            <option vlaue="مفقودين">مفقودين</option>
                                            <option vlaue="نقل جثامين ورعاية صحية">نقل جثامين ورعاية صحية</option>
                                            <option vlaue="عودة للوطن">عودة للوطن</option>
                                            <option vlaue="استفسارات المؤتمر">استفسارات المؤتمر</option>
                                            <option vlaue="تأمينات ومعاشات">تأمينات ومعاشات</option>
                                            <option vlaue="مقترخات">مقترخات</option>
                                            <option vlaue="كيانات">كيانات</option>
                                            <option vlaue="موضوعات اخري">موضوعات اخري</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">الرد علي الشكوي</label>
                                        <input type="text" name="complain_riplay" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">حالة الشكوي</label>
                                        <select name="complain_status">
                                            <option vlaue="....">....</option>
                                            <option value="فردية">فردية</option>
                                            <option value="جماعية">جماعية</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">رفع صورة</label>
                                        <div class="col-sm-10 col-md-4">
                                            <input type="file" name="attachment" class="form-control"/>  
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">مقدم الشكوي</label>
                                        <input type="text" name="complain_user" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">المجهودات</label>
                                        <input type="text" name="Efforts" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">تاريخ تقديم الشكوي</label>
                                        <input type="date" name="date" class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">الجهة الوارد منها الشكوي</label>
                                        <select name="complain_entity" class="col-sm-9">
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
                                        <label class="col-sm-3 control-label">موقف الشكوي</label>
                                        <select name="Complain_position">
                                            <option vlaue="....">....</option>
                                            <option value="حسم">حسم</option>
                                            <option value="جاري">جاري</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>التاجات</label>
                                        <input class="form-control" name="complain_tags" placeholder="اضافة تاجات للشكوي" require>
                                    </div>
                                    <a href="profile.php?personalid=<?php echo $do?>" class="btn btn-danger exit">رجوع</a>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" value="اضافة شكوي" class="btn btn-primary btn-lg" id="add" />  
                                        </div> 
                                        
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include $tpl . 'footer.php';