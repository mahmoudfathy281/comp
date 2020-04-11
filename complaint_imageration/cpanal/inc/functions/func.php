<?php
    
    function getTitle(){
        global $pagetitle;  
        if(isset($pagetitle)){
            echo $pagetitle;
        }else{
            echo 'home page';   
        }
    }
    function getItem($where, $value) {
        global $con;
        $getitem = $con->prepare("SELECT * FROM complain_rec WHERE $where = ?");
        $getitem->execute(array($value));
        $items = $getitem->fetchAll();
        return $items;

    }

    function redirctHome($msg, $url = 'index.php' /*or $url = 'ull' */, $second = 3){

        /* 
        if($url === ull){
            $url = 'index.php';
            $link = 'Homepage';
        }else{
            if(isset(['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
                $url = $_SERVER['HTTP_REFERER'];
                $link = 'Previous Page';
            }else{
                $url = 'index.php';
                $link = 'Homepage';
            }
        }
        */
        echo $msg;
        echo "<div class='container'><div class='alert alert-info'>you well be direct is $second seconds</div></div>";
        header("refresh:$second; $url");
        exit();
        
    }



    function chekItem($select, $from, $value){
        global $con;
        $statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
        $statement->execute(array($value));
        $count = $statement->rowCount();
        return $count;
    }



    function getLatest($select, $table){
        global $con;
        $thelatest = $con->prepare("SELECT $select FROM $table");
        $thelatest->execute();
        $rows = $thelatest->fetchAll();
        return $rows;

    }

    




    function countItems($items, $table, $value){
        global $con;
        $stmt2 = $con->prepare("SELECT COUNT($items) FROM $table WHERE $items = $value");
        $stmt2->execute();
        return $stmt2->fetchColumn();
    }
    function countAll($items, $table){
        global $con;
        $stmt2 = $con->prepare("SELECT COUNT($items) FROM $table");
        $stmt2->execute();
        return $stmt2->fetchColumn();
    }






    