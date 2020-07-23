
    <header class="main-header fixed-top">
        <a href="?" class="logo"><b>MY</b>YRU</a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                <?php
                    if($USER!=null){
                    $ADMIN_ID = $_SESSION["data_id"];
                ?>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php if($USER["status_id"]=="1"||$USER["status_id"]=="3"){?>
                                <?php
                                    if( $_SESSION["table"]=="tb_admin" ) {
                                ?>
                                    <img src="files/img_admin/<?php echo $USER["fileupload"];?>" class="user-image" onerror="ON_IMAGE_ERROR(this)" alt="User Image"/>
                                <?php } else {?>
                                    <img src="files/img_member/<?php echo $USER["fileupload"];?>" class="user-image" onerror="ON_IMAGE_ERROR(this)" alt="User Image"/>
                                <?php }?>
                                    <span class="hidden-xs"><?php echo $USER["name"]." ".$USER["lname"];?></span>
                            <?php }?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if($USER["status_id"]=="1"||$USER["status_id"]=="3"){?>
                                <?php
                                    if( $_SESSION["table"]=="tb_admin" ) {
                                ?>
                                <li class="user-header" style="background-color: #a9d7e1;">
                                    <img src="files/img_admin/<?php echo $USER["fileupload"];?>" class="img-circle" onerror="ON_IMAGE_ERROR(this)" alt="User Image" />
                                </li>
                                <?php } else { ?>
                                <li class="user-header" style="background-color: #a9d7e1;">
                                    <img src="files/img_member/<?php echo $USER["fileupload"];?>" class="img-circle" onerror="ON_IMAGE_ERROR(this)" alt="User Image" />
                                </li>
                                <?php } ?>
                                
                                <li class="user-header" style="margin-top: -84px; background-color: #428098;">
                                    <p>ยินดีตอนรับเข้าสู่ระบบ</p>
                                    <p>
                                        <?php echo $USER["name"]." ".$USER["lname"]." - ".$USER["status_name"];?>
                                    </p>
                                </li>
                                <li class="user-footer" style="background-color: #000d69;">
                                <?php
                                    if( $_SESSION["table"]=="tb_admin" ) {
                                ?>
                                    <div class="pull-left">
                                        <a href="./?content=user-admin-show&id=<?php echo $ADMIN_ID;?>" class="btn btn-default btn-flat">ข้อมูลส่วนตัว</a>
                                    </div>
                                <?php } else {?>
                                    <div class="pull-left">
                                        <a href="./?content=user-member-show&id=<?php echo $ADMIN_ID;?>" class="btn btn-default btn-flat">ข้อมูลส่วนตัว</a>
                                    </div>
                                <?php }?>
                                    <div class="pull-right">
                                        <a href="./logout.php" class="btn btn-default btn-flat">ออกจากระบบ</a>
                                    </div>
                                </li>
                            <?php }?>
                        </ul>
                    </li>
                <?php
                    }else{
                ?>
                    <li><a href="./login.php"><i class="fa fa-user" aria-hidden="true"></i> เข้าสู่ระบบ</a></li>
                <?php
                    }
                ?>
                </ul>
            </div>
        </nav>
    </header>