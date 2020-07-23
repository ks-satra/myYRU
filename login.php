<?php
    session_start();
    require_once("php/class.database.php");
    require_once("php/class.function.php");
    require_once("php/config.php");
    
    $DATABASE = new Database($HOST,$USER,$PASS,$DBNAME);
    $FUNCTION = new Functions($DATABASE);
    $USER = $FUNCTION->GetUser();
    if( $USER!=null ){
        header("location:./");
        exit(0);
    }

    $msg_username = "";
    $msg_password = ""; 
    $msg_alert = "";
    if(isset($_POST["btnSubmit"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if($username==" ")$msg_username="ชื่อผู้ใช้ห้ามว่าง.";
        if($password==" ")$msg_password="รหัสผ่านห้ามว่าง.";
        if($FUNCTION->Login($username,$password)){
            header("location:./");
            exit(0);
        }else{
            $msg_alert = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง.";
        }
    }
?>
<!DOCTYPE html>
<html>
<head> 
    <meta charset="UTF-8">
    <title>ยินดีตอนรับ | เข้าสู่ระบบ</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/admin-lte/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
</head>
    <body class="login-page">
    <div class="login-box-msg col-md-12">
        <h1><b>ระบบฐานข้อมูลสารสนเทศ</b></h1>
    </div>
    <div class="login-box" style="margin-top: 7px;">
        <div class="product-item login-box-body col-md-12" style="margin-top: 54px;">
            <p class="login-box-msg" style="color: #010101; font-size: 20px;">เข้าสู่ระบบ</p>
            <form class="form-horizontal" action="login.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username" maxlength="10">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <?php if($msg_username!=""){?>
                        <span class="help-block" style="color:#F00;"><?php echo $msg_username;?></span>
                    <?php }?>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" maxlength="10">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                <?php if($msg_password!=""){?>
                    <span class="help-block" style="color:#F00;"><?php echo $msg_password;?></span>
                <?php }?>
                </div>
                <?php if($msg_alert!=""){?>
                <div class="form-group"> 
                    <div class="col-sm-offset-1 col-sm-10" style="color:#F00;"><?php echo $msg_alert;?></div>
                </div>
                <?php }?>
                <div class="form-group text-center"> 
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" class="product-item btn btn-primary" title="ลงชื่อเข้าใช้" name="btnSubmit">
                            <i class="glyphicon glyphicon-ok" aria-hidden="true"></i> ลงชื่อเข้าใช้</a>
                        </button>   
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' 
            });
        });
    </script>
</body>
</html>