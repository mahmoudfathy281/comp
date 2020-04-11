<?php
    session_start();
    $pagetitle = "log in";
    $noNavbar = '';
    if(isset($_SESSION['name'])){
        header('location: dashpord.php');
    }
    include 'init.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['user'];
    $pass = $_POST['pass'];
    $hashpass = sha1($pass);

    $stmt = $con->prepare("SELECT User_Id, name, password FROM users WHERE name = ? AND password = ?");
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