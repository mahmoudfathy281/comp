<?php
    session_start();
    $pagetitle = "log in";
    $noNavbar = '';
    include 'init.php';

    if(isset($_GET['user_id']) && is_numeric($_GET['user_id'])){
        $user = intval($_GET['user_id']);
        $admin = $con->prepare("SELECT * FROM users WHERE User_Id = ? AND GroupId = 1");
        $admin->execute(array($user));
        $a = $admin->fetchAll();
        foreach($a as $b){
        if($b['GroupId'] = 1){
            header('location: dashpord.php');
        }else{
            header('location: index.php');
        } }
    }else{
        echo "لا يمكن الدخول اللي هذه الصفحة";
    }

    

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['user'];
    $pass = $_POST['pass'];
    $hashpass = sha1($pass);

    $stmt = $con->prepare("SELECT User_Id, name, password FROM users WHERE name = ? AND password = ? AND GroupId = 1 LIMIT 1");
    $stmt->execute(array($name, $hashpass));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();
    if($count > 0){
        $_SESSION['name'] = $name;
        $_SESSION['id'] = $row['User_Id'];
        header("location: dashpord.php");
    }
}
?>
<div class="style_log_in">
    <img src="layout/img/imageration.png">
<form class="login" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <h3 class="text-center"> تسجيل الدخول </h3>
        <span><i class="fas fa-user"></i></span><input class="form-control" type="text" name="user" placeholder="الاسم" autocomplete="off" />
        <span><i class="fas fa-unlock-alt"></i></span><input class="form-control" type="password" name="pass" placeholder="الباسورد" autocomplete="new-password" />
        <input class="btn btn-primary btn-block" type="submit" value="سجل دخولك" />
    </form>
</div>
<?php
    include $tpl . 'footer.php';
?>