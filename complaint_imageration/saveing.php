<?php
    ob_start();
    session_start();
    $pagetitle = " المحفوظات";
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
                ?>
                <h1 class="text-center">المحفوظات</h1>
                <div class="container category ">
                <div class="card card-defualt">
                    <!-- <form class="form-inline my-4 my-lg-0 form_search complain_search" action="complain_searching.php" method="GET" id="searchform">
                        <input type="text" placeholder="البحث عن الشكوي" value="" name="search" id="search" aria-label="Search">
                        <input class="btn btn-outline-primary my-2 my-sm-0 click" type="submit" id="searchsubmit" value="بحث" class="submit">
                        <input type="hidden" name="do" value="query">
                    </form> -->
                    <div class="card-header info">
                    
                    <h2>
                        الشكاوي المحفوظة
                        </h2>
                        <div class="option float-right">
                            ترتيب الشكوي: 
                            
                            <a class="<?php if($sort == DESC){echo 'active';}?>" href='?sort=DESC'>  ترتيب الاحدث للاقدم |</a>
                            <a class="<?php if($sort == ASC){echo 'active';}?>" href='?sort=ASC'>  ترتيب الاقدم للحدث </a>
                            
                        </div>
                        
                    </div>
                    <div class="card-body">
                                <div class="card-body">
                                    <?php
                                    $complain_count = 15;
                                    $comp_count = $con->prepare("SELECT saving.*, entity_rec.entity_name AS e_name, personal_record.personal_name AS p_name FROM saving INNER JOIN entity_rec ON entity_id = saving.complain_entity INNER JOIN personal_record ON personal_id = saving.complain_personal ");
                                    $comp_count->execute();
                                    $complain = $comp_count->fetchAll();
                                    $count_complain = $comp_count->rowCount();
                                    $page_count = ceil($count_complain / $complain_count);
                                    if($page > $page_count || $page <= 0){
                                        echo " لا يوجد شكاوي في هذة الصفحة برجاء  العودة الي الصفحة الرئيسية";
                                    }
                                    $start = ($page - 1) * $complain_count;
                                    $end = $complain_count;
                                    if($comp_count->rowCount() != 0){
                                        $complaint_count = $con->prepare("SELECT 
                                                                            saving.*, entity_rec.entity_name 
                                                                        AS 
                                                                            e_name, personal_record.personal_name 
                                                                        AS 
                                                                            p_name 
                                                                        FROM 
                                                                            saving 
                                                                        INNER JOIN entity_rec 
                                                                        ON entity_id = saving.complain_entity 
                                                                        INNER JOIN personal_record 
                                                                        ON personal_id = saving.complain_personal 
                                                                        ORDER BY complain_id $sort
                                                                        LIMIT $start, $end 
                                                                        ");
                                        $complaint_count->execute();
                                        $counts = $complaint_count->rowCount();
                                            while($com = $complaint_count->fetch()){
                                                $date = $com['date'];
                                                echo "<div class='cat'>";
                                                    echo "<div class='hidden-button'>";
                                                        echo "<a href='complaint.php?do=delete&compid=". $com['complain_id'] ."' class='btn btn-danger confirm'><i class='fas fa-trash'></i> Delete</a>";
                                                    echo "</div>";
                                                    echo "<span>الشكوي : </span><a class='complainte' href='complain_view.php?item_id=" . $com['complain_id'] . "'>" . $com['complaint_name'] . '</a>';
                                                    echo "<p class='serial'><span>رقم الشكوي : </span>" . $com['complain_id'] . "</p>";
                                                    echo "<div class='full-viwe'>";
                                                        echo "<p><span>وصف الشكوي : </span>"; if($com['complain_desc'] == ''){echo "this category is empty";}else{echo substr($com['complain_desc'],0,253);} echo "</p>";
                                                        echo "<p><span>رقم الصادر : </span>" . $com['complain_number'] . "</p>";
                                                        echo "<p><span>جهة تقديم الشكوي : </span>" . $com['e_name'] . "</p>";
                                                        echo "<p><span>الرد علي الشكوي : </span>" . $com['complain_riplay'] . "</p>";
                                                        echo "<span>صاحب الشكوي : </span><a class='complainte' href='profile.php?personalid=" . $com['complain_personal'] . "'>" . $com['p_name'] . "</a> <br>";
                                                        echo "<p class='complainte'><span>تاريخ تقديم الشكوي : </span>" . $com['complain_date'] . "</p>";
                                                        
                                                        echo "<span>التاجات : </span>";
                                                        $alltag = explode(",", $com['tag']); 
                                                        foreach($alltag AS $tag){ 
                                                            if(! empty($tag)){
                                                                echo "<a class='complain_tag' href='tags.php?name={$tag}'>" . $tag . "</a>";
                                                            }
                                                        };
                                                        /*$now = time(); // or your date as well
                                                        $your_date = strtotime($date);
                                                        $datediff = $now - $your_date;
                                                        $no_of_days = round($datediff / (60 * 60 * 24));
                                                        if($no_of_days >90){
                                                            echo "<div class='alert alert-danger'>لم يتم الرد علي الشكوي</div>";
                                                        }else{
                                                            echo "تم الرد مع الجهات المعنية";
                                                        }*/
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
                <?php
                echo "<div class='container'>";
                $next = $page + 1;
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
                                        }
                                        
                    echo "</div>";
                
        

        }
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
    
?>

<?php
    include $tpl . 'footer.php';
?>