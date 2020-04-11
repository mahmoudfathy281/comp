<?php
    session_start();
    if(isset($_SESSION['name'])){
        include 'init.php';
        $entity_id = isset($_GET['entity_id']) && is_numeric($_GET['entity_id']) ? intval($_GET['entity_id']) : 0;
        $entity = $con->prepare("SELECT * FROM entity_rec WHERE entity_id = $entity_id");
        $entity->execute(array($entity_id));
        $entity_count = $entity->fetch();
        $count = $entity->rowCount();
    
?>
<div class="container">
<h1 class='text-center'><span>جهة تقديم الشكوي : </span><?php echo $entity_count['entity_name'] ?></h1>
    <?php
        if($count > 0){
            $getentity = $entity_count['entity_id'];
            $entity_complain = getItem('complain_entity', $getentity);
            foreach($entity_complain AS $c_entity){
                echo "<div class='col-sm-6 col-md-6 info'>";
                    echo "<div class='thumbnail item-box'>";
                        echo "<div class='caotion'>";
                            echo "<h2>" . $c_entity['complaint_name'] ."</h2>";
                            echo "<p> تاريخ تقديم الشكوي : " . $c_entity['complain_date'] ."</p>";
                            echo "<a class='btn btn-primary' href='complain_view.php?item_id=" . $c_entity['complain_id'] . "'>المزيد </a>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "<hr>";
            }
        }else{
            echo "<div class='alert alert-info'>لا توجد شكاوي مقدمة من هذه الجهة </div>";
        }
    }
    ?>
</div>
<?php
    include $tpl . 'footer.php';
?>